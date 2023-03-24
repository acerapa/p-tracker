<h2>User list</h2>
<table>
    <thead>
        <tr>
            <td>#</td>
            <td>Username</td>
            <td>Full Name</td>
            <td>Regsitered date</td>
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
                    <button>edit</button>
                    <button>delete</button>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>