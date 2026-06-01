<h1>Admin Dashboard</h1>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Manage Categories</h5>
                <p>Create, edit and delete blog categories.</p>
                <a href="/mvc_blog_system/public/?url=admin/categories" class="btn btn-primary">
                    Manage Categories
                </a>
            </div>
        </div>
    </div>
</div>

<h3>Category Usage</h3>

<?php if (empty($categories)): ?>
    <p>No categories yet.</p>
<?php endif; ?>

<?php foreach ($categories as $category): ?>
    <div class="d-flex justify-content-between border rounded p-2 mb-2">
        <span><?= htmlspecialchars($category['name']) ?></span>
        <span class="badge bg-secondary">
            <?= $category['post_count'] ?> posts
        </span>
    </div>
<?php endforeach; ?>