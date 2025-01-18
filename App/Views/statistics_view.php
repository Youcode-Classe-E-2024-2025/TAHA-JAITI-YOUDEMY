<?php
$total_courses = (new AdminStats())->getTotalCourses();
$popular = AdminStats::getPopularCourse();
$popular_teahcher = AdminStats::getPopularTeachers();
$course_cat = AdminStats::getCourseByCategory();
?>

<main class="container flex-grow px-4 py-8 mx-auto">
    <!-- Header Section -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold">Global Statistics</h1>
        <p class="text-gray-400">Overview of course and teacher statistics.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <!-- Total Courses -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-indigo-600 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Total Courses</h2>
                    <p class="text-2xl font-bold text-white"><?= $total_courses ?></p>
                </div>
            </div>
        </div>

        <!-- Course with Most Students -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-green-600 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Most Popular Course</h2>
                    <p class="text-2xl font-bold text-white"><?= $popular['course']->getTitle() ?></p>
                    <p class="font-semibold text-gray-400 text-md"><?= $popular['count'] ?> Students</p>
                </div>
            </div>
        </div>

        <!-- Top Teachers -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-600 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Top Teachers</h2>
                    <ol class="px-4 mt-2 list-decimal">
                        <?php foreach ($popular_teahcher as $user): ?>
                            <li class="text-white"><span>#<?= $user->getId() ?> | </span><?= $user->getName() ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Distribution by Category -->
    <div class="p-6 mb-8 bg-gray-800 rounded-lg shadow-md">
        <h2 class="mb-4 text-xl font-bold text-gray-300">Course Distribution by Category</h2>
        <div class="h-[15rem] space-y-4 overflow-y-auto">
            <?php foreach ($course_cat as $category): ?>
                <div class="flex items-center justify-between p-4 bg-gray-700 rounded-sm">
                    <span class="text-gray-300 px-"><?= $category['name'] ?></span>
                    <span class="px-3 py-1 text-sm font-bold text-blue-600 bg-gray-300 rounded-full">
                        <?= $category['course_count']; ?> courses
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Top 3 Teachers Table -->
    <div class="p-6 bg-gray-800 rounded-lg shadow-md">
        <h2 class="mb-4 text-xl font-bold text-gray-300">Top 3 Teachers</h2>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Rank</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Name</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Courses Taught</th>
                    <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-300 uppercase">Students Enrolled</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap">1</td>
                    <td class="px-4 py-4 whitespace-nowrap">John Doe</td>
                    <td class="px-4 py-4 whitespace-nowrap">15</td>
                    <td class="px-4 py-4 whitespace-nowrap">500</td>
                </tr>
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap">2</td>
                    <td class="px-4 py-4 whitespace-nowrap">Jane Smith</td>
                    <td class="px-4 py-4 whitespace-nowrap">12</td>
                    <td class="px-4 py-4 whitespace-nowrap">450</td>
                </tr>
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap">3</td>
                    <td class="px-4 py-4 whitespace-nowrap">Alice Johnson</td>
                    <td class="px-4 py-4 whitespace-nowrap">10</td>
                    <td class="px-4 py-4 whitespace-nowrap">400</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>