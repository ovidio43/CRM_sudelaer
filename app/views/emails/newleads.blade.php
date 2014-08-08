<html>
    <head>
        <title>New Leads</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>        
        <?php
        $objTemplate = Templates::find($id_template);
        echo $objTemplate->content;
        if (!$send_client) {
            ?>            
            <hr>
            <p>{{URL::to('leads/edit/'.$id_leads)}}</p>
            <?php
        }
        ?>

    </body>
</html>