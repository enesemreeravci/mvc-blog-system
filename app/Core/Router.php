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
            
            default:
                echo "404 Not found";
                break;
        }
    }
    
}
