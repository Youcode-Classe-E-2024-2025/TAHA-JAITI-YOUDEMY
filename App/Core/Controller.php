<?php

class Controller
{
    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    protected function secure($input){
        return trim(htmlspecialchars($input));
    }
}
