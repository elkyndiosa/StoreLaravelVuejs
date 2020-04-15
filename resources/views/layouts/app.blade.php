<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Delivery</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e75ef2cea1.js" crossorigin="anonymous"></script>
        <link  href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link  href=" {{ asset('css/toastr.css') }}" rel="stylesheet">
        <link  href="{{ asset('css/styles.css') }}" rel="stylesheet">


        <!-- Styles -->
    </head>
    <body>
        <div id="home">
            <nav class="navbar navbar-expand navbar-dark bg-dark shadow-sm sticky-top">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Delivery
                    </a>



                    <div class="collapse navbar-collapse" id="navbarR">


                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item d-none d-sm-block">
                                <a class="nav-link" href="{{ route('user.index') }}">{{ Auth::user()->name }}</a>
                            </li>
                            @if(isset($nav))
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#shoppingCart" v-on:click='getCart'><i class="fas fa-shopping-cart" style="font-size: 25px;"></i>
                                    <p class="bg-danger rounded-circle text-center m-0 text-white notification" 
                                       v-if="cantCart != null" ref="notifications">{{$notification != null ? $notification : '0' }}
                                    </p>

                                </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bars" style="font-size: 25px;"></i>
                                    @if(!\Auth::user()->address_id)
                                    <p class="bg-danger rounded-circle text-center m-0" style="display: block; width: 20px; height: 20px; position: absolute; top: 0px; right: -10px;">?</p>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                    @if(isset($nav))
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#historyShopping" v-on:click="getHistory" >Shopping history</a>

                                    <a href="{{ route('user.index')}}" class="dropdown-item"  >My profile
                                        @if(!\Auth::user()->address_id)
                                        <small class="text-danger"> - complete your address
                                        </small></a>
                                    @endif

                                    @if(\Auth::user()->role == ('admin-aux' or 'admin'))
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#historyShopping" v-on:click="getOrder" >See Orders</a>
                                    @endif
                                    @endif
                                    @if(\Auth::user()->role == 'admin')
                                    
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('admin.product') }}" class="dropdown-item">Admin product</a>
                                    <a href="{{ route('admin.categories') }}" class="dropdown-item">Admin categories</a>
                                    <a href="{{ route('slider.admin') }}" class="dropdown-item">Admin slider</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="pb-4" >
                @yield('content')
            </main>


<!--            <script src="{{ asset('js/app-vue.js') }}"></script>-->
            <footer class="bg-dark text-light text-center mb-0 py-3 fixed-bottom">
                <p class="mb-0">Developed by <a href="#" class=" text-light">Gustavo Diosa </a> &copy;{{ date('Y')}} </p>
            </footer>
        </div>

        <script src=" {{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }} "></script>
        <script src="{{ asset('js/toastr.js') }}"></script>
        <script src="{{ asset('js/vue.js') }}"></script>
        <script src="{{ asset('js/axios.min.js') }}"></script>

        @yield('script')


    </body>

</html>
