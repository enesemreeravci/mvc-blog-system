<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MVC Blog System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .main-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .content-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        }

        .user-badge {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .btn {
            border-radius: 20px;
            padding: 6px 16px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container main-container">
        <a class="navbar-brand" href="/mvc_blog_system/public/">
            MVC Blog
        </a>

        <div class="d-flex align-items-center gap-2">
            <?php if (isset($_SESSION['user'])): ?>

                <span class="user-badge">
                    Hello, <?= htmlspecialchars($_SESSION['user']['username']) ?>
                </span>

                <a class="btn btn-outline-light btn-sm" href="/mvc_blog_system/public/?url=logout">
                    Logout
                </a>

            <?php else: ?>

                <a class="btn btn-outline-light btn-sm" href="/mvc_blog_system/public/?url=login">
                    Login
                </a>

                <a class="btn btn-primary btn-sm" href="/mvc_blog_system/public/?url=register">
                    Register
                </a>

            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container main-container">

<?php
require_once __DIR__ . '/../../Core/Session.php';

$success = Session::getFlash('success');
$error = Session::getFlash('error');
?>

<?php if ($success): ?>
    <div class="alert alert-success shadow-sm">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger shadow-sm">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<div class="content-card">