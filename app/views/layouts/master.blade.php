<!-- app/views/nerds/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title')
    </title>
    <!--link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"-->

    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/bootstrap-theme.min.css') }}
    {{ HTML::style('assets/css/font-awesome.min.css') }}
    {{ HTML::style('assets/css/style.css') }}

    @yield('style')


</head>
<body>
    <div class="container">

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::route('home') }}">Music Store</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::route('music-artist') }}">View All Artists</a></li>
                <li><a href="{{ URL::route('music-albums-all') }}">All Albums</a></li>
                <li><a href="{{ URL::route('music-tracks-all') }}">All Tracks</a></li>
                </ul>

                <div class="pull-right">
                    <ul class="nav navbar-nav">
                        <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <span class="badge bg-important">Welcome {{ Auth::user()->username }}</span>
                        </a> 
                    </li>
                    <li>
                        <a href="{{ URL::route('account-logout') }}" title="Log out">
                            <i class="fa fa-power-off fa-2"></i>
                            <span>Log Out</span>
                        </a> 
                    </li>
                </ul>
                </div>
            </nav>

            <h1> @yield('body-title')</h1>

            <!-- will be used to show any messages -->
            @if (isset($errors) && count($errors->all()) > 0)
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading">Oh Snap!</h4>
                    <ul>
                    @foreach ($errors->all('<li>:message</li>') as $message)
                    {{ $message }}
                    @endforeach
                    </ul>
                </div>
            @else
                @if (Session::has('message'))
                    <div class="alert alert-{{Session::get('type')}}" role="alert">{{ Session::get('message') }}</div>
                @endif
            @endif

            @yield('content')

        </div>

        {{ HTML::script('assets/js/jquery-1.11.1.min.js') }}
        {{ HTML::script('assets/js/bootstrap.min.js') }}

        @yield('script')
    </body>
    </html>