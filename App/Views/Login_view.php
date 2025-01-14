<div class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="grid gap-8 w-full max-w-xl">
        <!-- Login Form -->
        <div class="bg-gray-950 p-8 rounded-sm shadow-xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white">Login</h2>
                <p class="text-gray-400 mt-2">Welcome back to Youdemy</p>
            </div>

            <form action="?action=auth_login" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="text-gray-300 block mb-2">Email</label>
                    <input type="email" name="email"
                        class="input-field"
                        placeholder="Enter your email">
                </div>

                <div>
                    <label for="password" class="text-gray-300 block mb-2">Password</label>
                    <input type="password" name="password"
                        class="input-field"
                        placeholder="Enter your password">
                </div>

                <input type="hidden" name="csrf" value="<?= $token = genToken(); ?>">
                <button type="submit"
                    class="btn_primary w-full">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>