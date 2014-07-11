<li class="nav-header">
    <a data-target="#{{$mod}}" data-toggle="collapse" href="#">
        <h5>
            <b>{{strtoupper($mod)}} </b>
            <i class="glyphicon {{(Request::is($mod. '/*')) ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></i>
        </h5>
    </a>
    <ul id="{{$mod}}" class="list-unstyled collapse {{ (Request::is($mod. '/*')) ? 'in' : '' }}">                               
        <li <?php echo (Request::is($mod. '/user')) ? 'class="custom-active"' : ''; ?>>            
            <a href="{{URL::to($mod.'/user')}}"><i class="glyphicon glyphicon-user"></i> User</a>
        </li>                
        <li <?php echo (Request::is($mod. '/type-user')) ? 'class="custom-active"' : ''; ?>>            
            <a href="{{URL::to($mod.'/type-user')}}"><i class="glyphicon glyphicon-user"></i> Type User</a>
        </li>                                        
    </ul>
</li> 
