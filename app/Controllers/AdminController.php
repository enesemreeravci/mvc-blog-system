<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Middleware.php';
require_once __DIR__ . '/../Core/Csrf.php';


class AdminController extends Controller
{
    public function index(): void
    {
        requireAdmin();

        $this->view('admin/index');
    }
}