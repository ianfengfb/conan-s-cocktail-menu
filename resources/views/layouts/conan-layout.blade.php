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
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

    var channel = pusher.subscribe('popup-channel');
    channel.bind('order-placed', function(data) {
      $("#oliphant_id_workshop_table").load(location.href+" #oliphant_id_workshop_table>*","");

      toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "10000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

toastr.options.onclick = function() { window.location.href = "/workshop"; }
      // Display a success toast, with a title
      toastr.success(JSON.stringify(data.title), 'You have an new order from'+JSON.stringify(data.name)+ ':',)
    });
  </script>
        @yield('style')
    </head>
    <body class="tw-mb-48">
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
                        <a class="nav-link" href="/workshop">Workshop</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         Menu
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/menus/create">Add new item</a></li>
                          <li><a class="dropdown-item" href="/menus">Manage menu</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/orders">Orders</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/cocktails">Cocktails</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/customers">Customers</a>
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
                    <p class="tw-ml-2">Conan's Cocktail Menu &copy; 2023, All Rights reserved</p>
                
            </footer>
        <!-- page-wrapper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        @yield('script')
    </body>
</html>