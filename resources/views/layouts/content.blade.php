@extends('layouts.master')

@section('content')
    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo"><b>@yield('content_title')</b></a>
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="{{url('/')}}" style="font-size:25px;">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <!--<li class="dropdown notifications-menu">
                            <a href="{{url('/')}}" style="font-size:25px;">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>-->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>

        <section class="content">
            @yield('content_body')
        </section>
     </div>
@endsection
