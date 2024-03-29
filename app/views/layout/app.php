<?php ob_start()?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
            $BASE_PATH = dirname(__DIR__);
            include($BASE_PATH.'/layout/parts/header.php');
        ?>
        <?php 
            if (isset($header) && $header) {
                echo $header;
            }
        ?>
        <link rel="stylesheet" href="<?php echo asset('css/components/','header.css'); ?>">
    </head>
    <body>
        <div class="container">
            <!-- nav header -->
            <?php include($BASE_PATH.'/components/header.php')?>
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
        <script src="<?php echo asset('js/components/','header.js'); ?>"></script>
    </body>
    </html>
<?php 
    $layout = ob_get_contents();
    ob_end_clean();
    echo $layout;
?>