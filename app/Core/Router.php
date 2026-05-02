<?php

class Router
{
    public function route(): void
    {
        $url = $_GET['url'] ?? '';

        switch($url)
        {
            case '':
                $controller = new HomeController();
                $controller->index();
                break;
        
            case 'register':
                $controller = new AuthController();
                $controller->register();
                break;

            case 'login':
                $controller = new AuthController();
                $controller->login();
                break;
            
            case 'logout':
                $controller = new AuthController();
                $controller->logout();
                break;
            
            case 'posts/create':
                $controller = new PostController();
                $controller->create();
                break;

            case 'posts/edit':
                $controller = new PostController();
                $controller->edit();
                break;

            case 'posts/delete':
                $controller = new PostController();
                $controller->delete();
                break;

            case 'post':
                $controller = new PostController();
                $controller->show();
                break;
                
            case 'comments/store':
                $controller = new PostController();
                $controller->comment();
                break;
            
            case 'comments/delete':
                $controller = new PostController();
                $controller->deleteComment();
                break;

            case 'admin':
                $controller = new AdminController();
                $controller->index();
                break;
            
            case 'admin/categories':
                $controller = new AdminCategoryController();
                $controller->index();
                break;

            case 'admin/categories/store':
                $controller = new AdminCategoryController();
                $controller->store();
                break;
            
            case 'admin/categories/delete':
                $controller = new AdminCategoryController();
                $controller->delete();
                exit;

            default:
                echo "404 Not found";
                break;
        }
    }
    
}
