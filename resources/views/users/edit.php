<h1>Edit User</h1>
<form action="<?= url("users.edit", ["id" => $user->id]) ?>" method="post">
    <div>
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" value="<?= $user->name ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $user->email ?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button type="submit">Update</button>
        <button type="button" onclick="window.location.href='<?= url('users') ?>'">Batal</button>
    </div>
</form>