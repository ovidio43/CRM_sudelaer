<div class="col-md-10"> 
    <b>@yield('title')</b>    
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <form action="{{URL::to('leads/search')}}" method="get" role="search" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" name="s" placeholder="Search" class="form-control">
                </div>
                <button class="btn btn-default glyphicon glyphicon-search" type="submit"></button>
            </form>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        @yield('content')
    </div>
</div>





