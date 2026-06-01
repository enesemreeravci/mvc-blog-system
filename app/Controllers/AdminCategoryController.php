<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Middleware.php';
require_once __DIR__ . '/../Core/Session.php';
require_once __DIR__ . '/../Core/Csrf.php';
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

        if (!Csrf::validate($_POST['csrf_token'] ?? null)) {
            Session::setFlash('error', 'Invalid CSRF token.');
            header('Location: /mvc_blog_system/public/?url=admin/categories');
            exit;
        }

        $name = trim($_POST['name'] ?? '');

        if (!$name) {
            Session::setFlash('error', 'Name required.');
            header('Location: /mvc_blog_system/public/?url=admin/categories');
            exit;
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

        try {
            $categoryModel = new Category();
            $categoryModel->create($name, $slug);

            Session::setFlash('success', 'Category created.');
        } catch (PDOException $e) {
            Session::setFlash('error', 'Category already exists or database error.');
        }

        header('Location: /mvc_blog_system/public/?url=admin/categories');
        exit;
    }

    public function edit(): void
    {
        requireAdmin();

        $id = (int)($_GET['id'] ?? 0);

        $categoryModel = new Category();
        $category = $categoryModel->findById($id);

        if (!$category) {
            Session::setFlash('error', 'Category not found.');
            header('Location: /mvc_blog_system/public/?url=admin/categories');
            exit;
        }

        $this->view('admin/category_edit', ['category' => $category]);
    }

    public function update(): void
    {
        requireAdmin();

        if (!Csrf::validate($_POST['csrf_token'] ?? null)) {
            Session::setFlash('error', 'Invalid CSRF token.');
            header('Location: /mvc_blog_system/public/?url=admin/categories');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        if (!$id || !$name) {
            Session::setFlash('error', 'Category name required.');
            header('Location: /mvc_blog_system/public/?url=admin/categories');
            exit;
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

        try {
            $categoryModel = new Category();
            $categoryModel->update($id, $name, $slug);

            Session::setFlash('success', 'Category updated.');
        } catch (PDOException $e) {
            Session::setFlash('error', 'Category update failed.');
        }

        header('Location: /mvc_blog_system/public/?url=admin/categories');
        exit;
    }

    public function delete(): void
    {
        requireAdmin();

        $id = (int)($_GET['id'] ?? 0);

        try {
            $categoryModel = new Category();
            $categoryModel->delete($id);

            Session::setFlash('success', 'Category deleted.');
        } catch (PDOException $e) {
            Session::setFlash('error', 'Cannot delete category because it may be used by posts.');
        }

        header('Location: /mvc_blog_system/public/?url=admin/categories');
        exit;
    }
}