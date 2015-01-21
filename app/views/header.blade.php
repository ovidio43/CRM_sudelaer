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
        {{ HTML::style('js/datetimepicker-master/jquery.datetimepicker.css') }}       
        {{ HTML::style('css/custom.css') }}       
        {{ HTML::style('css/invetary.css') }}       
        {{ HTML::style('css/thickbox.css') }}               
    </head>
    <body rel="{{URL::to('/')}}" >
        <!--global modal---->
        <div id="global-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header alert alert-info">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 id="title-global-modal" class="modal-title"></h4>
                    </div>
                    <div id="global-modal-body" class="modal-body">
                    </div>
                </div>
            </div>
        </div>

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
                            <ul id="g-account-menu" class="dropdown-menu" role="menu" style="width: 100%">
                                <li><a href="{{URL::to('my-profile')}}"><i class="glyphicon glyphicon-user"></i>  My Profile</a></li>  
                                <li><a href="{{URL::to('logout')}}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>                             
                            </ul>
                        </li>

                    </ul>
                </div>
            </div><!-- /container -->
        </div>
        <!-- /Header -->

        <!-- Main -->
        <div class="container">
            <div class="row">
