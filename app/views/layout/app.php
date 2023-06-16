<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        if (isset($header) && $header) {
            echo $header;
        }
    ?>
</head>
<body>
    <?php
        if (isset($body) && $body) {
            echo $body;
        }
    ?>
    <?php
        if (isset($footer) && $footer) {
            echo $footer;
        }
    ?>
</body>
</html>