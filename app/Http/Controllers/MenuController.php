<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->email == 'conan@conan.com') {
            $menus = Menu::filter(request(['search']))->orderBy('position')->simplePaginate(5);
            return view('conans.index', ['menus' => $menus]);
        } else {
            return redirect('/customer/menus');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $max_position = Menu::max('position');
        return view('conans.create', ['max_position' => $max_position]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'position' => 'required',
        ]);

        if($request->hasFile('photo')) {
            $formFields['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $formFields['description'] = $request->input('description');
        $formFields['recipe'] = $request->input('recipe');

        Menu::create($formFields);

        return redirect('/menus')->with('message', 'Item added to the menu successfully!');
    }

    /**
     * Read recipe
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function recipe(Request $request)
    {
        $title = $request->input('title');

        $find_menu = Menu::where('title','=',$title)->first();
        return response()->json([
            'status'=>200,
            'recipe'=>$find_menu->recipe
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('conans.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'position' => 'required',
        ]);

        if($request->hasFile('photo')) {
            $formFields['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $formFields['description'] = $request->input('description');
        $formFields['recipe'] = $request->input('recipe');

        $menu->update($formFields);

        return back()->with('message', 'Menu updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Item removed from the menu'
        ]);
    }

      /**
     * Update item available.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function available(Request $request, Menu $menu)
    {
        $menu->available = !$menu->available;
        $menu->save();

        return back()->with('message', 'Item availability updated successfully!');
    }

    /**
     * Display customer menus.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer_menu()
    {
        if (auth()->user()->email == 'conan@conan.com') {
            return redirect('/menus');
        } else {
            $menus = Menu::filter(request(['search']))->orderBy('position')->simplePaginate(5);
            return view('customers.index', ['menus' => $menus]);
        }
    }
}
