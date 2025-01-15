<?php
$courses = (new CourseController())->getAll();
?>

<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Manage Courses</h1>

    <!-- Add Button -->
    <div class="my-6">
        <a href="?action=course_save" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">Add Course</a>
    </div>

    <!-- Container -->
    <?php if (empty($courses)): ?>
        <div class="text-center text-gray-400">
            <p>No courses found.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($courses as $course): ?>
                <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden h-full flex flex-col">
                    <!-- Image -->
                    <img class="w-full h-48 object-cover" src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" alt="Course Image">

                    <!-- Details -->
                    <div class="p-4 flex flex-col flex-grow">
                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-300 mb-2"><?= str_secure($course->getTitle()) ?></h2>

                        <!-- Description -->
                        <p class="text-sm text-gray-400 mb-4 flex-grow"><?= str_secure($course->getDescription()) ?></p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($course->getTags() as $tag): ?>
                                <span class="bg-gray-700 text-gray-300 text-sm px-2 py-1 rounded"><?= str_secure($tag->getName()) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Category -->
                        <p class="text-sm text-gray-400">
                            <span class="font-semibold">Category:</span> <?= str_secure($course->getCategory()->getName()) ?>
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="p-4 border-t border-gray-700">
                        <div class="flex space-x-4">
                            <a href="?action=course_edit&id=<?= $course->getId() ?>" class="text-blue-400 hover:text-blue-300">Edit</a>
                            <a href="?action=course_delete&id=<?= $course->getId() ?>&csrf=<?= genToken() ?>" class="text-red-400 hover:text-red-300">Delete</a>
                            <a href="/course_enrolls?id=<?= $course->getId() ?>" class="text-green-400 hover:text-green-300">Enrollments</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>