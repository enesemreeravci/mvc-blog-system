<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MVC Blog System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/mvc_blog_system/public/">MVC Blog</a>

        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <span class="text-white me-3">
                    Hello, <?= htmlspecialchars($_SESSION['user']['username']) ?>
                </span>
                <a class="btn btn-outline-light btn-sm" href="/mvc_blog_system/public/?url=logout">Logout</a>
            <?php else: ?>
                <a class="btn btn-outline-light btn-sm me-2" href="/mvc_blog_system/public/?url=login">Login</a>
                <a class="btn btn-primary btn-sm" href="/mvc_blog_system/public/?url=register">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">

<?php
require_once __DIR__ . '/../../Core/Session.php';

$success = Session::getFlash('success');
$error = Session::getFlash('error');
?>

<?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>