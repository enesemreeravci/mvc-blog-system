<h2>Categories</h2>

<form method="POST" action="/mvc_blog_system/public/?url=admin/categories/store" class="mb-4">
    <input type="text" name="name" class="form-control mb-2" placeholder="New category name">
    <button class="btn btn-primary">Add Category</button>
</form>

<?php foreach ($categories as $cat): ?>
    <div class="d-flex justify-content-between border p-2 mb-2">
        <span><?= htmlspecialchars($cat['name']) ?></span>

        <a href="/mvc_blog_system/public/?url=admin/categories/delete&id=<?= $cat['id'] ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete?')">
           Delete
        </a>
    </div>
<?php endforeach; ?>