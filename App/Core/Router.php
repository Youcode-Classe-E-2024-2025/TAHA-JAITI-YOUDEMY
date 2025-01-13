<?php

class Router
{

    // Directory paths for controllers and views
    private $actionDirectory;
    private $viewDirectory;

    // Default view and 404 view
    private $defaultView;
    private $notFound;

    /**
     * Router constructor.
     *
     * Initializes the paths for views and controllers, as well as the default 
     * and 404 views to handle routing logic.
     *
     * @param string $dir Path to the directory containing view files.
     * @param string $default Name of the default view to load when no specific view is requested.
     * @param string $notFound Name of the view to render for invalid routes (404).
     * @param string $actionDir Path to the directory containing controller files.
     */
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

    /**
     * Handles rendering of views based on the URI.
     *
     * - If the HTTP method is GET, parses the URI to determine the view to load.
     * - If no view is specified, loads the default view.
     * - If the specified view file does not exist, renders the 404 view.
     *
     * @return void
     */
    public function view(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            // Parse URI and get the requested view
            $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
            $uri = empty($uri[0]) ? $this->defaultView : $uri[0];

            // Format view name and determine file path
            $view = ucfirst(strtolower($uri));
            $viewFile = $this->viewDirectory . $view . '_view.php';

            // Load the view if it exists, or load the 404 view otherwise
            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                require_once $this->viewDirectory . $this->notFound . '_view.php';
            }
        }
    }

    /**
     * Execute the controller action based on the `action` parameter in the URL.
     *
     * - The `action` parameter should follow the format `Controller_method`.
     * - The corresponding controller file and method will be called if they exist.
     *
     * @return mixed The return value of the controller method, if any.
     */
    public function action()
    {
        // Check if the `action` parameter is set in the URL
        if (!isset($_GET['action'])) {
            return;
        }

        // Retrieve and sanitize the action name
        $action = basename($_GET['action']);
        $action = explode('_', $action);

        // Extract the controller class name and method name
        $className = $action[0] . 'Controller';
        $actionFile = $this->actionDirectory . $action[0] . 'Controller.php';

        // Check if the controller file and method exist
        if (class_exists($className, true)) {
            require_once $actionFile;
            if (method_exists($className, $action[1])) {
                // Instantiate the controller and call the method
                $controller = new $className();
                return call_user_func([$controller, $action[1]]);
            }
        }
    }
}
