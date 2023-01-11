<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $medu_id = $request->input('menu_id');
        $user_id = auth()->id();
        $newCart = new Cart();
        $newCart->user_id = $user_id;
        $newCart->menu_id = $medu_id;
        $newCart->save();

        $carts = auth()->user()->carts()->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.*', 'menus.title')->get();

        return response()->json([
            'status'=>200,
            'carts'=>$carts
        ]);
    }

    /**
     * Read cart items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function read(Request $request)
    {
        $carts = auth()->user()->carts()->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.*', 'menus.title')->get();

        return response()->json([
            'status'=>200,
            'carts'=>$carts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove cart
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function remove($cart)
    {
        $find_cart = Cart::find($cart);
        $find_cart->delete();
        $carts = auth()->user()->carts()->get();
        return response()->json([
            'status'=>200,
            'carts'=>$carts
        ]);
    }
}
