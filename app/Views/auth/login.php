<h2>Login</h2>

<form method="POST" action="/mvc_blog_system/public/?url=login">
    <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">     
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div>

    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-success">Login</button>
</form>