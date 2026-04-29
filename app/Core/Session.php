<?php

class Session
{
    public static function setFlash(string $key, string $message): void
    {
        $_SESSION['flash'][$key] = $message;
    }

    public static function getFLash(string $key): ?string
    {
        if(!isset($_SESSION['flash'][$key]))
        {
            return null;
        }

        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);

        return $message;
    }
}