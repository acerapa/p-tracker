<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="<?php echo asset('icons/', 'logo.png')?>">
<link rel="stylesheet" href="<?php echo asset('css/', 'app.css')?>">
<?php include($BASE_PATH."/layout/parts/font.php"); ?>
<title><?php echo $title ?></title>

<!-- css and js imports -->
<?php
    if (isset($imports)) {
        foreach ($imports as $key => $link) {
            if ($key === 'css') {
                echo "<link rel='stylesheet' href='$link'>";
            } else if ($key === 'js') {
                echo "<script src='$link'></script>";
            }
        }
    }
?>
