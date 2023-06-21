<!DOCTYPE html>
<html lang="en">
<?php 
    $title = 'Edit User';
    include(dirname(__DIR__)."/layout/parts/header.php")
?>
<body>
    <form action="<?php echo "/user/update/".$user->id; ?>" method="post">
        <label for="">Last name</label>
        <input type="text" value="<?php echo $user->last_name; ?>" name="last_name"><br>
        <label for="">First name</label>
        <input type="text" value="<?php echo $user->first_name; ?>" name="first_name"><br>
        <label for="">Username</label>
        <input type="text" value="<?php echo $user->username; ?>" name="username"><br>
        <input type="submit" value="save">
    </form>
</body>
</html>
