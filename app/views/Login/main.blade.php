<?php
if (Auth::check()) {
    ?>
    Redirect..
    <meta http-equiv="Refresh" content="0;URL={{URL::to('dashboard')}}" />
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>AUTENTICACION</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{ HTML::style('css/bootstrap-3.1.1/css/bootstrap.min.css') }}
        {{ HTML::style('css/bootstrap-3.1.1/css/bootstrap-theme.min.css') }}                
        {{ HTML::style('css/custom.css') }}                
        {{ HTML::script('js/jquery-2.0.2.min.js') }}
        {{ HTML::script('css/bootstrap-3.1.1/js/bootstrap.min.js') }}
        {{ HTML::script('js/main.min.js') }}                
    </head>
    <body>
        <script type="text/javascript">
            $(function() {
                $(window).load(function() {
                    $(':input:visible:enabled:first').focus();
                });
            })
        </script>        
        <div aria-hidden="true" role="dialog" tabindex="-1" class="modal show" id="loginModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>-->
                        <h1 class="text-center">Login</h1>
                    </div>                    
                    <div class="modal-body">
                        {{ Form::open(array('url' => 'singin','class'=>'form col-md-12 center-block')) }}
                        <div class="form-group">
                            <!--{{Form::label('email', 'Email',['class'=>'col-sm-3 control-label'])}}-->
                            {{ Form::text('user','',['class'=>'form-control','placeholder'=>'Email'])}}<br>
                        </div>
                        <div class="form-group">
                            <!--{{Form::label('password', 'Contraseña',['class'=>'col-sm-3 control-label'])}}-->
                            {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password'])}}<br>
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Entrar',['class'=>'btn btn-primary btn-block'])}}
                        </div>
                        {{ Form::close() }}
                    </div>                                                       
                </div>
            </div>
        </div>
    </body>
</html>





