<!--// resources/views/layouts/app.blade.php-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stepcount Leaderboard</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Leaderboard
                </a>
            </div>
			
            <div class="collapse navbar-collapse" id="app-navbar-collapse">              
				<!-- Left Side Of Navbar -->          
				<ul class="nav navbar-nav">
					 <li {{{ (Request::is('leaderboard/1') ? 'class=active' : '') }}}><a href="{{ url('/leaderboard/1') }}">OverAll</a></li>
					 <li {{{ (Request::is('leaderboard/2') ? 'class=active' : '') }}}><a href="{{ url('/leaderboard/2') }}">7 days</a></li>
					 <li {{{ (Request::is('leaderboard/3') ? 'class=active' : '') }}}><a href="{{ url('/leaderboard/3') }}">30 days</a></li> 
					 <li {{{ (Request::is('leaderboard/4') ? 'class=active' : '') }}}><a href="{{ url('/leaderboard/4') }}">Weekly</a></li> 
					 <li {{{ (Request::is('leaderboard/5') ? 'class=active' : '') }}}><a href="{{ url('/leaderboard/5') }}">Monthly</a></li>
				</ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('Auth/login') }}">Login</a></li>
                        <li><a href="{{ url('Auth/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/Auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
								<li><a href="{{ url('/activity') }}"><i class="fa fa-btn fa-sign-out"></i>My Activities</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
