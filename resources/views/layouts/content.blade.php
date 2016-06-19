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
                    </ul>
                </div>
            </nav>
        </header>
        
        <section class="content">
            @yield('content_body')
        </section>
     </div>
@endsection

