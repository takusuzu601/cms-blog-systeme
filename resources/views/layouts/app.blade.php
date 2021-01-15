<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .btn-info{
            color:#fff;
        }
        .navbar-light .navbar-brand, .navbar-light .navbar-brand:focus, .navbar-light .navbar-brand:hover {
         color: rgb(255 255 255 / 90%);
         font-weight: bold;
}
.navbar-light .navbar-nav .nav-link,.nav-link:hover,.nav-link:focus {
    color: rgb(255 255 255);
}
.navbar-light .navbar-nav .active>.nav-link, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .show>.nav-link {
    color: rgb(255 255 255);
}
    </style>
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-image: linear-gradient(-225deg, #dd4b39 0%, #ff49546e 48%, #ff4954 100%);
}">
            <div class="container" style="">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    Contents Management System
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

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
                          
                            <li>
                                <a class="nav-link">
                                    {{ Auth::user()->name }} 
                                </a>
                            </li>
                            
                       <li>
                        <a class="nav-link" href="{{ route('users.edit-profile') }}">
                            My Profile
                        　　</a>

                       </li>
 
                                  <li>
                                    <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                 　　</a>
    
    
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                  </li>
                           
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @auth
            <div class="container">

                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                @endif

                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
    
                        <ul class="list-group">

                            @if(auth()->user()->isAdmin())
                            <li class="list-group-item">
                                <a href="{{route('users.index')}}">
                                    Users
                                </a>
                            </li>
                            @endif

                            <li class="list-group-item">
                                <a href="{{route('posts.index')}}">記事の投稿</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('tags.index')}}">タグの設定</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route('categories.index')}}">カテゴリーの投稿</a>
                            </li>

                        </ul>

                        <ul class="list-group mt-5">
    
                            <li class="list-group-item">
                                <a href="{{route('trashed-posts.index')}}">ゴミ箱</a>
                            </li>
                        </ul>
                    </div>
                
               
                <div class="col-md-8">
                    @yield('content')
                </div>
                </div>
            </div>
    
            @else
                 @yield('content')
            @endauth
        </main>
    </div>
 
<!-- Scripts -->
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60012a9d3c672b02"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" ></script>
@yield('scripts')
</body>
</html>
