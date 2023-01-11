<?php

namespace App\Http\Controllers;

use App\Events\OrderChangeEvent;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\OrderPlaceEvent;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::join('menus', 'orders.menu_id', '=', 'menus.id')->join('users', 'orders.user_id', '=', 'users.id')->select('orders.*', 'menus.title', 'users.name')->orderBy('created_at', 'DESC')->get();
        return view('conans.order', ['orders' => $orders]);
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
        $id_list = $request->input('id_list');
        $user_id = auth()->id();
        $user_name = auth()->user()->name;

        foreach ($id_list as $id) {
            $newOrder = new Order();
            $newOrder->user_id = $user_id;
            $newOrder->menu_id = $id;
            $newOrder->save();

            $find_menu = Menu::find($id);
            event(new OrderPlaceEvent($user_name ,$find_menu->title));
        }
        auth()->user()->carts()->delete();


        return response()->json([
            'status'=>200,
            'message'=>'The orders have been succesfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

     /**
     * Show conan cocktails page
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function cocktails(Request $request)
    {
        $cocktails = Order::where('status', 3)->join('menus', 'orders.menu_id', '=', 'menus.id')->select(Order::raw('count(*) as cocktail_count, menu_id'), 'menus.title')->groupBy('menu_id')->orderBy('cocktail_count', 'desc')->get();
        return view('conans.cocktail', ['cocktails' => $cocktails]);
    }

     /**
     * Show conan customers page
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function customers(Request $request)
    {
        $customers = Order::where('status', 3)->join('users', 'orders.user_id', '=', 'users.id')->select(Order::raw('count(*) as customer_count, user_id'), 'users.name')->groupBy('user_id')->orderBy('customer_count', 'desc')->get();
        return view('conans.customer', ['customers' => $customers]);
    }

     /**
     * Show conan single customer
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function single_customer($customer)
    {
        $find_customer = User::find($customer);
        $cocktails = $find_customer->orders()->where('status', 3)->join('menus', 'orders.menu_id', '=', 'menus.id')->select(Order::raw('count(*) as cocktail_count, menu_id'), 'menus.title')->groupBy('menu_id')->orderBy('cocktail_count', 'desc')->get();
        return view('conans.single_customer', ['cocktails' => $cocktails, 'user_name' => $find_customer->name]);
    }

    /**
     * Show workshop page
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function workshop(Request $request)
    {
        $orders = Order::where('status',0)->orWhere('status', 1)->orWhere('status', 2)->join('menus', 'orders.menu_id', '=', 'menus.id')->join('users', 'orders.user_id', '=', 'users.id')->select('orders.*', 'menus.title', 'users.name')->get();
        return view('conans.workshop', ['orders' => $orders]);
    }

    /**
     * Accept an order
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {

        $find_order = Order::find($id);
        $find_menu = Menu::find($find_order->menu_id);
        if ($find_order->status == 0) {
            $find_order->status = 1;
            $find_order->update();
            event(new OrderChangeEvent('in progress!', $find_menu->title, $find_order->user_id));
        }
        return response()->json([
            'status'=>200,
            'message'=>'Order accepted'
        ]);
    }

    /**
     * Decline an order
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function decline($id)
    {

        $find_order = Order::find($id);
        $find_menu = Menu::find($find_order->menu_id);
            $find_order->status = 4;
            $find_order->update();
            event(new OrderChangeEvent('canceled!', $find_menu->title, $find_order->user_id));
        return response()->json([
            'status'=>200,
            'message'=>'Order declined'
        ]);
    }

    /**
     * ready an order
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function ready($id)
    {

        $find_order = Order::find($id);
        $find_menu = Menu::find($find_order->menu_id);
        if ($find_order->status == 1) {
            $find_order->status = 2;
            $find_order->update();
            event(new OrderChangeEvent('ready to pick up!', $find_menu->title, $find_order->user_id));
        }
        return response()->json([
            'status'=>200,
            'message'=>'Order is ready'
        ]);
    }

    /**
     * picked_up an order
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function picked_up($id)
    {

        $find_order = Order::find($id);
        $find_menu = Menu::find($find_order->menu_id);
        if ($find_order->status == 2) {
            $find_order->status = 3;
            $find_order->update();
            event(new OrderChangeEvent('completed!', $find_menu->title, $find_order->user_id));
        }
        return response()->json([
            'status'=>200,
            'message'=>'Order is picked_up'
        ]);
    }

    
    /**
     * Show customer order page
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function customer_order(Request $request)
    {
        $orders = auth()->user()->orders()->join('menus', 'orders.menu_id', '=', 'menus.id')->select('orders.*', 'menus.title')->orderBy('created_at', 'DESC')->get();
        return view('customers.order', ['orders' => $orders]);
    }
        
    // /**
    //  * show test notifications
    //  *
    //  * @param  \App\Models\Order  $order
    //  * @return \Illuminate\Http\Response
    //  */
    // public function test()
    // {
    //     return view ('customers.test');
    // }
        
    // /**
    //  * test notifications
    //  *
    //  * @param  \App\Models\Order  $order
    //  * @return \Illuminate\Http\Response
    //  */
    // public function fire(Request $request)
    // {
    //     $name = request()->name;

    //     event(new OrderPlaceEvent($name));
    // }
}
