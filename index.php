<?php
session_start();
require_once 'vendor/autoload.php';
require_once __DIR__ . '/App/Bootstrap.php';

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

<body class="text-gray-100 bg-gray-900">

    <?php //HEADER
    require_once __DIR__ . $header;
    ?>

    <div class="flex flex-col justify-between min-h-screen">
        <?php
        require_once __DIR__ . '/App/Views/Helper/Message.php';

        //VIEWS LOGIC
        $router->view();
        ?>

        <!--FOOTER-->
        <?php require_once __DIR__ . '/App/Views/Partials/Footer.php'; ?>
    </div>

    <script type="module" src="/src/main.js"></script>
</body>

</html>