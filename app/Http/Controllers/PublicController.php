<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Events\ViewCount;
use App\Http\Requests\BidRequest;
use App\Listeners\IncrementViewCount;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();

        //Clear the flash messages for the index page

        $request->session()->forget('message');

        return view('products.public.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Validate to make sure new email isn't used
        $validatedData = $request->validate([
            'amount' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users,email',
        ]);

        //Get all the form data

        $inputs = $request->all();

        //Create the new user with default password and name

        $user = new User();
        $user->email = $inputs['email'];
        $user->name = 'Guest';
        $user->password = bcrypt('password');
        $user->save();

        //Login the new user with default password and name

        Auth::login($user, true);

        //Create the new bid

        $bid = new Bid();
        $bid->amount = $inputs['amount'];
        $bid->product_id = $inputs['product_id'];
        $bid->user_id = $user->id;
        $bid->save();

        //Save the flash message

        session()->flash('message', 'Your bid has been placed!');

        //GET ALL THE EXISTING BIDS WITH A LOCAL METHOD - THEN YOU CAN USE THE $allBids array
        $this->getAllBids($inputs['product_id']);

        //GET THE PRODUCT
        $product = Product::where('id', $inputs['product_id'])->first();

        //GET THE USERS BID

        $userBid = $bid;

//        dd($userBid);

        return view('products.public.show')
            ->with('product', $product)
            ->with('bids', $this->allBids['bids'])
            ->with('highestBid', $this->allBids['highestBid'])
            ->with('lowestBid', $this->allBids['lowestBid'])
            ->with('averageBid', $this->allBids['averageBid'])
            ->with('userBid', $userBid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidRequest $request)
    {
        //dd('Store');

        //Get the form data
        $inputs = $request->all();

//        dd($inputs);

        //GET THE PRODUCT

        $product = Product::where('id', $inputs['product_id'])->first();

        //GET THE USERS BID

        $userBid = false;

        if(Auth::id())
        {
//            dd('There is auth ID');
            $userBid = Bid::where('product_id', $inputs['product_id'])->where('user_id', Auth::id())->first();
        }

        //CHeck if this user hasnt already placed a bid on this product

        if($userBid){
            //dd('There is user bid');

            //GET ALL THE EXISTING BIDS WITH A LOCAL METHOD - THEN YOU CAN USE THE $allBids array
            $this->getAllBids($inputs['product_id']);

            //Write flash message
            session()->flash('message', 'Each user is only allowed to place a single bid per product!');

            return view('products.public.show')
                ->with('product', $product)
                ->with('bids', $this->allBids['bids'])
                ->with('highestBid', $this->allBids['highestBid'])
                ->with('lowestBid', $this->allBids['lowestBid'])
                ->with('averageBid', $this->allBids['averageBid'])
                ->with('userBid', $userBid);
        }else{
            //dd('There is not user bid');
            $bid = new Bid();
            $bid->user_id = $inputs['user_id'];
            $bid->product_id = $inputs['product_id'];
            $bid->amount = $inputs['amount'];
            $bid->save();

            //Set the user bid

            $userBid = $bid;

            //GET ALL THE EXISTING BIDS WITH A LOCAL METHOD - THEN YOU CAN USE THE $allBids array
            $this->getAllBids($inputs['product_id']);

            //Write flash message
            session()->flash('message', 'Your bid has been placed!');

            return view('products.public.show')
                ->with('product', $product)
                ->with('bids', $this->allBids['bids'])
                ->with('highestBid', $this->allBids['highestBid'])
                ->with('lowestBid', $this->allBids['lowestBid'])
                ->with('averageBid', $this->allBids['averageBid'])
                ->with('userBid', $userBid);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //dd('Show');
        //DISPATCH THE VIEWCOUNT EVENT TO INCREMENT THE PRODUCT VIEW COUNT
        event(new ViewCount($product));

        //GET ALL THE EXISTING BIDS WITH A LOCAL METHOD - THEN YOU CAN USE THE $allBids array
        $this->getAllBids($product->id);

        //GET THE USERS BID

        $userBid = false;

        if(Auth::id())
        {
            $userBid = Bid::where('product_id', $product->id)->where('user_id', Auth::id())->first();
        }

        return view('products.public.show')
            ->with('product', $product)
            ->with('bids', $this->allBids['bids'])
            ->with('highestBid', $this->allBids['highestBid'])
            ->with('lowestBid', $this->allBids['lowestBid'])
            ->with('averageBid', $this->allBids['averageBid'])
            ->with('userBid', $userBid);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Array that holds all the bids
     */

    public $allBids;

    /**
     * A central method to get all the cuurrent bids
     *
     * @param  int  $productId
     */

    public function getAllBids($productId)
    {
        $this->allBids['bids'] = false;
        $this->allBids['highestBid'] = false;
        $this->allBids['lowestBid'] = false;
        $this->allBids['averageBid'] = false;

        //GET ALL THE EXISTING BIDS
        $bids = Bid::where('product_id', $productId)->orderBy('amount', 'DESC')->get();

        if(count($bids) > 0){
            //ALL bids
            $this->allBids['bids'] = $bids;

            //Highest bid
            $highestBid = $bids[0]->amount;
            $this->allBids['highestBid'] = $highestBid;

            //Lowest bid
            $lowestBid = $bids[count($bids)-1]->amount;
            $this->allBids['lowestBid'] = $lowestBid;

            //Average bid
            $averageBid = 0;
            for ($x = 0; $x < count($bids); $x++) {
                $averageBid = $averageBid + (int)$bids[$x]->amount;
            }
            $averageBid = $averageBid / count($bids);
            $this->allBids['averageBid'] = $averageBid;
        }
    }
}
