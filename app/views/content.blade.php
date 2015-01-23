<div class="col-md-10"> 
    @yield('title')
    <?php if (Request::is('leads/*')) { ?>
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <form action="{{URL::to('leads/search')}}" method="get" role="search" class="navbar-form navbar-right">
                    <div class="form-group">
                        
                        <select name="filter" class="form-control">
                            <option value="first_name">First Name</option>
                            <option value="last_name">Last Name</option>
                            <option value="email_address">Email</option>
                            <option value="status">Status</option>
                            <option value="home_phone">Home Phone</option>
                            <option value="mobile">Mobile</option>
                        </select>
                        <input type="text" name="s" placeholder="Search" class="form-control">
                    </div>
                    <button class="btn btn-default glyphicon glyphicon-search" type="submit"></button>
                </form>
            </div>
        </div>
        <?php
    }
    ?>    
    <div class="table-responsive">
        @yield('content')
    </div>
</div>





