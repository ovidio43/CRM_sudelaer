<li class="nav-header">
    <a data-target="#{{$mod}}" data-toggle="collapse" href="#">
        <h5>
            <b>{{strtoupper($mod)}} </b>
            <i class="glyphicon {{(Request::is($mod. '/*')) ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></i>
        </h5>
    </a>
    <ul id="{{$mod}}" class="list-unstyled collapse {{ (Request::is($mod. '/*')) ? 'in' : '' }}">                               
        <?php
        if (Session::has('list')) {
            ?>                                
            <li <?php echo (Request::is($mod . '/' . Session::get('list')) || (Request::is($mod . '/ambiguous-list'))) ? 'class="custom-active"' : ''; ?>>            
                <a href="{{URL::to($mod.'/'.Session::get('list'))}}"><i class="glyphicon glyphicon-list-alt"></i> {{ucwords(Session::get('list'))}}</a>
            </li>                
            <?php
        }
        ?>
    </ul>
</li> 
