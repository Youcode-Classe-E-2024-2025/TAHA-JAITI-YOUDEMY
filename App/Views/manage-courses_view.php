<?php
if (!Session::isAdminLogged() && !Session::isTeacherLogged()){
    Session::redirect('/home');
}

$courses = (new CourseController())->getAll();
$categories = (new CategoryController())->getAll();
$tags = (new TagController())->getAll();

if (Session::isAdminLogged()) {
    $teachers = (new UserController())->getAllTeachers();
}
?>

<main class="container flex-grow px-4 py-12 mx-auto">
    <div class="flex items-center justify-between mb-12">
        <h1 class="text-4xl font-bold text-gray-100">Manage Courses</h1>
        <button id="addBtn" class="btn_second">
            <span class="icon-[mdi--plus] text-xl"></span>
            Add Course
        </button>
    </div>

    <?php if (empty($courses)): ?>
        <div class="h-full p-12 text-center bg-gray-800/50 rounded-xl">
            <span class="icon-[mdi--book-outline] text-6xl text-gray-400 mb-4 inline-block"></span>
            <p class="text-lg text-gray-400">No courses have been added yet.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <?php foreach ($courses as $course): ?>
                <div class="bg-gray-800/90 rounded-sm shadow-xl overflow-hidden h-full flex flex-col transform transition-all duration-200 hover:scale-[1.02] hover:shadow-2xl">
                    <!-- Image -->
                    <div class="relative">
                        <img class="object-cover w-full h-52" src="<?= $course->getImage() ?>" alt="Course Image">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent"></div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col flex-grow p-6">
                        <h2 class="mb-3 text-xl font-bold text-gray-100 line-clamp-2"><?= str_secure($course->getTitle()) ?></h2>
                        <p class="flex-grow mb-4 text-gray-400 line-clamp-3"><?= str_secure($course->getDescription()) ?></p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($course->getTags() as $tag): ?>
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-amber-900/50 text-amber-300">
                                    #<?= str_secure($tag->getName()) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Category -->
                        <div class="flex items-center gap-2 mb-4 text-sm text-gray-400">
                            <span class="icon-[mdi--folder-outline]"></span>
                            <?= $course->getCategory()->getById()->getName() ?>
                        </div>

                        <!-- Enrollments -->
                        <div class="py-4 border-t border-gray-700">
                            <div class="flex items-center justify-center gap-2 text-emerald-400">
                                <a href="/enrollments?id=<?= $course->getId() ?>">
                                    <span class="icon-[mdi--account-group-outline]"></span>
                                    Enrollments
                                </a>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-700">
                            <div class="flex gap-4">
                                <a href="?action=course_edit&id=<?= $course->getId() ?>"
                                    class="flex items-center gap-1 text-blue-400 transition-colors duration-200 hover:text-blue-300">
                                    <span class="icon-[mdi--edit-outline]"></span>
                                    Edit
                                </a>
                                <a href="?action=course_delete&id=<?= $course->getId() ?>&csrf=<?= genToken() ?>"
                                    class="flex items-center gap-1 text-red-400 transition-colors duration-200 hover:text-red-300">
                                    <span class="icon-[mdi--delete-outline]"></span>
                                    Delete
                                </a>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-400">
                                <span class="icon-[mdi--account-outline]"></span>
                                <?= $course->getTeacher()->getById()['name'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<!-- Modal -->
<div id="addContainer" class="fixed inset-0 z-50 items-center justify-center hidden w-screen h-screen bg-black/70 backdrop-blur-sm">
    <form id="addForm" action="?action=course_create" method="POST" enctype="multipart/form-data"
        class="bg-gray-800 rounded-xl shadow-2xl p-8 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-100">Add a new course</h2>
            <button type="button" id="closeBtn" class="text-gray-400 transition-colors duration-200 hover:text-gray-300">
                <span class="icon-[mdi--close] text-2xl"></span>
            </button>
        </div>

        <input type="hidden" name="csrf" value="<?= genToken() ?>">

        <!-- Form Fields -->
        <div class="space-y-6">
            <!-- Title -->
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Title</label>
                <input type="text" name="title" id="title"
                    class="input-field"
                    required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="input-field"
                    required></textarea>
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block mb-2 text-sm font-medium text-gray-300">Content</label>
                <textarea name="content" id="content" rows="6"
                    class="input-field"
                    required></textarea>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-300">Image</label>
                <label for="image"
                    class="flex flex-col items-center justify-center w-full h-32 transition-colors duration-200 bg-gray-700 border-2 border-gray-600 border-dashed rounded-sm cursor-pointer hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <span class="icon-[mdi--cloud-upload-outline] text-4xl text-gray-400 mb-2"></span>
                        <p class="text-sm text-gray-400">
                            <span class="font-medium">Click to upload</span> or drag and drop
                        </p>
                    </div>
                    <input type="file" name="image" id="image" class="hidden" />
                </label>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">Category</label>
                <select name="category_id" id="category_id"
                    class="input-field"
                    required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= str_secure($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tags -->
            <div>
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-300">Tags</label>
                <select name="tags[]" id="tags" multiple
                    class="input-field"
                    required>
                    <?php foreach ($tags as $tag): ?>
                        <option value="<?= $tag['id'] ?>"><?= str_secure($tag['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if (Session::isAdminLogged()): ?>
                <div>
                    <label for="teacher_id" class="block mb-2 text-sm font-medium text-gray-300">Teacher</label>
                    <select name="teacher_id" id="teacher_id"
                        class="w-full px-4 py-3 text-gray-100 transition-all duration-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                        <?php foreach ($teachers as $teacher): ?>
                            <option value="<?= $teacher['id'] ?>"><?= str_secure($teacher['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>

        <!-- Submit -->
        <div class="mt-8">
            <button type="submit"
                class="btn_second">
                Create Course
            </button>
        </div>
    </form>
</div>