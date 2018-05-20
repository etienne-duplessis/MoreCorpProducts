<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Create a new articles controller instance.
     * ArticlesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('products.admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //dd($request);
        $inputs = $request->all();


        auth()->user()->publishProduct(
            new Product($inputs)
        );

        session()->flash('message', 'Your product has been published.');

        return redirect('/admin');
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

        return view('products.admin.show', compact('product', 'bids', 'highestBid', 'lowestBid', 'averageBid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.admin.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductRequest $request)
    {
        $product->update($request->all());

        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        session()->flash('message', 'Your product has been deleted.');

        return redirect('/admin');
    }
}
