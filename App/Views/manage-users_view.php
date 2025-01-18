<?php
$users = (new UserController())->getAll();
?>

<main class="container flex-grow px-4 py-8 mx-auto">
    <h1 class="mb-8 text-3xl font-bold">Manage Users</h1>

    <div class="overflow-hidden bg-gray-800 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Name</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Email</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Role</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Status</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Created At</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['id']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['name']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['email']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['role']) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <?php
                                $statusColor = [
                                    'pending' => 'bg-red-100 text-red-800',
                                    'active' => 'bg-green-100 text-green-800',
                                    'suspended' => 'bg-yellow-100 text-yellow-800',
                                ];

                                $class = $statusColor[$user['status']] ?? 'bg-gray-100 text-gray-800';
                                ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $class ?>">
                                    <?= str_secure($user['status']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user['created_at']) ?></td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="flex space-x-6">
                                    <?php if ($user['status'] !== 'active'): ?>

                                        <a href="?action=user_approve&id=<?= $user['id'] ?>&csrf=<?= genToken() ?>"
                                            class="text-green-400 hover:text-green-300" aria-label="Approve">
                                            Approve
                                        </a>
                                    <?php elseif ($user['status'] !== 'suspended'): ?>
                                        <a href="?action=user_suspend&id=<?= $user['id'] ?>&csrf=<?= genToken() ?>"
                                            class="text-orange-400 hover:text-orange-300" aria-label="Suspend">
                                            Suspend
                                        </a>
                                    <?php endif; ?>
                                    <a href="?action=user_delete&id=<?= $user['id'] ?>&csrf=<?= genToken() ?>"
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