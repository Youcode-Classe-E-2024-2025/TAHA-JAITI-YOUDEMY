<div class="flex items-center justify-center h-full px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid w-full max-w-xl gap-8">
        <!-- Login Form -->
        <div class="p-8 rounded-sm shadow-xl bg-gray-950">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-white">Login</h2>
                <p class="mt-2 text-gray-400">Welcome back to Youdemy</p>
            </div>

            <form action="?action=auth_login" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block mb-2 text-gray-300">Email</label>
                    <input type="email" name="email"
                        class="input-field"
                        placeholder="Enter your email">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-gray-300">Password</label>
                    <input type="password" name="password"
                        class="input-field"
                        placeholder="Enter your password">
                </div>

                <input type="hidden" name="csrf" value="<?= $token = genToken(); ?>">
                <button type="submit"
                    class="w-full btn_primary">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>