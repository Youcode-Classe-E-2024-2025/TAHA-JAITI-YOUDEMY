<?php

function isAdminLogged(){
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'){
        return true;
    }
    return false;
}

function isTeacherLogged(){
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'teacher'){
        return true;
    }
    return false;
}