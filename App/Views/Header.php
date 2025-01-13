<?php 
// $user = new User();

// $user->setName('John Doe');
// $user->setEmail('john@example.com');
// $user->setPassword('password123');
// $user->setRole('student');

// if ($user->create()) {
//     echo 'User created successfully!';
// } else {
//     echo 'Failed to create user.';
// }
?>

<header class="bg-gray-800 border-b border-gray-700 sticky top-0 z-10">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/home" class="text-2xl font-bold text-blue-400">YOUDEMY</a>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-6 justify-center items-center">
            <a href="#" class="hover:text-blue-400 transition-colors">Browse</a>
            <a href="/login" class="hover:text-blue-400 transition-colors">Log in</a>
            <a href="/signup" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded transition-colors">Sign up</a>
        </nav>
        
        <!-- Mobile Menu Button -->
        <button id="openNav" class="md:hidden text-gray-300 hover:text-white">
            <span class="icon-[mdi--hamburger-menu] text-4xl"></span>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <nav 
        id="mobileNav" 
        class="hidden bg-gray-800 h-fit fixed flex-col items-center justify-center w-full border-t border-gray-700 px-4 py-6 space-y-4"
    >
        <a href="#" class="block text-gray-300 hover:text-blue-400 transition-colors">Browse</a>
        <a href="/login" class="block text-gray-300 hover:text-blue-400 transition-colors">Log in</a>
        <a href="/signup" class="w-full bg-blue-600 hover:bg-blue-700 text-center px-4 py-2 rounded transition-colors">Sign up</a>
    </nav>
</header>

<?php require_once __DIR__ . '/Helper/Message.php' ?>
