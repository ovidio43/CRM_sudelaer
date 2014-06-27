@include('header')
<div class="col-md-2">
    <!-- Left column -->

    <ul class="list-unstyled">
        <li class="nav-header"> 
            <a data-target="#userMenu" data-toggle="collapse" href="#">
                <h5><b>LEADS </b><i class="glyphicon <?php echo (Request::is('leads/*')) ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'; ?>"></i></h5>
            </a>
            <ul id="userMenu" class="list-unstyled collapse <?php echo (Request::is('leads/*')) ? 'in' : ''; ?>">
                <li <?php echo (Request::is('leads/new')) ? 'class="custom-active"' : ''; ?>>
                    <a href="{{URL::to('leads/new')}}"><i class="glyphicon glyphicon-certificate"></i> New Lead</a>
                </li>
                <li <?php echo (Request::is('leads/list')) ? 'class="custom-active"' : ''; ?>>
                    <a href="{{URL::to('leads/list')}}"><i class="glyphicon glyphicon-list-alt"></i> My Leads</a>
                </li>
            </ul>
        </li>
        <li class="nav-header">
            <a data-target="#menu2" data-toggle="collapse" href="#">
                <h5><b>CONTACTS </b><i class="glyphicon <?php echo (Request::is('contacts/*')) ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'; ?>"></i></h5>
            </a>
            <ul id="menu2" class="list-unstyled collapse <?php echo (Request::is('contacts/*')) ? 'in' : ''; ?>">
                <li <?php echo (Request::is('contacts/new')) ? 'class="custom-active"' : ''; ?>>
                    <a href="{{URL::to('contacts/new')}}"><i class="glyphicon glyphicon-certificate"></i> New Contact </a>
                </li>
                <li <?php echo (Request::is('contacts/list')) ? 'class="custom-active"' : ''; ?>>
                    <a href="{{URL::to('contacts/list')}}"><i class="glyphicon glyphicon-list-alt"></i> My Contacts</a>
                </li>

            </ul>
        </li>
    </ul>    
</div>
@include('content')
@include('footer')

