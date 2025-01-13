<?php

class Router {

    private $actionDirectory;

    private $viewDirectory;
    private $defaultView;
    private $notFound;

    public function __construct($dir = __DIR__ . '/../Views', $default = 'Home', $notFound = '404', $actionDir = __DIR__ . '/../Controllers'){
        $this->viewDirectory = rtrim($dir, '/') . '/';
        $this->defaultView = $default;
        $this->notFound = $notFound;
        $this->actionDirectory = rtrim($actionDir, '/') . '/';
    }

    public function view(): void {
        $view = $_GET['view'] ?? $this->defaultView;

        $view = basename($view);

        $viewFile = $this->viewDirectory . $view . '_view.php';
        if (file_exists($viewFile)){
            require_once $viewFile;
        } else {
            require_once $this->viewDirectory . $this->notFound . '_view.php';
        }
    }

    public function action() {
        if (!isset($_GET['action'])){
            return;
        }
        
        $action = $_GET['action'];

        $action = basename($action);

        $action = explode('_', $action);

        $className = $action[0] . 'Controller';

        $actionFile = $this->actionDirectory . $action[0] . 'Controller.php' ;

        if (class_exists($className, true)){
            require_once $actionFile;
            if (method_exists($className, $action[1])){
                $controller = new $className();
                return call_user_func([$controller, $action[1]]);
            }
        }
    }
}