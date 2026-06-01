<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Middleware.php';
require_once __DIR__ . '/../Models/Category.php';

class AdminController extends Controller
{
    public function index(): void
    {
        requireAdmin();

        $categoryModel = new Category();
        $categories = $categoryModel->getWithPostCounts();

        $this->view('admin/index', [
            'categories' => $categories
        ]);
    }
}