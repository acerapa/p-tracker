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
    <link rel="stylesheet" href="<?php echo asset('css/', 'custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/', 'important.css'); ?>">
    <?php
    if (isset($header) && $header) {
        echo $header;
    }
    ?>
</head>

<body>
    <div class="modal-overlay hidden"></div>

    <!-- DELETE CONFIRMATION -->
    <div class="modal hidden" id="deletion-confirmation">
        <div class="flex justify-between items-center">
            <p class="text-base font-bold">Confirmation</p>
            <img class="w-5 h-5 cursor-pointer close-confirmation-modal" src="<?php echo asset('img/', 'cancel.png'); ?>" alt="cancel">
        </div>
        <div class="py-7">
            <p class="text-[19px] font-bold text-center">This action is irreversible are you sure you want to proceed this?</p>
        </div>
        <div class="flex gap-[14px] justify-center py-8">
            <button type="button" class="btn btn-outline close-confirmation-modal">Cancel</button>
            <button class="btn bg-red">Yes</button>
        </div>
    </div>

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

    <script src="<?php echo asset("js/", "common.js"); ?>"></script>
    <script src="<?php echo asset("js/", "global.js"); ?>"></script>

    <!-- Custom scripts from page -->
    <?php
    if (isset($scripts) && $scripts) {
        echo $scripts;
    }
    ?>
</body>

</html>
<?php
$layout = ob_get_contents();
ob_end_clean();
echo $layout;
?>