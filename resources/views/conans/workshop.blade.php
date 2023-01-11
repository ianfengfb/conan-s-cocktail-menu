@extends('layouts.conan-layout')

@section('style')
    <style>
        .recipe_link {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
{{-- Cancel Modal --}}
<div class="modal fade" id="CancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="CancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>All you sure to cancel the order?</b></h5>
                <input type="hidden" id="oliphant_id_order_id">
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-footer">
                <button class="tw-bg-laravel tw-text-white tw-rounded tw-py-2 tw-px-4 hover:tw-bg-dark oliphant_class_confirm_decline">Yes</button>
                <button class="tw-bg-oliphant tw-text-white tw-rounded tw-py-2 tw-px-4 hover:tw-bg-black"  data-bs-dismiss="modal">No</button>
            </div>

        </div>
    </div>
</div>
{{-- Recipe Modal --}}
<div class="modal fade" id="RecipeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="RecipeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b id="oliphant_id_recipe_title"></b></h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <p id="oliphant_id_recipe_content"></p>
            </div>
            <div class="modal-footer">
                <button class="tw-bg-oliphant tw-text-white tw-rounded tw-py-2 tw-px-4 hover:tw-bg-black" data-bs-dismiss="modal">ok</button>
            </div>

        </div>
    </div>
</div>
<x-card class="tw-p-10">
    <header>
      <h1 class="tw-text-2xl tw-text-center tw-font-bold tw-my-6 tw-uppercase">
        Conan's cocktail Workshop
      </h1>
    </header>

    <table class="tw-w-full tw-table-auto tw-rounded-sm" id="oliphant_id_workshop_table">
      <tbody>
        @unless($orders->isEmpty())
        <tr class="tw-border-gray-300 tw-font-bold">
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
                <p>Cocktail name</p>
            </td>
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
                <p>Order by</p>
            </td>
            <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
                <p>Action</p>
            </td>
        </tr>
        @foreach($orders as $order)
        <tr class="tw-border-gray-300">
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <p class="recipe_link">{{$order->title}}</p>
          </td>
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300 tw-text-sm">
            <p>{{$order->name}}</p>
          </td>
          <td class="tw-px-4 tw-py-8 tw-border-t tw-border-b tw-border-gray-300">
            @if ($order->status == 0)
            <button class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-text-xs tw-mb-2 oliphant_class_accept" value="{{$order->id}}">Accept</button>
            <button class="btn tw-bg-laravel hover:tw-bg-dark tw-text-white tw-text-xs oliphant_class_decline" value="{{$order->id}}">Decline</button>
            @elseif($order->status == 1)
            <button class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-text-xs tw-mb-2 oliphant_class_ready" value="{{$order->id}}">Ready</button>
            <button class="btn tw-bg-laravel hover:tw-bg-dark tw-text-white tw-text-xs oliphant_class_decline" value="{{$order->id}}">Cancel</button>
            @else
            <button class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-text-xs tw-mb-2 oliphant_class_picked_up" value="{{$order->id}}">Picked up</button>
            <button class="btn tw-bg-laravel hover:tw-bg-dark tw-text-white tw-text-xs oliphant_class_decline" value="{{$order->id}}">Cancel</button>
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
            <img src="{{asset('images/lying.jpeg')}}" alt="chill" class="tw-mx-auto">
          </td>
        </tr>
        @endunless

      </tbody>
    </table>
  </x-card>
@endsection

@section('script')
<script>
     // recipe modal
     $('.recipe_link').on('click', function(e){
        $('#RecipeModal').modal('show');
        var title = $(this).text();
        $('#oliphant_id_recipe_title').html(title+' recipe');
        var data = {
            'title': title,
        }
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: '/menus/recipe',
        data: data,
        dataType: "json",
        success: function (response) {
                if (response.recipe) {
                    $('#oliphant_id_recipe_content').html(response.recipe);
                } else {
                    $('#oliphant_id_recipe_content').html('No recipe for this item.');
                }
            }
         });
      })

    // accept an order
        $('.oliphant_class_accept').on('click', function(e){
            e.preventDefault();

            var id = $(this).val();
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: '/orders/accept/'+id,
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                location.reload();
            }
        }
    });
        })

         // show decline modal
         $('.oliphant_class_decline').on('click', function(e){
            e.preventDefault();

            $('#CancelModal').modal('show');

            $('#oliphant_id_order_id').val($(this).val());
         })

        // decline an order
        $('.oliphant_class_confirm_decline').on('click', function(e){
            e.preventDefault();

            var id = $('#oliphant_id_order_id').val();
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: '/orders/decline/'+id,
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                location.reload();
            }
        }
    });
        })

        // ready an order
        $('.oliphant_class_ready').on('click', function(e){
            e.preventDefault();

            var id = $(this).val();
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: '/orders/ready/'+id,
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                location.reload();
            }
        }
    });
        })

        // picked_up an order
        $('.oliphant_class_picked_up').on('click', function(e){
            e.preventDefault();

            var id = $(this).val();
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: '/orders/picked_up/'+id,
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                location.reload();
            }
        }
    });
        })
</script>
    
@endsection