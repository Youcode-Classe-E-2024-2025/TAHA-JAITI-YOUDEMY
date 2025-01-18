<?php

class Session
{
    public static function isAdminLogged(): bool
    {
        return self::getRole() === 'admin';
    }

    public static function isTeacherLogged(): bool
    {
        return self::getRole() === 'teacher';
    }

    public static function getRole(): string
    {
        return $_SESSION['user']['role'] ?? 'visitor';
    }

    public static function getId(): int
    {
        return $_SESSION['user']['id'] ?? 0;
    }

    public static function redirect(string $url): void
    {
        self::checkSession();
        header("Location: $url");
        exit;
    }

    public static function redirectErr(string $url = '/404', string $msg = "An unexpected error occurred. Please try again."): void
    {
        self::checkSession();
        $_SESSION['error'] = $msg;
        self::redirect($url);
    }

    public static function redirectSuccess(string $url = '/home', string $msg = "Operation successful!"): void
    {
        self::checkSession();
        $_SESSION['success'] = $msg;
        self::redirect($url);
    }

    private static function checkSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}