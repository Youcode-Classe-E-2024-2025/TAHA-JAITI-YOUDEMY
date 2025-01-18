<?php
$isLogged = $_SESSION['user'] ?? null;
?>

<header class="sticky top-0 z-10 bg-gray-800 border-b border-gray-700">
    <div class="container flex items-center justify-between px-4 py-4 mx-auto">
        <!-- Logo -->
        <a href="/home" class="text-2xl font-bold text-blue-400 transition-colors hover:text-blue-300">YOUDEMY</a>
        <!-- Desktop Navigation -->
        <nav class="items-center hidden space-x-8 md:flex">
            <a href="/statistics" class="text-gray-300 transition-colors hover:text-blue-400">Statistics</a>
            <a href="/manage-users" class="text-gray-300 transition-colors hover:text-blue-400">Manage Users</a>
            <a href="/manage-courses" class="text-gray-300 transition-colors hover:text-blue-400">Manage Courses</a>
            <a href="/manage-tags" class="text-gray-300 transition-colors hover:text-blue-400">Manage Tags</a>
            <a href="/manage-categories" class="text-gray-300 transition-colors hover:text-blue-400">Manage Categories</a>
            <?php if ($isLogged): ?>
                <a href="?action=auth_logout" class="px-4 py-2 text-white transition-colors bg-blue-600 rounded hover:bg-blue-700">Log out</a>
            <?php endif; ?>
        </nav>
        <!-- Mobile Menu Button -->
        <button id="openNav" class="text-gray-300 md:hidden hover:text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <!-- Mobile Navigation -->
    <nav id="mobileNav" class="fixed flex-col items-center justify-center hidden w-full px-4 py-6 space-y-4 bg-gray-800 border-t border-gray-700 top-16">
        <a href="/statistics" class="text-gray-300 transition-colors hover:text-blue-400">Statistics</a>
        <a href="/manage-users" class="text-gray-300 transition-colors hover:text-blue-400">Manage Users</a>
        <a href="/manage-courses" class="text-gray-300 transition-colors hover:text-blue-400">Manage Courses</a>
        <a href="/manage-tags" class="text-gray-300 transition-colors hover:text-blue-400">Manage Tags</a>
        <a href="/manage-categories" class="text-gray-300 transition-colors hover:text-blue-400">Manage Categories</a>
        <?php if ($isLogged): ?>
            <a href="?action=auth_logout" class="w-full px-4 py-2 text-center text-white transition-colors bg-blue-600 rounded hover:bg-blue-700">Log out</a>
        <?php endif; ?>
    </nav>
</header>
<?php require_once __DIR__ . '/../Helper/Message.php' ?>