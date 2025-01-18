<?php
$data = (new EnrollmentController())->getAll();
$courses = $data['courses'];
$pagination = $data['pagination'];
?>

<main class="container mx-auto px-4 py-8">
    <!-- Search -->
    <div class="mb-8">
        <input type="text" placeholder="Search courses..." class="w-full p-2 bg-gray-700 text-white rounded">
    </div>

    <!-- Course Container -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <?php if (empty($courses)): ?>
            <div class="bg-gray-800/50 rounded-xl p-12 text-center">
                <span class="icon-[mdi--book-outline] text-6xl text-gray-400 mb-4 inline-block"></span>
                <p class="text-gray-400 text-lg">You have not been enrolled in any courses.</p>
            </div>
        <?php else: ?>
            <?php foreach ($courses as $course): ?>
                <div class="bg-gray-800/90 rounded-sm shadow-xl overflow-hidden h-full flex flex-col transform transition-all duration-200 hover:scale-[1.02] hover:shadow-2xl">
                    <!-- Image -->
                    <div class="relative">
                        <img class="w-full h-52 object-cover" src="<?= $course->getImage() ?>" alt="Course Image">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h2 class="text-xl font-bold text-gray-100 mb-3 line-clamp-2"><?= str_secure($course->getTitle()) ?></h2>
                        <p class="text-gray-400 mb-4 flex-grow line-clamp-3"><?= str_secure($course->getDescription()) ?></p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($course->getTags() as $tag): ?>
                                <span class="bg-amber-900/50 text-amber-300 text-xs px-3 py-1 rounded-full font-medium">
                                    #<?= str_secure($tag->getName()) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Category -->
                        <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
                            <span class="icon-[mdi--folder-outline]"></span>
                            <?= $course->getCategory()->getById()->getName() ?>
                        </div>

                        <!-- Footer -->
                        <div class="pt-4 border-t border-gray-700 space-y-2">
                            <div class="flex gap-4">
                                <a href="/course?id=<?= $course->getId() ?>"
                                    class="btn_second w-full">
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
    <div class="mt-8 flex justify-center space-x-4">
        <?php if ($pagination['page'] > 1): ?>
            <a href="/catalog?p=<?= $pagination['page'] - 1 ?>" class="btn_second font-bold">
                <</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <a href="/catalog?p=<?= $i ?>" class="btn_second <?= $i === $pagination['page'] ? 'bg-blue-700' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($pagination['page'] < $pagination['total_pages']): ?>
                    <a href="/catalog?p=<?= $pagination['page'] + 1 ?>" class="btn_second font-bold">></a>
                <?php endif; ?>
    </div>
</main>