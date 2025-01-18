<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-black to-blue-900">
    <div class="container px-6 mx-auto text-center">
        <h1 class="mb-6 text-5xl font-bold text-white">Learn Online with Youdemy</h1>
        <p class="mb-8 text-xl text-gray-300">Discover thousands of online courses taught by experts</p>
        <a href="/catalog" class="btn_primary">
            Browse Now
        </a>
    </div>
</section>

<section class="py-20 bg-gray-900">
    <div class="container px-6 mx-auto">
        <h2 class="mb-16 text-3xl font-bold text-center text-white">Why Choose Youdemy?</h2>
        <div class="grid gap-12 md:grid-cols-3">
            <div class="text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-blue-900 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="mb-4 text-xl font-semibold text-white">Interactive Courses</h3>
                <p class="text-gray-400">Access quality educational content and interact with your teachers</p>
            </div>
            <div class="text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-blue-900 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="mb-4 text-xl font-semibold text-white">Learn at Your Own Pace</h3>
                <p class="text-gray-400">Study whenever and wherever you want, on your own schedule</p>
            </div>
            <div class="text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-blue-900 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"></path>
                    </svg>
                </div>
                <h3 class="mb-4 text-xl font-semibold text-white">Expert Teachers</h3>
                <p class="text-gray-400">Learn from industry professionals and experienced educators</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Grid -->
<section class="py-20 bg-black">
    <div class="container px-6 mx-auto">
        <div class="grid gap-16 md:grid-cols-2">
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-white">For Students</h2>
                <ul class="space-y-4 text-gray-300">
                    <li class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Access to comprehensive course catalog
                    </li>
                    <li class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Track your learning progress
                    </li>
                    <li class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Interactive learning materials
                    </li>
                </ul>
            </div>
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-white">For Teachers</h2>
                <ul class="space-y-4 text-gray-300">
                    <li class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create and manage your courses
                    </li>
                    <li class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Track student progress
                    </li>
                    <li class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Access detailed analytics
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php if (!Session::getRole() === 'visitor'): ?>
    <section class="py-20 bg-blue-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="mb-8 text-4xl font-bold text-white">Ready to Start Learning?</h2>
            <p class="mb-8 text-xl text-gray-300">Join thousands of students already learning on Youdemy</p>
            <a href="/signup" class="text-blue-900 bg-white btn_primary hover:bg-gray-300">
                Create Free Account
            </a>
        </div>
    </section>
<?php endif; ?>