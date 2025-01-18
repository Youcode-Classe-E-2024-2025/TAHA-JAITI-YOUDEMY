<?php
session_start();
require_once __DIR__ . '/App/Bootstrap.php';

$db = new Database();
$router = new Router();

$router->action();

if (Session::isAdminLogged()) {
    $header = '/App/Views/Partials/AdminHeader.php';
} elseif (Session::isTeacherLogged()) {
    $header = '/App/Views/Partials/TeacherHeader.php';
} else {
    $header = '/App/Views/Partials/Header.php';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/output.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js" integrity="sha512-/4EpSbZW47rO/cUIb0AMRs/xWwE8pyOLf8eiDWQ6sQash5RP1Cl8Zi2aqa4QEufjeqnzTK8CLZWX7J5ZjLcc1Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Youdemy</title>
</head>

<body class="bg-gray-900 text-gray-100 h-screen w-screen flex flex-col">

    <?php
    //HEADER
    require_once __DIR__ . $header;

    //VIEWS LOGIC
    $router->view();

    //FOOTER
    require_once __DIR__ . '/App/Views/Partials/Footer.php';
    ?>

    <script type="module" src="/src/main.js"></script>
</body>

</html>