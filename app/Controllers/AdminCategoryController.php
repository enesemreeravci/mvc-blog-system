<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Middleware.php';
require_once __DIR__ . '/../Core/Session.php';
require_once __DIR__ . '/../Models/Category.php';

class AdminCategoryController extends Controller
{
    public function index(): void
    {
        requireAdmin();

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $this->view('admin/categories', ['categories' => $categories]);
    }

    public function store(): void
    {
        requireAdmin();

        $name = trim($_POST['name'] ?? '');

        if(!$name)
        {
            Session::setFlash('error', 'Name required');
            header('Location: /mvc_blog_system/public/?url=admin/categories');
            exit;
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

        $categoryModel = new Category();
        $categoryModel->create($name, $slug);

        Session::setFlash('succes', 'Category created');
        header('Location: /mvc_blog_system/public/?url=admin/categories');
        exit;
    }

    public function delete(): void
    {
        requireAdmin();

        $id = (int)($_GET['id'] ?? 0);

        $categoryModel = new Category();
        $categoryModel->delete($id);

        Session::setFlash('success', 'Category deleted');
        header('Location: /mvc_blog_system/public/?url=admin/categories');
        exit; 
    }
}
