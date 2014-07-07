@extends('sidebar')
@section('title')
DASHBOARD
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="well">Inbox Messages <span class="badge pull-right">3</span></div>
        <hr>
        <div class="btn-group btn-group-justified">
            <a class="btn btn-primary col-sm-3" href="#">
                <i class="glyphicon glyphicon-plus"></i><br>
                Service
            </a>
            <a class="btn btn-primary col-sm-3" href="#">
                <i class="glyphicon glyphicon-cloud"></i><br>
                Cloud
            </a>
            <a class="btn btn-primary col-sm-3" href="#">
                <i class="glyphicon glyphicon-cog"></i><br>
                Tools
            </a>
            <a class="btn btn-primary col-sm-3" href="#">
                <i class="glyphicon glyphicon-question-sign"></i><br>
                Help
            </a>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Reports</h4></div>
            <div class="panel-body">

                <small>Success</small>
                <div class="progress">
                    <div style="width: 72%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="72" role="progressbar" class="progress-bar progress-bar-success">
                        <span class="sr-only">72% Complete</span>
                    </div>
                </div>
                <small>Info</small>
                <div class="progress">
                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-info">
                        <span class="sr-only">20% Complete</span>
                    </div>
                </div>
                <small>Warning</small>
                <div class="progress">
                    <div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning">
                        <span class="sr-only">60% Complete (warning)</span>
                    </div>
                </div>
                <small>Danger</small>
                <div class="progress">
                    <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-danger">
                        <span class="sr-only">80% Complete</span>
                    </div>
                </div>

            </div><!--/panel-body-->
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Notices</h4></div>
            <div class="panel-body">
                Bienvenido al CRM de C&G Imports
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr><th>Visits</th><th>ROI</th><th>Source</th></tr>
            </thead>
            <tbody>
                <tr><td>45</td><td>2.45%</td><td>Direct</td></tr>
                <tr><td>289</td><td>56.2%</td><td>Referral</td></tr>
                <tr><td>98</td><td>25%</td><td>Type</td></tr>
                <tr><td>..</td><td>..</td><td>..</td></tr>
                <tr><td>..</td><td>..</td><td>..</td></tr>
            </tbody>
        </table>
    </div>
</div>
@stop


