@extends('layouts.conan-layout')

@section('style')
    <style>
      table a {
        color: red;
      }
    </style>
@endsection

@section('content')
<x-card class="tw-p-10">
    <header>
      <h1 class="tw-text-2xl tw-text-center tw-font-bold tw-my-6 tw-uppercase">
        All cusotmers
      </h1>
    </header>

    <table class="tw-w-full tw-table-auto tw-rounded-sm">
      <tbody>
        @unless($customers->isEmpty())
        <tr class="tw-border-gray-300 tw-font-bold">
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
                <p>Customer name</p>
            </td>
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
                <p>Ordered times</p>
            </td>
        </tr>
        @foreach($customers as $customer)
        <tr class="tw-border-gray-300">
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <a href="/customers/{{$customer->user_id}}">{{$customer->name}}</a>
          </td>
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <p>{{$customer->customer_count}}</p>
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
            <p class="tw-text-center">No Customer Found</p>
          </td>
        </tr>
        @endunless

      </tbody>
    </table>
  </x-card>
@endsection