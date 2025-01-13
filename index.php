<?php
require_once __DIR__ . '/App/Bootstrap.php';

$db = new Database();
$router = new Router();

require_once __DIR__ . '/App/Views/Header.php';

$router->view();
$router->action();

require_once __DIR__ . '/App/Views/Footer.php';