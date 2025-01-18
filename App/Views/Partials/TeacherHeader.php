<?php
$isLogged = $_SESSION['user'] ?? null;
?>

<header class="sticky top-0 z-10 bg-gray-800 border-b border-gray-700">
    <div class="container flex items-center justify-between px-4 py-4 mx-auto">
        <!-- Logo -->
        <a href="/home" class="text-2xl font-bold text-blue-400 transition-colors hover:text-blue-300">YOUDEMY</a>

        <!-- Navigation -->
        <nav class="items-center hidden space-x-8 md:flex">
            <a href="/mystats" class="text-gray-300 transition-colors hover:text-blue-400">Statistics</a>
            <a href="/manage-courses" class="text-gray-300 transition-colors hover:text-blue-400">Manage Courses</a>
        </nav>

        <?php if ($isLogged): ?>
            <a href="?action=auth_logout" class="px-4 py-2 text-white transition-colors bg-blue-600 rounded hover:bg-blue-700">Log out</a>
        <?php endif; ?>

        <!-- Mobile Menu Button -->
        <button id="openNav" class="text-gray-300 md:hidden hover:text-white focus:outline-none">
            <span class="icon-[mdi--hamburger-menu] text-4xl"></span>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <nav
        id="mobileNav"
        class="fixed flex-col items-center justify-center hidden w-full px-4 py-6 space-y-4 bg-gray-800 border-t border-gray-700">
        <a href="/mystats" class="text-gray-300 transition-colors hover:text-blue-400">Statistics</a>
        <a href="/manage-courses" class="text-gray-300 transition-colors hover:text-blue-400">Manage Courses</a>
        <?php if ($isLogged): ?>
            <a href="?action=auth_logout" class="w-full px-4 py-2 text-center text-white transition-colors bg-blue-600 rounded hover:bg-blue-700">Log out</a>
        <?php endif; ?>
    </nav>
</header>

<?php require_once __DIR__ . '/../Helper/Message.php' ?>