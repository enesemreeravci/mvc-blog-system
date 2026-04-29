<h2>Edit Post</h2>

<form method="POST" action="/mvc_blog_system/public/?url=posts/edit&id=<?= $post['id'] ?>">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Excerpt</label>
        <textarea name="excerpt" class="form-control" rows="2"><?= htmlspecialchars($post['excerpt']) ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="8"><?= htmlspecialchars($post['content']) ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="draft" <?= $post['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
            <option value="published" <?= $post['status'] === 'published' ? 'selected' : '' ?>>Published</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Post</button>
</form>
