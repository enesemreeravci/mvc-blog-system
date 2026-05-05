<h2>Register</h2>

<form method="POST" action="">
    <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">     
    <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username">
    </div>

    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div>

    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>

    <button class="btn btn-primary">Register</button>
</form>