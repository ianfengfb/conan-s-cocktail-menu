@extends('layouts.customer-layout')

@section('style')

<style>

</style>
    
@endsection

@section('content')
@include('partials._search_customer')
<div class="container">
    <div class="row">
        @foreach ($menus as $menu)  
        <div class="col-12 col-md-4 col-sm-6 mt-3">
            <div class="card">
                <img src="{{$menu->photo ? asset('storage/' . $menu->photo) : asset('/images/cocktails.jpeg')}}" class="card-img-top" alt="cocktail">
                <div class="card-body">
                  <h5 class="card-title tw-text-2xl">{{$menu->title}}</h5>
                </div>
                <ul class="list-group list-group-flush" style="display: none" id="oliphant_id_description_{{$menu->id}}">
                  <li class="list-group-item">{{$menu->description}}</li>
                </ul>
                <div class="card-body">
                    @if ($menu->available)
                    <button class="btn tw-bg-oliphant hover:tw-bg-oliphant tw-text-white tw-rounded tw-py-2 tw-px-4 oliphant_class_add_to_cart" value="{{$menu->id}}">
                        Add to cart
                    </button>
                    @else
                    <button class="btn tw-bg-disable tw-text-white tw-rounded tw-py-2 tw-px-4" disabled>
                        Out of stock
                    </button>
                    @endif 
                    <button class="btn tw-bg-laravel hover:tw-bg-laravel tw-text-white tw-rounded tw-py-2 tw-px-4 oliphant_class_show_description" value="{{$menu->id}}">
                        Show/Hide description
                    </button>       
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>

<div class="tw-mt-6 tw-p-4 tw-text-xs">
    {{$menus->links()}}
</div>
@endsection

@section('script')
    <script>
        $('.oliphant_class_add_to_cart').on('click', function(e){
        $('#CartModal').modal('show');
        $('#oliphant_id_cart_list').empty();
        // var cart_number = $('#oliphant_id_cart_btn').val();
        var data = {
        'menu_id': $(this).val(),
    }
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/cart/create",
        data: data,
        success: function (response) {
            if (response.carts.length == 1) {
                $('#oliphant_id_place_order').removeClass('tw-bg-disable');
                $('#oliphant_id_place_order').addClass('tw-bg-laravel hover:tw-bg-dark');
                $('#oliphant_id_place_order').prop("disabled", false);
            }
            $('#oliphant_id_cart_btn').html('<i class="fa-solid fa-martini-glass"></i>'+response.carts.length);
            response.carts.forEach(element => {
                $('#oliphant_id_cart_list').append('<li value=' + element.menu_id + '>' + element.title+ '<span class="float-end" data-id='+element.id+'> X 1<i class="fa-solid fa-martini-glass"></i><i class="fa-solid fa-trash ms-5 oliphant_class_cart_list"></span></li>');
            });
        }
    });
        })

        $('.oliphant_class_show_description').on('click', function(e){
            var id = $(this).val();
            $('#oliphant_id_description_'+id).toggle();
        })
    </script>
@endsection