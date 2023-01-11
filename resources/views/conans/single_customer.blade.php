@extends('layouts.conan-layout')

@section('content')
<x-card class="tw-p-10">
    <header>
      <h1 class="tw-text-2xl tw-text-center tw-font-bold tw-my-6 tw-uppercase">
        {{$user_name}}'s cocktail list
      </h1>
    </header>

    <table class="tw-w-full tw-table-auto tw-rounded-sm">
      <tbody>
        @unless($cocktails->isEmpty())
        <tr class="tw-border-gray-300 tw-font-bold">
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
                <p>Cocktail name</p>
            </td>
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
                <p>Ordered times</p>
            </td>
        </tr>
        @foreach($cocktails as $cocktail)
        <tr class="tw-border-gray-300">
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <p>{{$cocktail->title}}</p>
          </td>
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <p>{{$cocktail->cocktail_count}}</p>
          </td>
          {{-- <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <form method="POST" action="/cocktails/{{$order->id}}">
              @csrf
              @method('DELETE')
              <button class="tw-text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
          </td> --}}
        </tr>
        @endforeach
        @else
        <tr class="tw-border-gray-300">
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-lg">
            <p class="tw-text-center">No Completed Orders Found</p>
          </td>
        </tr>
        @endunless

      </tbody>
    </table>
  </x-card>
@endsection