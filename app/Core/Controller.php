<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        require_once __DIR__ . '/../Views/layouts/header.php';
        require_once __DIR__ . '/../Views/' . $view . '.php';
        require_once __DIR__ . '/../Views/layouts/footer.php'; 
    }
}
