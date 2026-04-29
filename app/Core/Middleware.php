<?php

require_once __DIR__ . '/Session.php';

function requireLogin(): void
{
    if(!isset($_SESSION['user']))
    {
        Session::setFlash('error', 'You must log in first.');
        header('Location: /mvc_blog_system/public/?url=login');
        exit;
    }
}

function requireAdmin(): void
{
    requireLogin();

    if(!isset($_SESSION['user']['role']) !== 'admin')
    {
        Session::setFlash('error', 'Admin access required');
        header('Location: /mvc_blog_system/public/');
        exit;
    }
    
}