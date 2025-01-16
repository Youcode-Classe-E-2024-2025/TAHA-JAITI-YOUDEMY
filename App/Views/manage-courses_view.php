<?php
// $courses = (new CourseController())->getAll();
// $categories = (new CategoryController())->getAll();
// $tags = (new TagController())->getAll();

?>

<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Manage Courses</h1>

    <!-- Add Button -->
    <div class="my-6">
        <button id="addBtn" class="btn_second">Add Course</button>
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
                    <img class="w-full h-48 object-cover" src="<?= $course->getImage() ? $course->getImage() : '/Assets/default.webp' ?>" alt="Course Image">

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
                            <span class="font-semibold">Category:</span> <?= $course->getCategory()->getById()->getName() ?>
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

<div id="addContainer" class="h-screen w-screen fixed inset-0 hidden justify-center items-center bg-black/50 backdrop-blur-md z-50">
    <form id="addForm" action="?action=course_create" method="POST" enctype="multipart/form-data" class="bg-gray-800 rounded-sm shadow-md p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <input type="hidden" name="csrf" value="<?= genToken() ?>">

        <!-- Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Title</label>
            <input type="text" name="title" id="title" class="input-field" required>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="input-field" required></textarea>
        </div>

        <!-- Content -->
        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Content</label>
            <textarea name="content" id="content" rows="6" class="input-field" required></textarea>
        </div>

        <!-- Image -->
        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Image</label>
            <div class="flex items-center justify-center w-full">
                <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-700 hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-400">PNG, JPG, GIF (MAX. 800x400px)</p>
                    </div>
                    <input type="file" name="image" id="image" class="hidden" />
                </label>
            </div>
        </div>

        <!-- Category -->
        <div class="mb-6">
            <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
            <select name="category_id" id="category_id" class="input-field" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= str_secure($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tags -->
        <div class="mb-6">
            <label for="tags" class="block text-sm font-medium text-gray-300 mb-2">Tags</label>
            <select name="tags[]" id="tags" multiple class="input-field" required>
                <?php foreach ($tags as $tag): ?>
                    <option value="<?= $tag['id'] ?>"><?= str_secure($tag['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="btn_second w-full">Create Course</button>
        </div>
    </form>
</div>

<script>
    const formContainer = document.getElementById('addContainer');
    const form = document.getElementById('addForm');
    const btn = document.getElementById('addBtn');

    if (btn && form && formContainer) {
        const toggle = () => {
            formContainer.classList.toggle('hidden');
            formContainer.classList.toggle('flex');
        };

        btn.addEventListener('click', toggle);

        formContainer.addEventListener('click', (e) => {
            if (e.target === formContainer) {
                toggle();
            }
        });

        form.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }
</script>