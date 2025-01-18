<?php
$data = (new CourseController())->getAll();
$courses = $data['courses'];
$pagination = $data['pagination'];

?>

<main class="container px-4 py-8 mx-auto">
    <!-- Search -->
    <div class="mb-8">
        <input type="text" placeholder="Search courses..." class="w-full p-2 text-white bg-gray-700 rounded">
    </div>

    <!-- Course Container -->
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <?php if (empty($courses)): ?>
            <div class="p-12 text-center bg-gray-800/50 rounded-xl">
                <span class="icon-[mdi--book-outline] text-6xl text-gray-400 mb-4 inline-block"></span>
                <p class="text-lg text-gray-400">No courses have been added yet.</p>
            </div>
        <?php else: ?>
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
                                <?= ucfirst($course->getTeacher()->getById()['name']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8 space-x-4">
        <?php if ($pagination['page'] > 1): ?>
            <a href="/catalog?p=<?= $pagination['page'] - 1 ?>" class="font-bold btn_second">
                << /a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <a href="/catalog?p=<?= $i ?>" class="btn_second <?= $i === $pagination['page'] ? 'bg-blue-700' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($pagination['page'] < $pagination['total_pages']): ?>
                    <a href="/catalog?p=<?= $pagination['page'] + 1 ?>" class="font-bold btn_second">></a>
                <?php endif; ?>
    </div>
</main>