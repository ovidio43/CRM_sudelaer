@extends('sidebar')
@section('title')
<strong>MESSAGES</strong>
<nav class="navbar margin-none">    
    <div class="navbar-header">
        <ul class="nav navbar-nav">
            <li><a ><input type="checkbox" name="selected-all"></a></li>
            <li class="dropdown">
                <a aria-expanded="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                    View: All <span class="caret"></span>
                </a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="#" >Unread</a></li>                        
                    <li><a href="#" >Recycle</a></li>                        
                </ul>
            </li>
            <li><a href="#" ><span class="glyphicon glyphicon-trash"></span></a></li>                                    
        </ul>
    </div>

</nav>
@stop
@section('content')


<table class="table table-condensed table-hover">        
    <tbody>
        <?php
        $c = 0;
        for ($index = 0; $index < 50; $index++) {
            ?>      
            <tr <?= $c < 6 ? 'class="no-read active"' : ''; ?>>
                <th scope="row"><input type="checkbox" name="" class="message-check"></th>
                <td><a href="#">cubject content <?= $index ?></a></td>                   
                <td>message content.. lorem ipsum... lorem ipsum... lorem ipsum... lorem ipsum... <?= $index ?></td>                   
            </tr>        
            <?php
            $c++;
        }
        ?>  
    </tbody>
</table>

@stop


