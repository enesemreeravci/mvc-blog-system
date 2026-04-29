<h2>Create Post</h2>

<form method="POST" action="/mvc_blog_system/public/?url=posts/create">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Excerpt</label>
        <textarea name="excerpt" class="form-control" rows="2"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="8"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Create Post</button>
</form>