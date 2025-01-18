<main class="container flex-grow px-4 py-8 mx-auto">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold">Course Statistics</h1>
        <p class="text-gray-400">Overview of course enrollments and statistics.</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <!-- Total Students -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="flex items-center justify-center p-3 px-4 bg-indigo-600 rounded-full">
                    <span class="icon-[mdi--user-group-outline] text-white text-3xl"></span>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Total Students Enrolled</h2>
                    <p class="text-2xl font-bold text-white">1,250</p>
                </div>
            </div>
        </div>

        <!-- Total Courses -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="flex items-center justify-center p-3 px-4 bg-green-600 rounded-full">
                    <span class="icon-[mdi--book-plus-multiple-outline] text-white text-3xl"></span>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Total Courses</h2>
                    <p class="text-2xl font-bold text-white">85</p>
                </div>
            </div>
        </div>

        <!-- Average Students -->
        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="flex items-center justify-center p-3 bg-yellow-600 rounded-full">
                    <span class="icon-[mdi--blur] text-white text-3xl font-bold"></span>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-300">Avg. Students per Course</h2>
                    <p class="text-2xl font-bold text-white">15</p>
                </div>
            </div>
        </div>
    </div>
</main>