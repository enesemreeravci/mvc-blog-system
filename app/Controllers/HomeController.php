<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Post.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $postModel = new Post();

        $search = $_GET['search'] ?? '';
        $page = (int)($_GET['page'] ?? 1);
        $limit = 5;
        $offset = ($page - 1) * $limit;

        if ($search) {
            $posts = $postModel->search($search);
            $totalPages = 1;
        } else {
            $posts = $postModel->getPaginated($limit, $offset);
            $total = $postModel->countPosts();
            $totalPages = ceil($total / $limit);
        }

        $this->view('home/index', [
            'posts' => $posts,
            'search' => $search,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }
}