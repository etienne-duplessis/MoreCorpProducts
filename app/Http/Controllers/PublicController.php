<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Http\Requests\BidRequest;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('products.public.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidRequest $request)
    {
        $inputs = $request->all();

//        dd($inputs);

        $bid = new Bid();
        $bid->user_id = $inputs['user_id'];
        $bid->product_id = $inputs['product_id'];
        $bid->amount = $inputs['amount'];
        $bid->save();

        session()->flash('message', 'Your bid has been placed!');

        return redirect('/public/products/' . $bid->product_id, compact('hasBid'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $bids = Bid::where('product_id', $product->id)->orderBy('amount', 'DESC')->get();

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

        $userBid = null;

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
}
