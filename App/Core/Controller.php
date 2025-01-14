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

    protected function validateToken(string $token): bool
    {   
        if (isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token)){
            unset($_SESSION['csrf']);
            return true;
        }
        return false;
    }

    protected function getData(){
        $data = [];

        foreach ($_POST as $key => $value){
            if ($key === 'csrf'){
                continue;
            }
            $datum = is_string($value) ? $this->secure($value) : $value;

            $data[$key] = $datum;
        }

        return $data;
    }
}
