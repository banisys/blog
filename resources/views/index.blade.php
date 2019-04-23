<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/all.css">
    <script src="/js/star-rating.min.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('my_favorites') }}">My Favorites</a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <star-rating @rating-selected="rating = $event" :rating="rating"></star-rating>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h3>All Posts</h3>
                </div>
                @forelse ($posts as $post)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $post->title }}
                        </div>

                        <div class="panel-body">
                            {{ $post->body }}
                        </div>
                        @if (Auth::check())
                            <div class="panel-footer">
                                <favorite :post={{ $post->id }} :favorited={{ $post->favorited() ? 'true' : 'false' }} ></favorite>
                            </div>
                        @endif
                    </div>
                @empty
                    <p>No post created.</p>
                @endforelse

                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    window.Laravel = {};
    window.Laravel.csrfToken = '{{ csrf_token() }}'
</script>
<script>
    new Vue({
        el: "#app",
        data:{
            rating: 3
        }
    });
</script>
<script src="/js/app.js"></script>
</body>
</html>