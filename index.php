<?php
require_once __DIR__ . '/App/Bootstrap.php';

$db = new Database();

$router = new Router();

$router->route();