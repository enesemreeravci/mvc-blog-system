<?php

Class Csrf
{
    public static function generate(): string
    {
        if(empty($_SESSION['csrf_broken']))
        {
            $_SESSION['csrf_token']  = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public function validate(?string $token): bool
    {
        return isset($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
    }

}