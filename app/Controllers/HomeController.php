<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Post.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->getPublished();

        $this->view('home/index', ['posts' => $posts]);
    }
}