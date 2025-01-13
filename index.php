<!DOCTYPE html>
<html lang="fr" class="bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Catalogue des cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">
    <header class="bg-gray-800 border-b border-gray-700 sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-blue-400">Youdemy</a>
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-blue-400 transition-colors">Catalogue</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Catégories</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Connexion</a>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded transition-colors">Inscription</a>
            </nav>
            <button class="md:hidden text-gray-300 hover:text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Découvrez nos cours</h1>
        
        <div class="mb-8 flex justify-center">
            <div class="relative w-full max-w-xl">
                <input type="text" placeholder="Rechercher un cours..." class="w-full pl-10 pr-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                <img src="https://source.unsplash.com/random/400x225?coding" alt="Course thumbnail" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-blue-400 text-xs font-semibold tracking-wide uppercase">Développement Web</span>
                    <h3 class="text-xl font-semibold mt-2">Introduction au React et Next.js</h3>
                    <p class="text-gray-400 mt-2">Apprenez à créer des applications web modernes avec React et Next.js</p>
                    <div class="mt-4 flex items-center text-sm text-gray-400">
                        <span class="flex items-center mr-4"><i class="fas fa-book-open mr-2"></i>12 leçons</span>
                        <span class="flex items-center mr-4"><i class="fas fa-users mr-2"></i>1,234 étudiants</span>
                        <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-2"></i>4.8</span>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-750 flex justify-between items-center border-t border-gray-700">
                    <span class="text-sm font-semibold">John Doe</span>
                    <span class="font-bold text-blue-400">49,99 €</span>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                <img src="https://source.unsplash.com/random/400x225?marketing" alt="Course thumbnail" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-green-400 text-xs font-semibold tracking-wide uppercase">Marketing Digital</span>
                    <h3 class="text-xl font-semibold mt-2">Stratégies de Marketing sur les Réseaux Sociaux</h3>
                    <p class="text-gray-400 mt-2">Maîtrisez les techniques de marketing sur les principales plateformes sociales</p>
                    <div class="mt-4 flex items-center text-sm text-gray-400">
                        <span class="flex items-center mr-4"><i class="fas fa-book-open mr-2"></i>15 leçons</span>
                        <span class="flex items-center mr-4"><i class="fas fa-users mr-2"></i>2,567 étudiants</span>
                        <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-2"></i>4.9</span>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-750 flex justify-between items-center border-t border-gray-700">
                    <span class="text-sm font-semibold">Jane Smith</span>
                    <span class="font-bold text-blue-400">59,99 €</span>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                <img src="https://source.unsplash.com/random/400x225?design" alt="Course thumbnail" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-purple-400 text-xs font-semibold tracking-wide uppercase">Design UX/UI</span>
                    <h3 class="text-xl font-semibold mt-2">Principes de Design d'Interface Utilisateur</h3>
                    <p class="text-gray-400 mt-2">Créez des interfaces utilisateur attrayantes et fonctionnelles</p>
                    <div class="mt-4 flex items-center text-sm text-gray-400">
                        <span class="flex items-center mr-4"><i class="fas fa-book-open mr-2"></i>20 leçons</span>
                        <span class="flex items-center mr-4"><i class="fas fa-users mr-2"></i>3,789 étudiants</span>
                        <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-2"></i>4.7</span>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-750 flex justify-between items-center border-t border-gray-700">
                    <span class="text-sm font-semibold">Alex Johnson</span>
                    <span class="font-bold text-blue-400">69,99 €</span>
                </div>
            </div>

            <!-- Additional course cards can be added here -->

        </div>

        <div class="mt-12 flex justify-center">
            <a href="#" class="mx-1 px-4 py-2 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 transition-colors">Précédent</a>
            <a href="#" class="mx-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">1</a>
            <a href="#" class="mx-1 px-4 py-2 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 transition-colors">2</a>
            <a href="#" class="mx-1 px-4 py-2 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 transition-colors">3</a>
            <a href="#" class="mx-1 px-4 py-2 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 transition-colors">Suivant</a>
        </div>
    </main>

    <footer class="bg-gray-800 border-t border-gray-700 mt-12 py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; 2023 Youdemy. Tous droits réservés.</p>
            <div class="mt-4 flex justify-center space-x-6">
                <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">À propos</a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Confidentialité</a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Conditions d'utilisation</a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>