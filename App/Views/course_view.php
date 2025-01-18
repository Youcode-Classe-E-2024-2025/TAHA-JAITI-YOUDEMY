<?php
$course = (new CourseController())->getById();
$isEnrolled = Enrollment::isEnrolled(Session::getId(), $course->getId());

?>
<main class="flex items-center justify-center w-full h-full bg-gray-900">
    <div class="container max-w-6xl px-4 py-8 mx-auto lg:py-12">
        <div class="overflow-hidden transition-all transform rounded-sm shadow-2xl bg-gray-800/90 hover:shadow-3xl">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section -->
                <div class="relative w-full md:w-2/5 h-[20rem] md:h-auto">
                    <img
                        src="<?= $course->getImage() ? $course->getImage() : '/Assets/default.webp' ?>"
                        alt="Course Image"
                        class="object-cover w-full h-full transition-transform duration-700 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/60 to-transparent"></div>
                </div>

                <!-- Content -->
                <div class="flex flex-col w-full md:w-3/5">
                    <!-- Info -->
                    <div class="p-6 space-y-6 md:p-8">
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-200 md:text-base">
                            <div class="flex items-center gap-2 bg-gray-800/50 rounded-full px-4 py-1.5">
                                <span class="icon-[mdi--folder-outline] text-amber-400"></span>
                                <span class="font-medium"><?= str_secure($course->getCategory()->getById()->getName()) ?></span>
                            </div>
                            <div class="flex items-center gap-2 bg-gray-800/50 rounded-full px-4 py-1.5">
                                <span class="icon-[mdi--account-outline] text-amber-400"></span>
                                <span class="font-medium"><?= str_secure(ucfirst($course->getTeacher()->getById()['name'])) ?></span>
                            </div>
                        </div>

                        <h1 class="text-3xl font-bold leading-tight text-gray-100 md:text-4xl">
                            <?= str_secure($course->getTitle()) ?>
                        </h1>

                        <!-- Description -->
                        <div class="text-base leading-relaxed text-gray-400 border-b border-gray-600 md:text-md">
                            <?= str_secure($course->getDescription()) ?>
                        </div>

                        <?php if ($isEnrolled): ?>
                            <!-- Content -->
                            <div class="prose prose-lg border-b border-gray-600 prose-invert max-w-none prose-headings:text-amber-400 prose-a:text-amber-400 prose-strong:text-gray-200 prose-code:text-amber-300">
                                <?= $course->getContent(); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 pt-4">
                            <?php foreach ($course->getTags() as $tag): ?>
                                <span class="bg-amber-900/40 text-amber-300 text-sm px-4 py-1.5 rounded-full font-medium
                                        hover:bg-amber-900/60 transition-colors duration-300 cursor-pointer">
                                    #<?= str_secure($tag->getName()) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <?php if (Session::getRole() === 'student' && !$isEnrolled): ?>
                            <!-- Enroll Button -->
                            <div class="w-full pt-6">
                                <a href="?action=enrollment_enroll&id=<?= $course->getId() ?>&csrf=<?= genToken() ?>"
                                    class="btn_second">
                                    Enroll Now
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>