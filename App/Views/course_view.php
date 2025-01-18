<?php
$course = (new CourseController())->getById();

$isEnrolled = Enrollment::isEnrolled(Session::getId(), $course->getId());
?>
<main class="h-full w-full flex justify-center items-center bg-gray-900">
    <div class="container mx-auto px-4 py-8 lg:py-12 max-w-6xl">
        <div class="bg-gray-800/90 rounded-sm shadow-2xl overflow-hidden transform transition-all hover:shadow-3xl">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section -->
                <div class="relative w-full md:w-2/5 h-[20rem] md:h-auto">
                    <img
                        src="<?= $course->getImage() ? $course->getImage() : '/Assets/default.webp' ?>"
                        alt="Course Image"
                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/60 to-transparent"></div>
                </div>

                <!-- Content -->
                <div class="w-full md:w-3/5 flex flex-col">
                    <!-- Info -->
                    <div class="p-6 md:p-8 space-y-6">
                        <div class="flex flex-wrap items-center gap-4 text-gray-200 text-sm md:text-base">
                            <div class="flex items-center gap-2 bg-gray-800/50 rounded-full px-4 py-1.5">
                                <span class="icon-[mdi--folder-outline] text-amber-400"></span>
                                <span class="font-medium"><?= str_secure($course->getCategory()->getById()->getName()) ?></span>
                            </div>
                            <div class="flex items-center gap-2 bg-gray-800/50 rounded-full px-4 py-1.5">
                                <span class="icon-[mdi--account-outline] text-amber-400"></span>
                                <span class="font-medium"><?= str_secure(ucfirst($course->getTeacher()->getById()['name'])) ?></span>
                            </div>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-100 leading-tight">
                            <?= str_secure($course->getTitle()) ?>
                        </h1>

                        <!-- Description -->
                        <div class="text-base md:text-md text-gray-400 leading-relaxed border-b border-gray-600">
                            <?= str_secure($course->getDescription()) ?>
                        </div>

                        <?php if ($isEnrolled): ?>
                            <!-- Content -->
                            <div class="prose prose-invert prose-lg max-w-none prose-headings:text-amber-400 
                            prose-a:text-amber-400 prose-strong:text-gray-200 prose-code:text-amber-300 border-b border-gray-600">
                                <?= str_secure($course->getContent()) ?>
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
                            <div class="pt-6 w-full">
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