<h2>Manage Categories</h2>

<form method="POST" action="/mvc_blog_system/public/?url=admin/categories/store" class="mb-4">
    <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">

    <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text" name="name" class="form-control" placeholder="Example: Technology">
    </div>

    <button type="submit" class="btn btn-primary">Add Category</button>
</form>

<hr>

<h4>Existing Categories</h4>

<?php if (empty($categories)): ?>
    <p>No categories yet.</p>
<?php endif; ?>

<?php foreach ($categories as $cat): ?>
    <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">
        <div>
            <strong><?= htmlspecialchars($cat['name']) ?></strong>
            <small class="text-muted ms-2"><?= htmlspecialchars($cat['slug']) ?></small>
        </div>

        <a href="/mvc_blog_system/public/?url=admin/categories/delete&id=<?= $cat['id'] ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete this category?')">
            Delete
        </a>
    </div>
<?php endforeach; ?>