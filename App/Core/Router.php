<?php

class Router {

    private $dir;
    private $default;
    private $notFound;

    public function __construct($dir = __DIR__ . '/../Views', $default = 'Home', $notFound = '404'){
        $this->dir = rtrim($dir, '/') . '/';
        $this->default = $default;
        $this->notFound = $notFound;
    }

    public function route(): void {
        $view = $_GET['view'] ?? $this->default;

        $view = basename($view);

        $viewFile = $this->dir . $view . '_view.php';
        if (file_exists($viewFile)){
            require_once $viewFile;
        } else {
            require_once $this->dir . $this->notFound . '_view.php';
        }
    }
}