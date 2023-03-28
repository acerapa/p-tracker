<h2>User list</h2>
<table>
    <thead>
        <tr>
            <td>#</td>
            <td>Username</td>
            <td>Full Name</td>
            <td>Registered date</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user):?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->getFullName(); ?></td>
                <td><?php echo $user->created_at; ?></td>
                <td>
                    <a href="<?php echo "/user/edit/".$user->id; ?>"><button>edit</button></a>
                    <button>delete</button>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
