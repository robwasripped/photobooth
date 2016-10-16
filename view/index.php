<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
    </head>
    <body>
        <?php
            foreach($data->data as $image) {
                printf('<img src="%s" />', $image->images->low_resolution->url);
            }
        ?>
    </body>
</html>
