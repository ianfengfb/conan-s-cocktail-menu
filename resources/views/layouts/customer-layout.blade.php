<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('/layouts/css/conan-layout.css?v=').time()}}">
        <script src="https://kit.fontawesome.com/29c59cdb8b.js" crossorigin="anonymous"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#2770e5",
                            oliphant: '#ef3b2d',
                            dark: '#003dd8',
                            disable: '#a9a7a7',
                            drop: '#515050',
                        },
                    },
                },
                prefix: 'tw-',
            };
        </script>
        <title>Conan's Cocktail Menu</title>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('948a9691e60a83dd0ca4', {
      cluster: 'ap4'
    });

    var channel = pusher.subscribe('popup-customer-channel');
    channel.bind('order-changed', function(data) {
        $("#oliphant_id_customer_table").load(location.href+" #oliphant_id_customer_table>*","");

        if(JSON.stringify(data.id) == {{auth()->id()}}) {
            toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

toastr.options.onclick = function() { window.location.href = "/customer/orders"; }
      // Display a success toast, with a title
      toastr.success(JSON.stringify(data.status), 'Your order '+JSON.stringify(data.title)+ 'is now',)
        }
    });
  </script>
        @yield('style')
    </head>
    <body class="tw-mb-48">
        @php
            $cart = auth()->user()->carts()->get();
            $cart_number = count($cart);
            $btn_disable = $cart_number == 0 ? 'disabled' : '';
            $btn_bg = $cart_number == 0 ? 'tw-bg-disable' : 'tw-bg-laravel';
            $btn_hover = $cart_number == 0 ? '' : 'hover:tw-bg-dark';
        @endphp
            <nav class="navbar navbar-expand-lg tw-bg-oliphant">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="{{asset('images/favicon.jpg')}}" width="30" height="24">
                      </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                      <li class="nav-item">
                        <a class="nav-link" href="/customer/menus">Cocktail menu</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/customer/orders">My orders</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#"><form class="inline" method="POST" action="/logout">
                            @csrf
                            <button type="submit">
                              <i class="fa-solid fa-door-closed"></i> Logout
                            </button>
                          </form></a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
{{-- Cart Modal --}}
<div class="modal fade" id="CartModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="CartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Your cart</b></h5>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="sharing group" id="oliphant_id_addnew_form_group_list">
                <ul id="oliphant_id_cart_list"></ul>
            </div>
            <div class="modal-footer">
                <button class="tw-bg-oliphant tw-text-white tw-rounded tw-py-2 tw-px-4 hover:tw-bg-black"  data-bs-dismiss="modal">Add more</button>
                <button class="{{$btn_bg}} tw-text-white tw-rounded tw-py-2 tw-px-4 {{$btn_hover}}" id="oliphant_id_place_order" {{$btn_disable}}>Place order</button>
            </div>

        </div>
    </div>
</div>
            <main class="page-content">
                <div class="content-box">
                        
                    <div class="content-container">
                        <x-flash-message />
                        {{-- View Output --}}
                        @yield('content')
                    </div>
                </div>
            </main>
            <footer
                    class="tw-fixed tw-bottom-0 tw-left-0 tw-w-full tw-flex tw-items-center tw-justify-start tw-font-bold tw-bg-oliphant tw-text-white tw-h-24 tw-mt-24 tw-opacity-90 md:tw-justify-center">
                    <div class="tw-flex tw-flex-col tw-items-center">
                        <p class="tw-ml-2">Conan's Cocktail Menu &copy; 2023</p>
                        <p class="tw-ml-2">All Rights reserved</p>
                    </div>

                    <button class="tw-absolute tw-top-1/3 tw-right-10 tw-text-2xl tw-bg-black tw-text-white tw-py-2 tw-px-5" id="oliphant_id_cart_btn"><i class="fa-solid fa-martini-glass"></i>{{$cart_number}}</button>
                    
                
            </footer>
        <!-- page-wrapper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            <script>
                $('#oliphant_id_cart_btn').on('click', function(e){
                e.preventDefault();
                $('#CartModal').modal('show');
                $('#oliphant_id_cart_list').empty();

                    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                type: "POST",
                url: "/cart/read",
                success: function (response) {
                    if(response.carts.length == 0) {
                        $('#oliphant_id_cart_list').append('<li>Your cart is empty</li>');
                    } else {
                        response.carts.forEach(element => {
                        $('#oliphant_id_cart_list').append('<li value=' + element.menu_id + '>' + element.title+ '<span class="float-end"> X 1<i class="fa-solid fa-martini-glass"></i></span></li>');
                    });
                    } 
                }
            });
            })

            $('#oliphant_id_place_order').on('click', function(e){
                e.preventDefault();
                var id_list = [];
                $('#oliphant_id_cart_list li').each(function () {
                id_list.push($(this).val());
                });

                var data = {
                    'id_list': id_list,
                };

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                type: "POST",
                url: "/order/create",
                data:data,
                success: function (response) {
                    if(response.status == 200) {
                        window.location.href = '/customer/orders';
                    } 
                }
            });                
            })

            </script>
        @yield('script')
    </body>
</html>