<h1>Blog Posts</h1>

<?php if (empty($posts)): ?>
    <p>No posts yet.</p>
<?php endif; ?>

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