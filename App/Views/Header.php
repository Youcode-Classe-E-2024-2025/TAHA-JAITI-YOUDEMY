<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./src/output.css">
    <title>Document</title>
</head>

<body class="bg-gray-900 text-gray-100 h-screen w-screen flex flex-col">
    <header class="bg-gray-800 border-b border-gray-700 sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-blue-400">YOUDEMY</a>
            <nav class="hidden md:flex space-x-6 justify-center items-center">
                <a href="#" class="hover:text-blue-400 transition-colors">Catalog</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Log in</a>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded transition-colors">Sign up</a>
            </nav>
            <button class="md:hidden text-gray-300 hover:text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>