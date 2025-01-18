<?php
$tags = (new TagController())->getAll();
?>

<main class="container flex-grow px-4 py-8 mx-auto">
    <h1 class="mb-8 text-3xl font-bold">Manage Tags</h1>

    <form action="?action=tag_create" method="POST" class="p-6 mb-8 bg-gray-800 rounded-lg shadow-md">
        <input type="hidden" name="csrf" value="<?= genToken() ?>">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Tag Names (seperate by , )</label>
                <input type="text" name="name" id="name" class="input-field" required>
            </div>
            <div>
                <button type="submit" class="btn_second">
                    Add Tags
                </button>
            </div>
        </div>
    </form>

    <div class="overflow-hidden bg-gray-800 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Name</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php foreach ($tags as $tag): ?>
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($tag['id']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($tag['name']) ?></td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
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