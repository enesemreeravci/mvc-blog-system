<h1>Blog Posts</h1>

<?php if (empty($posts)): ?>
    <p>No posts yet.</p>
<?php endif; ?>

<form method="GET" action="/mvc_blog_system/public/" class="mb-4">
    <input type="hidden" name="url" value="">
    
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search posts..." value="<?= htmlspecialchars($search ?? '') ?>">
        <button class="btn btn-primary">Search</button>
    </div>
</form>

<?php foreach ($posts as $post): ?>
    <div class="card mb-3">
        <div class="card-body">

            <h3>
                <a href="/mvc_blog_system/public/?url=post&slug=<?= htmlspecialchars($post['slug']) ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
            </h3>

            <p><?= htmlspecialchars($post['excerpt']) ?></p>

            <small>By <?= htmlspecialchars($post['username']) ?></small>

            <?php if (isset($_SESSION['user']) && 
                ($_SESSION['user']['id'] == $post['user_id'] || $_SESSION['user']['role'] === 'admin')): ?>
                
                <div class="mt-2">
                    <a class="btn btn-sm btn-warning" 
                       href="/mvc_blog_system/public/?url=posts/edit&id=<?= $post['id'] ?>">
                        Edit
                    </a>

                    <a class="btn btn-sm btn-danger" 
                       href="/mvc_blog_system/public/?url=posts/delete&id=<?= $post['id'] ?>"
                       onclick="return confirm('Delete this post?')">
                        Delete
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </div>
<?php endforeach; ?>

<?php if (!empty($totalPages) && $totalPages > 1): ?>
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="/mvc_blog_system/public/?page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>