<div class="col-md-10"> 
    @yield('title')
    <?php
    $url = '';
    if (Request::is('leads/*')) {
        $url = 'leads/find';
        $filters = [
            'mobile' => 'Mobile',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_address' => 'Email',
            'status' => 'Status',
            'home_phone' => 'Home phone'
        ];
    }
    if (Request::is('contacts/*')) {
        $url = 'contacts/find';
        $filters = [
            'co_buyer_mobile_phone' => 'Mobile',
            'primary_buyer_first_name' => 'First Name',
            'primary_buyer_last_name' => 'Last Name',
            'primary_buyer_email_address' => 'Email'
        ];
    }
    if (Request::is('leads/*') || Request::is('contacts/*')) {
        ?>
        <div class="row">         
            {{ Form::open(array('url' => $url)) }}       
            <div class="col-md-6 col-md-offset-6">
                <div class="col-md-4">
                    {{Form::select('filter', $filters,null,['class'=>'form-control'])}} 
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        {{Form::text('wildcard','',['class'=>'form-control','placeholder'=>'Search...']);}}                    
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div><!-- /.col-lg-6 -->
            {{ Form::close() }} 
        </div>
        <?php
    }
    ?>
    <div class="table-responsive">
        @yield('content')
    </div>
</div>





