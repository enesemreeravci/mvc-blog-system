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
                
            default:
                echo "404 Not found";
                break;
        }
    }
    
}
