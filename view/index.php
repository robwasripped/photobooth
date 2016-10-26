<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </head>
    <body>
        <ol id="images">
        </ol>
        <script type="text/javascript">
            function loadlink(){
                $('#images').load('images.php',function () {
                     $(this).unwrap();
                });
            }
            
            loadlink();
            setInterval(function(){
                loadlink() // this will run after every 5 seconds
            }, 8000);
        </script>
    </body>
</html>
