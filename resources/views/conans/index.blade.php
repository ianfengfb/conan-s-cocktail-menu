@extends('layouts.conan-layout')

@section('style')

<style>
    .create_link {
        color: red;
        text-decoration: underline;
    }
</style>
    
@endsection

@section('content')
@include('partials._search_conan')
@unless($menus->isEmpty())
<div class="container">
    <div class="row">
        @foreach ($menus as $menu)  
        <div class="col-12 col-md-6 col-sm-4 mt-3">
            <div class="card">
                <img src="{{$menu->photo ? asset('storage/' . $menu->photo) : asset('/images/cocktails.jpeg')}}" class="card-img-top" alt="cocktail">
                <div class="card-body">
                  <h5 class="card-title tw-text-2xl">{{$menu->title}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Position: {{$menu->position}}</li>
                </ul>
                <div class="card-body">
                    <form method="POST" action="/menus/{{$menu->id}}/available" class="tw-inline">
                        @csrf
                        @if ($menu->available)
                        <button class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-rounded tw-py-2 tw-px-4">
                            Available
                        </button>
                            @else
                            <button class="btn tw-bg-laravel hover:tw-bg-dark tw-text-white tw-rounded tw-py-2 tw-px-4">
                                unavailable
                            </button>
                            @endif
                        
                    </form>
                    <a href="/menus/{{$menu->id}}/edit" class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-rounded tw-py-2 tw-px-4">Edit</a>
                    <form method="POST" action="/menus/{{$menu->id}}" class="tw-inline">
                        @csrf
                        @method('DELETE')
                    <button class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-rounded tw-py-2 tw-px-4">Delete</button>
                    </form>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>
@else
<x-card>
    <p>You have no item in the menu yet.</p>
    <p>Add an item <a href="/menus/create" class="create_link">here</a>.</p>
</x-card>
@endunless

<div class="tw-mt-6 tw-p-4 tw-text-xs">
    {{$menus->links()}}
</div>
    
@endsection