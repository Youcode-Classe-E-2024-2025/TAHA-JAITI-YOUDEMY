<main class="flex-grow container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">Global Statistics</h1>
        <p class="text-gray-400">Overview of course and teacher statistics.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Courses -->
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-indigo-600 p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Total Courses</h2>
                    <p class="text-2xl font-bold text-white">125</p>
                </div>
            </div>
        </div>

        <!-- Course with Most Students -->
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-green-600 p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Most Popular Course</h2>
                    <p class="text-2xl font-bold text-white">Web Development</p>
                    <p class="text-sm text-gray-400">250 students</p>
                </div>
            </div>
        </div>

        <!-- Top Teachers -->
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-yellow-600 p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Top Teachers</h2>
                    <ul class="mt-2">
                        <li class="text-white">1. John Doe</li>
                        <li class="text-white">2. Jane Smith</li>
                        <li class="text-white">3. Alice Johnson</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Distribution by Category -->
    <div class="bg-gray-800 rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-300 mb-4">Course Distribution by Category</h2>
        <div class="w-full h-64">
            <!-- Placeholder for Chart -->
            <canvas id="courseDistributionChart"></canvas>
        </div>
    </div>

    <!-- Top 3 Teachers Table -->
    <div class="bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-300 mb-4">Top 3 Teachers</h2>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Rank</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Courses Taught</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Students Enrolled</th>
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