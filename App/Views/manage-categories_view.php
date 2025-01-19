<?php
if (!Session::isAdminLogged()){
    Session::redirect('/home');
}

$categories = (new CategoryController())->getAll();
?>

<main class="container flex-grow px-4 py-8 mx-auto">
    <h1 class="mb-8 text-3xl font-bold">Manage Categories</h1>

    <form action="?action=category_create" method="POST" class="p-6 mb-8 bg-gray-800 rounded-lg shadow-md">
        <input type="hidden" name="csrf" value="<?= genToken() ?>">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Category Name</label>
                <input type="text" name="name" id="name" class="block w-full mt-1 text-white bg-gray-700 border-gray-600 rounded-sm" required>
            </div>
            <div>
                <button type="submit" class="btn_second">
                    Add Category
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
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($category['id']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($category['name']) ?></td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="flex space-x-6">
                                    <a href="?action=category_delete&id=<?= $category['id'] ?>&csrf=<?= genToken() ?>"
                                        class="text-red-400 hover:text-red-300" aria-label="Delete">
                                        Delete
                                    </a>
                                    <button type="button" id="editCat" class="text-blue-400 hover:text-blue-300" aria-label="Edit">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<section id="editForm" class="fixed items-center justify-center hidden w-screen h-screen bg-black/50 backdrop-blur-lg">
    <form action="?action=category_update" method="POST" class="w-1/2 p-6 mb-8 bg-gray-800 rounded-lg shadow-md">
        <input type="hidden" name="csrf" value="<?= genToken() ?>">
        <input type="hidden" name="id" id="idInput">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Category Name</label>
                <input type="text" name="name" id="name" class="block w-full mt-1 text-white bg-gray-700 border-gray-600 rounded-sm" required>
            </div>
            <div class="flex justify-between w-full">
                <button type="submit" class="btn_second">
                    Update Category
                </button>
                <button id="closeEdit" type="button" class="bg-red-500 btn_second hover:bg-red-700">
                    Cancel
                </button>
            </div>
        </div>
    </form>
</section>