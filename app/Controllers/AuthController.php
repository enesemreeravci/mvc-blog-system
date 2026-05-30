<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Session.php';
require_once __DIR__ . '/../Core/Csrf.php';
require_once __DIR__ . '/../Models/User.php';

class AuthController extends Controller
{
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            if(!Csrf::validate($_POST['csrf_token'] ?? null))
            {
                Session::setFlash('error', 'Invalid CSRF token');
                header('Location: /mvc_blog_system/public/');
                exit;
            }
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!$username || !$email || !$password) {
                Session::setFlash('error', 'All fields are required!');
                header('Location: /mvc_blog_system/public/?url=register');
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userModel = new User();    
            //try and catch
            try 
            {
                $userModel = new User();
                $success = $userModel->create($username, $email, $hashedPassword);

                if ($success) {
                    Session::setFlash('success', 'Registration successful!');
                } else {
                    Session::setFlash('error', 'Registration failed!');
                }

            } 
            catch (PDOException $e) 
            {
                Session::setFlash('error', 'Database error occurred.');
            }
            header('Location: /mvc_blog_system/public/?url=register');
            exit;
        }

        $this->view('auth/register');
    }

    public function login(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (!Csrf::validate($_POST['csrf_token'] ?? null)) 
            {
            Session::setFlash('error', 'Invalid CSRF token.');
            header('Location: /mvc_blog_system/public/?url=login');
            exit;
            }
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if(!$email || !$password)
            {
                Session::setFlash('error', 'All fields are required!');
                header('Location: /mvc_blog_system/public/?url=login');
                exit;
            }
            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if(!$user || !password_verify($password, $user['password']))
            {
                Session::setFlash('error', 'Invalid credentials');
                header('Location: /mvc_blog_system/public/?url=login');
                exit;
            }

            // store user in session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];

            Session::setFlash('success', 'Logged in successfully!');
            header('Location: /mvc_blog_system/public/');
            exit;
        }
        $this->view('auth/login');
    }   

    public function logout(): void
    {
        unset($_SESSION['user']);

        Session::setFlash('success', 'Logged out successfully!');
        header('Location: /mvc_blog_system/public/');
        exit;
    }
}