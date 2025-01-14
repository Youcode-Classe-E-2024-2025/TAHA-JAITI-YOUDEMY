<?php 
    $users = new UserController();
    $users = $users->getPending();

    dd($users);

?>

<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Manage Users</h1>

    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Created At</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['id']) ?></td>
                        <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['name']) ?></td>
                        <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['email']) ?></td>
                        <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['role']) ?></td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"><?= str_secure($user['status']) ?></span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['created_at']) ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-6">
                                <a href="#" class="text-green-400 hover:text-green-300" aria-label="Approve">Approve</a>
                                <a href="#" class="text-orange-400 hover:text-orange-300" aria-label="Suspend">Suspend</a>
                                <a href="#" class="text-red-400 hover:text-red-300" aria-label="Delete">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>