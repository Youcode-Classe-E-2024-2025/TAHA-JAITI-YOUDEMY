<?php

class Router
{
    private $actionDirectory;
    private $viewDirectory;

    private $defaultView;
    private $notFound;


    public function __construct(
        $dir = __DIR__ . '/../Views',
        $default = 'home',
        $notFound = '404',
        $actionDir = __DIR__ . '/../Controllers'
    ) {
        $this->viewDirectory = rtrim($dir, '/') . '/';
        $this->defaultView = $default;
        $this->notFound = $notFound;
        $this->actionDirectory = rtrim($actionDir, '/') . '/';
    }

    public function view(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            
            $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
            $uri = empty($uri[0]) ? $this->defaultView : $uri[0];

            $view = ucfirst(strtolower($uri));

            if (isset($_GET)){
                $view = explode('?', $view);
                $view = $view[0];
            }

            $viewFile = $this->viewDirectory . $view . '_view.php';

            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                require_once $this->viewDirectory . $this->notFound . '_view.php';
            }
        }
    }

    public function action()
    {
        if (!isset($_GET['action'])) {
            return;
        }

        $action = basename($_GET['action']);

        $action = explode('_', $action);

        $className = ucfirst(strtolower($action[0])) . 'Controller';
        $methodName = strtolower($action[1]);

        $actionFile = $this->actionDirectory . $className . '.php';

        if (!file_exists($actionFile)){
            echo 'none';
            return;
        }

        require_once $actionFile;

        if (class_exists($className, true) && method_exists($className, $methodName)) {
            $controller = new $className();
            return call_user_func([$controller, $methodName]);
        }

        return;
    }
}
