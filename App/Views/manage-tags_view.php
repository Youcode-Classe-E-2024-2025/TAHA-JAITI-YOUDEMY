<?php
$tags = (new TagController())->getAll();
?>

<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Manage Tags</h1>

    <form action="?action=tag_create" method="POST" class="bg-gray-800 rounded-lg shadow-md p-6 mb-8">
        <input type="hidden" name="csrf" value="<?= genToken() ?>">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Tag Names (seperate by , )</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-sm bg-gray-700 border-gray-600 text-white" required>
            </div>
            <div>
                <button type="submit" class="btn_second">
                    Add Tags
                </button>
            </div>
        </div>
    </form>

    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php foreach ($tags as $tag): ?>
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($tag['id']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($tag['name']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-6">
                                    <a href="?action=tag_delete&id=<?= $tag['id'] ?>&csrf=<?= genToken() ?>"
                                        class="text-red-400 hover:text-red-300" aria-label="Delete">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>