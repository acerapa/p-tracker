<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $BASE_PATH = dirname(__DIR__);
        include($BASE_PATH.'/layout/parts/header.php');
    ?>
    <?php 
        if (isset($header) && $header) {
            echo $header;
        }
    ?>
</head>
<body>
    <div class="container">
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
    </div>
</body>
</html>