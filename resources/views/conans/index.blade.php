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

{{-- Delete Modal --}}
<div class="modal fade" id="DeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>All you sure to remove the itme from the memu?</b></h5>
                <input type="hidden" id="oliphant_id_item_id">
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-footer">
                <button class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-rounded tw-py-2 tw-px-4" id="oliphant_id_confirm_delete">Delete</button>
                <button class="tw-bg-laravel tw-text-white tw-rounded tw-py-2 tw-px-4 hover:tw-bg-black"  data-bs-dismiss="modal">No</button>
            </div>

        </div>
    </div>
</div>
@unless($menus->isEmpty())
<div class="container">
    <div class="row">
        @foreach ($menus as $menu)  
        <div class="col-12 col-md-4 col-sm-6 mt-3">
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
                    <button class="btn tw-bg-oliphant hover:tw-bg-black tw-text-white tw-rounded tw-py-2 tw-px-4 oliphant_class_delete_item" value="{{$menu->id}}">Delete</button>
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

@section('script')
    <script>
        $('.oliphant_class_delete_item').on('click', function(e){
            e.preventDefault();
            $('#DeleteModal').modal('show');
            var id = $(this).val();
            $('#oliphant_id_item_id').val(id);
        })

        $('#oliphant_id_confirm_delete').on('click', function(e){
            e.preventDefault();
            var id = $('#oliphant_id_item_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                type: "DELETE",
                url: "/menus/"+id,
                success: function (response) {
                    if(response.status == 200) {
                       location.reload();
                    } 
                }
            });  
        })
    </script>
@endsection