<h1>Users</h1>
<form action="<?= url("users.insert") ?>" method="post">
    <div>
        <label for="name">Nama</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button type="submit">Save</button>
    </div>
</form>
<table border="2">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $index => $user) : ?>
            <tr>
                <td><?= ++$index ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td>
                    <form style="display: inline;" action="<?= url("users.delete") ?>" method="post">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <button type="button" onclick="window.location.href='<?= url('users.edit', ['id' => $user->id]) ?>'">Edit</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>