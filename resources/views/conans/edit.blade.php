@extends('layouts.conan-layout')

@section('style')
    <style>
        .conan-title{
            font-family: 'Pacifico', cursive;
        }
    </style>
@endsection

@section('content')

<x-card class="tw-p-10 tw-max-w-lg tw-mx-auto tw-mt-24">
    <header class="tw-text-center">
      <h2 class="tw-text-2xl tw-font-bold tw-mb-1 conan-title">Conan's cocktail menu</h2>
      <p class="tw-mb-4">Edit: {{$menu->title}}</p>
    </header>

    <form method="POST" action="/menus/{{$menu->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="tw-mb-6">
        <label for="title" class="tw-inline-block tw-text-lg tw-mb-2">Cocktail title</label>
        <input type="text" class="tw-border tw-border-gray-200 tw-rounded tw-p-2 tw-w-full" name="title"
          value="{{$menu->title}}" />

        @error('title')
        <p class="tw-text-red-500 tw-text-xs tw-mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="tw-mb-6">
        <label for="photo" class="tw-inline-block tw-text-lg tw-mb-2">
          Cocoktail photo
        </label>
        <input type="file" class="tw-border tw-border-gray-200 tw-rounded tw-p-2 tw-w-full" name="photo" />

        <img class="tw-w-48 tw-mr-6 tw-mb-6"
          src="{{$menu->photo ? asset('storage/' . $menu->photo) : asset('/images/cocktails.jpeg')}}" alt="" />

        @error('photo')
        <p class="tw-text-red-500 tw-text-xs tw-mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="tw-mb-6">
        <label for="description" class="tw-inline-block tw-text-lg tw-mb-2">
          Short Description (optional)
        </label>
        <textarea class="tw-border tw-border-gray-200 tw-rounded tw-p-2 tw-w-full" name="description" rows="5"
          placeholder="Leave a short description here...">{{$menu->description}}</textarea>

        @error('description')
        <p class="tw-text-red-500 tw-text-xs tw-mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="tw-mb-6">
        <label for="recipe" class="tw-inline-block tw-text-lg tw-mb-2">
          Cocoktail recipe (optional)
        </label>
        <textarea class="tw-border tw-border-gray-200 tw-rounded tw-p-2 tw-w-full" name="recipe" rows="5"
          placeholder="Put cocktail recipe here...">{{$menu->recipe}}</textarea>

        @error('recipe')
        <p class="tw-text-red-500 tw-text-xs tw-mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="tw-mb-6">
        <label for="position" class="tw-inline-block tw-text-lg tw-mb-2">Position in the menu</label>
        <input type="text" class="tw-border tw-border-gray-200 tw-rounded tw-p-2 tw-w-full" name="position"
          value="{{$menu->position}}" />

        @error('position')
        <p class="tw-text-red-500 tw-text-xs tw-mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="tw-mb-6">
        <button class="tw-bg-oliphant tw-text-white tw-rounded tw-py-2 tw-px-4 hover:tw-bg-black">
          Update Item
        </button>

        <a href="/" class="tw-text-black tw-ml-4"> Cancel </a>
      </div>
    </form>
  </x-card>
    
@endsection