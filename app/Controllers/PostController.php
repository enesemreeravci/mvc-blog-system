<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Session.php';
require_once __DIR__ . '/../Core/Middleware.php';
require_once __DIR__ . '/../Core/Csrf.php';
require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../Models/Comment.php';

class PostController extends Controller
{
    public function create(): void
    {
        requireLogin();
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(!Csrf::validate($_POST['csrf_token'] ?? null))
            {
                Session::setFlash('error', 'Invalid CSRF token');
                header('Location: /mvc_blog_system/public/');
                exit;
            }

            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $excerpt = trim($_POST['excerpt'] ?? '');
            $status = $_POST['status'] ?? 'draft';

            if(!$title || !$content)
            {
                Session::setFlash('error', 'Title and content are required');
                header('Location: /mvc_blog_system/public/?url=posts/create');
                exit;
            }

            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
            $slug = $slug . '-' . time();
        
            $postModel = new Post();
            $success = $postModel->create(
                $title,
                $slug,
                $content,
                $excerpt,
                $_SESSION['user']['id'],
                $status
            );

            if($success)
            {
                Session::setFlash('success', 'Post created successfully.');
                header('Location: /mvc_blog_system/public/?url=posts/create');
                exit;
            }
            Session::setFlash('error', 'Post creation failed.');
            header('Location: /mvc_blog_system/public/?url=posts/create');
            exit;
        }
        $this->view('posts/create');
    }

    public function edit(): void
    {
        requireLogin();

        $id = (int)($_GET['id'] ?? 0);

        $postModel = new Post();
        $post = $postModel->findById($id);

        if(!$post)
        {
            echo "Post not found";
            return;
        }

        if($post['user_id'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin')
        {
            Session::setFlash('error', 'You are not allowed to edit this post.');
            header('Location: /mvc_blog_system/public/');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['title'] ?? '');
            $excerpt = trim($_POST['excerpt'] ?? '');
            $status = $_POST['status'] ?? 'draft';

            if(!$title || !$content)
            {
                Session::setFlash('error', 'Title and content are required');
                header('Location: /mvc_blog_systen/public/?url=posts/edit$id' . $id);
                exit;
            }

            $postModel->update($id, $title, $content, $excerpt, $status);

            Session::setFlash('success', 'Post updated successfully.');
            header('Location: /mvc_blog_system/public/');
            exit;
        }
        $this->view('posts/edit', ['post' => $post]);
    }

    //delete posts
    public function delete(): void
    {
        requireLogin();

        $id = (int)($_GET['id'] ?? 0);

        $postModel = new Post();
        $post = $postModel->findById($id);

        if (!$post) 
        {
            echo "Post not found";
            return;
        }

        if ($post['user_id'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin') 
        {
            Session::setFlash('error', 'You are not allowed to delete this post.');
            header('Location: /mvc_blog_system/public/');
            exit;
        }

        $postModel->delete($id);

        Session::setFlash('success', 'Post deleted successfully.');
        header('Location: /mvc_blog_system/public/');
        exit;
    }

    public function show(): void
    {
        $slug = $_GET['slug'] ?? '';

        if(!$slug)
        {
            echo "Post not found";
            return;
        }

        $postModel = new Post();
        $post = $postModel->findBySlug($slug);

        if(!$post)
        {
            echo "Post not found";
            return;
        }

        $commentModel = new Comment();
        $comments = $commentModel->getByPostId($post['id']);

        $this->view('posts/show', [
        'post' => $post,
        'comments' => $comments
        ]);
    }
    
    public function comment(): void
    {
        requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            header('Location: /mvc_blog_system/public/');
            exit;
        }

        $postId = (int)($_POST['post_id'] ?? 0);
        $content = trim($_POST['content'] ?? '');

        if (!$postId || !$content) 
        {
            Session::setFlash('error', 'Comment cannot be empty.');
            header('Location: /mvc_blog_system/public/');
            exit;
        }

        $postModel = new Post();
        $post = $postModel->findById($postId);

        if (!$post) 
        {
            Session::setFlash('error', 'Post not found.');
            header('Location: /mvc_blog_system/public/');
            exit;
        }

        $commentModel = new Comment();
        $commentModel->create($postId, $_SESSION['user']['id'], $content);

        Session::setFlash('success', 'Comment added.');
        header('Location: /mvc_blog_system/public/?url=post&slug=' . $post['slug']);
        exit;
    }

    public function deleteComment(): void
    {
        requireLogin();

        $id = (int)($_GET['id'] ?? 0);

        $commentModel = new Comment();
        $comment = $commentModel->findById($id);

        if(!$comment)
        {
            Session::setFlash('error', 'Comment not found');
            header('Location: /mvc_blog_system/public/');
            exit;
        }

        //only owner or admin
        if($comment['user_id'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin')
        {
            Session::setFlash('error', 'You cannot delete this comment.');
            header('Location: /mvc_blog_system/public/');
            exit;
        }

        $commentModel->deleteComment($id);
        Session::setFlash('success', 'Comment deleted.');
        // redirect back to post
        header('Location: /mvc_blog_system/public/?url=post&slug=' . $_GET['slug']);
        exit;
    }
}