<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class AuthController extends Controller
{
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // basic validation
            if (!$username || !$email || !$password) {
                echo "All fields are required!";
                return;
            }

            // hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userModel = new User();
            $success = $userModel->create($username, $email, $hashedPassword);

            if ($success) {
                echo "User registered successfully!";
            } else {
                echo "Registration failed!";
            }

            return;
        }

        $this->view('auth/register');
    }
}