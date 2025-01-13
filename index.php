<?php
require_once __DIR__ . '/App/Bootstrap.php';

$db = new Database();
$router = new Router();

$router->action();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youdemy</title>
</head>

<body class="bg-gray-900 text-gray-100 h-screen w-screen flex flex-col">

    <?php
    //HEADER
    require_once __DIR__ . '/App/Views/Header.php';
    
    //VIEWS LOGIC
    $router->view();
    
    //FOOTER
    require_once __DIR__ . '/App/Views/Footer.php';
    ?>

</body>

</html>