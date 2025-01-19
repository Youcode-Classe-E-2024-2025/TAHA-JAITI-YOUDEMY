<?php
if (!Session::isAdminLogged()){
    Session::redirect('/home');
}

$total_courses = (new AdminStats())->getTotalCourses();
$popular = AdminStats::getPopularCourse();
$popular_teacher = AdminStats::getPopularTeachers();
$course_cat = AdminStats::getCourseByCategory();
?>

<main class="flex items-center justify-center h-full text-gray-100 bg-gray-900">
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-12 text-center">
            <h1 class="mb-2 text-4xl font-bold text-white">Global Statistics</h1>
            <p class="text-lg text-gray-400">Overview of course and teacher statistics</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-6 mb-12 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Total Courses -->
            <div class="p-6 transition-all duration-300 bg-gray-800/50 backdrop-blur rounded-xl hover:bg-gray-800/70">
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-lg bg-indigo-600/90">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="mb-1 font-medium text-gray-300">Total Courses</h2>
                        <p class="text-3xl font-bold text-white"><?= $total_courses ?></p>
                    </div>
                </div>
            </div>

            <!-- Most Popular Course -->
            <div class="p-6 transition-all duration-300 bg-gray-800/50 backdrop-blur rounded-xl hover:bg-gray-800/70">
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-lg bg-green-600/90">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="mb-1 font-medium text-gray-300">Most Popular Course</h2>
                        <p class="text-xl font-bold text-white truncate"><?= $popular['course']->getTitle() ?></p>
                        <p class="text-sm text-gray-400"><?= $popular['count'] ?> Students</p>
                    </div>
                </div>
            </div>

            <!-- Top Teachers Summary -->
            <div class="p-6 transition-all duration-300 bg-gray-800/50 backdrop-blur rounded-xl hover:bg-gray-800/70">
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-lg bg-yellow-600/90">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="mb-2 font-medium text-gray-300">Top Teachers</h2>
                        <div class="space-y-1">
                            <?php foreach ($popular_teacher['users'] as $user): ?>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-white"><?= $user->getName() ?></span>
                                    <span class="text-gray-400">#<?= $user->getId() ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Distribution -->
        <div class="grid grid-cols-1 gap-6 mb-12 lg:grid-cols-2">
            <!-- Category Distribution -->
            <div class="p-6 bg-gray-800/50 backdrop-blur rounded-xl">
                <h2 class="mb-6 text-xl font-bold text-white">Course Distribution</h2>
                <div class="space-y-4 max-h-[400px] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900 pr-2">
                    <?php foreach ($course_cat as $category): ?>
                        <div class="flex items-center justify-between p-4 transition-colors rounded-lg bg-gray-700/50 hover:bg-gray-700">
                            <span class="text-gray-200"><?= $category['name'] ?></span>
                            <span class="px-3 py-1 text-sm font-medium text-blue-200 rounded-full bg-blue-900/50">
                                <?= $category['course_count'] ?> courses
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Top Teachers Table -->
            <div class="p-6 bg-gray-800/50 backdrop-blur rounded-xl">
                <h2 class="mb-6 text-xl font-bold text-white">Top Teachers Details</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="pb-4 text-sm font-medium text-left text-gray-400">ID</th>
                                <th class="pb-4 text-sm font-medium text-left text-gray-400">Name</th>
                                <th class="pb-4 text-sm font-medium text-left text-gray-400">Courses</th>
                                <th class="pb-4 text-sm font-medium text-left text-gray-400">Students</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php foreach ($popular_teacher['users'] as $key => $user): ?>
                                <tr class="transition-colors hover:bg-gray-700/30">
                                    <td class="py-4 text-gray-300"><?= $user->getId() ?></td>
                                    <td class="py-4 text-white"><?= $user->getName() ?></td>
                                    <td class="py-4 text-gray-300"><?= $popular_teacher['stats'][$key]['courses'] ?></td>
                                    <td class="py-4 text-gray-300"><?= $popular_teacher['stats'][$key]['students'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>