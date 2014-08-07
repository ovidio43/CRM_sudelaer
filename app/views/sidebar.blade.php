@include('header')
<div class="col-md-2">
    <ul class="list-unstyled">        
        <?php
        $mod = '';
        if (Session::has('leads')) {
            $mod = Session::get('leads');
            ?>
            @include('Module.' . $mod)
            <?php
        }
        if (Session::has('contacts')) {
            $mod = Session::get('contacts');
            ?>
            @include('Module.' . $mod)
            <?php
        }
        if (Session::has('system')) {
            $mod = Session::get('system');
            ?>
            @include('Module.' . $mod)
            <?php
        }
        ?>                 
    </ul>    
</div>
@include('content')
@include('footer')

