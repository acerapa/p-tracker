<?php ob_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        $BASE_PATH = dirname(__DIR__);
        include(base_path()."/views/layout/parts/new-meta-head.php");
    ?>
    <style>
        @font-face {
            font-family: 'Quicksand';
            src: url('<?php echo asset('font/quicksand/', 'Quicksand-VariableFont_wght.ttf'); ?>');
        }

        *,
        body {
            font-family: Quicksand;
        }
    </style>
    <link rel="stylesheet" href="<?php echo asset('css/', 'global.css'); ?>">
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

    <script src="<?php echo asset("js/", "global.js"); ?>"></script>
</body>

</html>
<?php
$layout = ob_get_contents();
ob_end_clean();
echo $layout;
?>