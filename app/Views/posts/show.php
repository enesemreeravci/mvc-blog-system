<h1><?= htmlspecialchars($post['title']) ?></h1>

<p><em>By <?= htmlspecialchars($post['username']) ?></em></p>

<hr>

<p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

<hr>

<h3>Comments</h3>

<?php if (isset($_SESSION['user'])): ?>
    <form method="POST" action="/mvc_blog_system/public/?url=comments/store" class="mb-4">
        <input type="hidden" name="csrf_token" value="<?= Csrf::generate() ?>">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">

        <div class="mb-3">
            <textarea name="content" class="form-control" rows="3" placeholder="Write a comment..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>
<?php else: ?>
    <p>
        <a href="/mvc_blog_system/public/?url=login">Login</a> to write a comment.
    </p>
<?php endif; ?>

<?php if (empty($comments)): ?>
    <p>No comments yet.</p>
<?php endif; ?>

<?php foreach ($comments as $comment): ?>
    <div class="card mb-2">
        <div class="card-body">

            <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>

            <small>
                By <?= htmlspecialchars($comment['username']) ?>
                on <?= htmlspecialchars($comment['created_at']) ?>
            </small>

            <?php if (isset($_SESSION['user']) && 
                ($_SESSION['user']['id'] == $comment['user_id'] || $_SESSION['user']['role'] === 'admin')): ?>

                <div class="mt-2">
                    <a class="btn btn-sm btn-danger"
                       href="/mvc_blog_system/public/?url=comments/delete&id=<?= $comment['id'] ?>&slug=<?= $post['slug'] ?>"
                       onclick="return confirm('Delete this comment?')">
                        Delete
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </div>
<?php endforeach; ?>