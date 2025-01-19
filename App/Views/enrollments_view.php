<?php
if (!Session::isAdminLogged() && !Session::isTeacherLogged()){
    Session::redirect('/home');
}

$users = (new EnrollmentController())->getCourseStudents();
$course = (new CourseController())->getById();
?>

<main class="container flex-grow px-4 py-8 mx-auto">
    <h1 class="mb-8 text-3xl font-bold">Enrollments for <span class="text-blue-500"><?= $course->getTitle()?></span></h1>

    <div class="overflow-hidden bg-gray-800 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Name</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user->getName()) ?></td>
                            <td class="px-4 py-4 whitespace-nowrap"><?= str_secure($user->getEmail()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>