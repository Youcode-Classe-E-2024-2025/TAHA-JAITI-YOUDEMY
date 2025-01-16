<main class="container mx-auto px-4 py-8">
    <!-- Search and Filters -->
    <div class="mb-8">
        <input type="text" placeholder="Search courses..." class="w-full p-2 bg-gray-700 text-white rounded">
    </div>

    <!-- Course Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Course Card -->
        <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <img src="/Assets/course1.webp" alt="Course Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-bold mb-2">Course Title</h2>
                <p class="text-sm text-gray-400 mb-4">This is a short description of the course.</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gray-700 text-gray-300 text-sm px-2 py-1 rounded">Tag 1</span>
                    <span class="bg-gray-700 text-gray-300 text-sm px-2 py-1 rounded">Tag 2</span>
                </div>
                <a href="/course-details/1" class="btn_second w-full block text-center">View Details</a>
            </div>
        </div>

        <!-- Repeat for other courses -->
    </div>
</main>