<?php
$courses = (new CourseController())->getAll();
?>

<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Manage Courses</h1>

    <!-- Add Course Button -->
    <div class="my-6">
        <a href="/course/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">Add Course</a>
    </div>

    <!-- Course Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($courses as $course): ?>
            <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden h-full">
                <img class="w-full h-48 object-cover" src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" alt="Course Image">
                <div class="p-4">
                    <h2 class="text-xl font-bold text-gray-300 mb-2"><?= $course->getTitle() ?></h2>
                    <p class="text-sm text-gray-400 mb-4"><?= $course->getDescription() ?></p>
                    <div class="mt-4 flex space-x-4">
                        <a href="/course/edit?id=<?= $course->getId() ?>" class="text-blue-400 hover:text-blue-300">Edit</a>
                        <a href="/course/delete?id=<?= $course->getId() ?>&csrf=<?= genToken() ?>" class="text-red-400 hover:text-red-300">Delete</a>
                        <a href="/course/enrollments?id=<?= $course->getId() ?>" class="text-green-400 hover:text-green-300">Enrollments</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>