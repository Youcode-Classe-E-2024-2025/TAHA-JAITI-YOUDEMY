<?php
if (!Session::isAdminLogged() && !Session::isTeacherLogged()){
    Session::redirect('/home');
}

$course = (new CourseController())->getById();
$categories = (new CategoryController())->getAll();
$tags = (new TagController())->getAll();

if (Session::isAdminLogged()) {
    $teachers = (new UserController())->getAllTeachers();
}

?>

<main class="container px-4 py-8 mx-auto">
    <h1 class="mb-8 text-3xl font-bold">Edit Course</h1>

    <!-- Edit Course Form -->
    <form action="?action=course_update" method="POST" enctype="multipart/form-data"
        class="p-8 bg-gray-800 shadow-2xl rounded-xl">
        <!--  -->
        <input type="hidden" name="id" value="<?= $course->getId() ?>">
        <input type="hidden" name="csrf" value="<?= genToken() ?>">

        <!-- Inputs -->
        <div class="space-y-6">
            <!-- Title -->
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Title</label>
                <input type="text" name="title" id="title"
                    class="input-field"
                    value="<?= str_secure($course->getTitle()) ?>"
                    required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="input-field"
                    required><?= str_secure($course->getDescription()) ?></textarea>
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block mb-2 text-sm font-medium text-gray-300">Content</label>
                <textarea name="content" id="content" rows="6"
                    class="input-field"
                    required><?= str_secure($course->getContent()) ?></textarea>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-300">Image</label>
                <label for="image"
                    class="flex flex-col items-center justify-center w-full h-32 transition-colors duration-200 bg-gray-700 border-2 border-gray-600 border-dashed rounded-sm cursor-pointer hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <span class="icon-[mdi--cloud-upload-outline] text-4xl text-gray-400 mb-2"></span>
                        <p class="text-sm text-gray-400">
                            Click to upload
                        </p>
                    </div>
                    <input type="file" name="image" id="image" class="hidden" />
                </label>
                <!-- Image -->
                <div class="mt-2">
                    <p class="text-sm text-gray-400">Current Image:</p>
                    <img src="<?= str_secure($course->getImage()) ?>" alt="Current Course Image" class="object-cover w-32 h-32 rounded-sm">
                </div>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">Category</label>
                <select name="category_id" id="category_id"
                    class="input-field"
                    required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $cat['id'] === $course->getCategory()->getId() ? 'selected' : '' ?>>
                            <?= str_secure($cat['name']) ?>
                        </option>
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
                <!-- Teacher -->
                <div>
                    <label for="teacher_id" class="block mb-2 text-sm font-medium text-gray-300">Teacher</label>
                    <select name="teacher_id" id="teacher_id"
                        class="input-field"
                        required>
                        <?php foreach ($teachers as $teacher): ?>
                            <option value="<?= $teacher['id'] ?>" <?= $teacher['id'] === $course->getTeacher()->getId() ? 'selected' : '' ?>>
                                <?= str_secure($teacher['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>

        <!-- Submit -->
        <div class="mt-8">
            <button type="submit"
                class="btn_second">
                Update Course
            </button>
        </div>
    </form>
</main>