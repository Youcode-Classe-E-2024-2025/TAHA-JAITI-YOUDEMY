<?php
$query = $_GET['q'] ?? '';
$courses = (new CourseController())->search();

?>

<main class="container px-4 py-8 mx-auto">
    <!-- Search -->
    <form action="/search" method="GET" class="flex items-center justify-center gap-4 my-5">
        <input
            type="text"
            name="q"
            placeholder="Search courses..."
            class="w-full p-2 text-white bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="<?= str_secure($query) ?>"
        />
        <button
            type="submit"
            class="btn_second">
            Search
        </button>
    </form>

    <!-- Course Container -->
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <?php if (empty($courses)): ?>
            <div class="p-12 text-center bg-gray-800/50 rounded-xl">
                <span class="icon-[mdi--book-outline] text-6xl text-gray-400 mb-4 inline-block"></span>
                <p class="text-lg text-gray-400">No courses found.</p>
            </div>
        <?php else: ?>
            <?php foreach ($courses as $course): ?>
                <div class="bg-gray-800/90 rounded-sm shadow-xl overflow-hidden h-full flex flex-col transform transition-all duration-200 hover:scale-[1.02] hover:shadow-2xl">
                    <!-- Image -->
                    <div class="relative">
                        <img class="object-cover w-full h-52" src="<?= str_secure($course->getImage()) ?>" alt="Course Image">
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
                            <?= str_secure($course->getCategory()->getName()) ?>
                        </div>

                        <!-- Footer -->
                        <div class="pt-4 space-y-2 border-t border-gray-700">
                            <div class="flex gap-4">
                                <a href="/course?id=<?= $course->getId() ?>"
                                    class="w-full btn_second">
                                    View Details
                                </a>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-400">
                                <span class="icon-[mdi--account-outline]"></span>
                                <?= str_secure($course->getTeacher()->getName()) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>