<?php

class Session{
    public static function isAdminLogged(): bool{
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'){
            return true;
        }
        return false;
    }
    
    public static function isTeacherLogged(): bool{
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'teacher'){
            return true;
        }
        return false;
    }
    
    public static function getRole(): string{
        if (isset($_SESSION['user'])){
            return $_SESSION['user']['role'];
        }
        return 'visitor';
    }

    public static function getId(): int{
        if (isset($_SESSION['user'])){
            return $_SESSION['user']['id'];
        }
        return 0;
    }

    public static function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}