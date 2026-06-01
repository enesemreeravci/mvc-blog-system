<h2>Edit Category</h2>

<form method="POST" action="/mvc_blog_system/public/?url=admin/categories/update">
    <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text"
               name="name"
               class="form-control"
               value="<?= htmlspecialchars($category['name']) ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update Category</button>

    <a href="/mvc_blog_system/public/?url=admin/categories" class="btn btn-secondary">
        Cancel
    </a>
</form>