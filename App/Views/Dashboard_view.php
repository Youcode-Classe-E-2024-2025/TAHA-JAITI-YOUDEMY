<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Gestion des cours</h1>

    <div class="mb-8">
        <a href="#" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Ajouter un nouveau cours
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Titre du cours</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Catégorie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Étudiants inscrits</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">Introduction au React et Next.js</td>
                    <td class="px-6 py-4 whitespace-nowrap">Développement Web</td>
                    <td class="px-6 py-4 whitespace-nowrap">1,234</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Publié</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Modifier</a>
                        <a href="#" class="text-red-400 hover:text-red-300">Supprimer</a>
                    </td>
                </tr>
                <!-- Add more rows for other courses -->
            </tbody>
        </table>
    </div>
</main>