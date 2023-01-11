@extends('layouts.conan-layout')

@section('content')
<x-card class="tw-p-10">
    <header>
      <h1 class="tw-text-2xl tw-text-center tw-font-bold tw-my-6 tw-uppercase">
        All orders
      </h1>
    </header>

    <table class="tw-w-full tw-table-auto tw-rounded-sm">
      <tbody>
        @unless($orders->isEmpty())
        <tr class="tw-border-gray-300 tw-font-bold">
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
                <p>Cocktail name</p>
            </td>
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
                <p>Order time</p>
            </td>
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
                <p>Order by</p>
            </td>
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
                <p>Status</p>
            </td>
        </tr>
        @foreach($orders as $order)
        <tr class="tw-border-gray-300">
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
            <p>{{$order->title}}</p>
          </td>
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
            <p>{{$order->created_at}}</p>
          </td>
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
            <p>{{$order->name}}</p>
          </td>
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-xs">
            @if ($order->status == 0)
            <p>Wait for accept</p>
            @elseif($order->status == 1)
            <p>In progress</p>
            @elseif($order->status == 2)
            <p>Ready</p>
            @elseif($order->status == 3)
            <p>Completed</p>
            @else
            <p>Cancelled</p>
            @endif
          </td>
          {{-- <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <form method="POST" action="/orders/{{$order->id}}">
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
            <p class="tw-text-center">No Orders Found</p>
          </td>
        </tr>
        @endunless

      </tbody>
    </table>
  </x-card>
@endsection