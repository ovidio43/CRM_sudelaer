<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>CRM-C&G IMPORTS</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        {{ HTML::style('css/bootstrap-3.1.1/css/bootstrap.min.css') }} 
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->                   
        {{ HTML::style('css/custom.css') }}       
        {{ HTML::style('css/invetary.css') }}       
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body  >

        <!-- Header -->
        <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{URL::to('dashboard')}}"><img src="{{ URL::asset('img/logo-mobile.png')}}"> DASHBOARD</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                {{Auth::user()->employee->first_name.' '.Auth::user()->employee->last_name }}
                                <span class="caret"></span>
                            </a>
                            <ul id="g-account-menu" class="dropdown-menu" role="menu">
                                <li><a href="#">My Profile</a></li>                                
                            </ul>
                        </li>
                        <li><a href="{{URL::to('logout')}}"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
                    </ul>
                </div>
            </div><!-- /container -->
        </div>
        <!-- /Header -->

        <!-- Main -->
        <div class="container">
            <div class="row">