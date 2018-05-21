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

        //GET ALL THE EXISTING BIDS
        $bids = Bid::where('product_id', $inputs['product_id'])->orderBy('amount', 'DESC')->get();

        if(count($bids) > 0){
            //Highest bid
            $highestBid = $bids[0]->amount;

            //Lowest bid
            $lowestBid = $bids[count($bids)-1]->amount;

            //Average bid
            $averageBid = 0;
            for ($x = 0; $x < count($bids); $x++) {
                $averageBid = $averageBid + (int)$bids[$x]->amount;
            }
            $averageBid = $averageBid / count($bids);
        }

        //GET THE PRODUCT

        $product = Product::where('id', $inputs['product_id'])->first();

        //GET THE USERS BID

        $userBid = $bid;

//        dd($userBid);

        return view('products.public.show', compact('product', 'bids', 'highestBid', 'lowestBid', 'averageBid', 'userBid'));

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

            //GET ALL THE EXISTING BIDS
            $bids = Bid::where('product_id', $inputs['product_id'])->orderBy('amount', 'DESC')->get();

            //dd($bids);

            if(count($bids) > 0){
                //Highest bid
                $highestBid = $bids[0]->amount;

                //Lowest bid
                $lowestBid = $bids[count($bids)-1]->amount;

                //Average bid
                $averageBid = 0;
                for ($x = 0; $x < count($bids); $x++) {
                    $averageBid = $averageBid + (int)$bids[$x]->amount;
                }
                $averageBid = $averageBid / count($bids);
            }
            session()->flash('message', 'Each user is only allowed to place a single bid per product!');

            return view('products.public.show', compact('product', 'bids', 'highestBid', 'lowestBid', 'averageBid', 'userBid'));
        }else{
            //dd('There is not user bid');
            $bid = new Bid();
            $bid->user_id = $inputs['user_id'];
            $bid->product_id = $inputs['product_id'];
            $bid->amount = $inputs['amount'];
            $bid->save();

            //Set the user bid

            $userBid = $bid;

            //GET ALL THE EXISTING BIDS
            $bids = Bid::where('product_id', $inputs['product_id'])->orderBy('amount', 'DESC')->get();

            //dd($bids);

            if(count($bids) > 0){
                //Highest bid
                $highestBid = $bids[0]->amount;

                //Lowest bid
                $lowestBid = $bids[count($bids)-1]->amount;

                //Average bid
                $averageBid = 0;
                for ($x = 0; $x < count($bids); $x++) {
                    $averageBid = $averageBid + (int)$bids[$x]->amount;
                }
                $averageBid = $averageBid / count($bids);
            }

            session()->flash('message', 'Your bid has been placed!');

            return view('products.public.show', compact('product', 'bids', 'highestBid', 'lowestBid', 'averageBid', 'userBid'));
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

        //GET ALL THE EXISTING BIDS
        $bids = Bid::where('product_id', $product->id)->orderBy('amount', 'DESC')->get();

        if(count($bids) > 0){
            //Highest bid
            $highestBid = $bids[0]->amount;

            //Lowest bid
            $lowestBid = $bids[count($bids)-1]->amount;

            //dd($bids);

            //Average bid
            $averageBid = 0;
            for ($x = 0; $x < count($bids); $x++) {
                $averageBid = $averageBid + (int)$bids[$x]->amount;
            }
            $averageBid = $averageBid / count($bids);
        }

        //GET THE USERS BID

        $userBid = false;

        if(Auth::id())
        {
            $userBid = Bid::where('product_id', $product->id)->where('user_id', Auth::id())->first();
        }

//        dd($userBid);

        return view('products.public.show', compact('product', 'bids', 'highestBid', 'lowestBid', 'averageBid', 'userBid'));
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

//    public function getAllBids($productId)
//    {
//        $this->bids = Bid::where('product_id', $productId)->orderBy('amount', 'DESC')->get();
//
//        if(count($this->bids) > 0){
//            //Highest bid
//            $this->highestBid = $this->bids[0]->amount;
//
//            //Lowest bid
//            $this->lowestBid = $this->bids[count($this->bids)-1]->amount;
//
//            //Average bid
//            $this->averageBid = 0;
//            for ($x = 0; $x < count($this->bids); $x++) {
//                $this->averageBid = $this->averageBid + (int)$this->bids[$x]->amount;
//            }
//            $this->averageBid = $this->averageBid / count($this->bids);
//        }
//    }
}
