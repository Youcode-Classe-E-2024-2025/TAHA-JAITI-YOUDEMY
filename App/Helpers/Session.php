<?php

class Session{
    public static function isAdminLogged(){
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'){
            return true;
        }
        return false;
    }
    
    public static function isTeacherLogged(){
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'teacher'){
            return true;
        }
        return false;
    }
    
    public static function getRole(){
        if (isset($_SESSION['user'])){
            return $_SESSION['user']['role'];
        }
        return null;
    }
}