<h1 style="text-align:center;">SQL Error</h1>
<hr>
<?php if (isset($data)):?>
    <h1 style="text-align:center"><?php echo $data['msg'] ?></h1>
<?php else:?>
    <h1 style="text-align:center">Something is going on with the sql connection</h1>
<?php endif; ?>
