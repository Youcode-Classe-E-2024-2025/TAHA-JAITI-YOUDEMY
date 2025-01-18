<?php
    if (Session::getRole() !== 'visitor'){
        Session::redirect('/home');
    }
?>

<div class="flex items-center justify-center h-full px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid w-full max-w-xl gap-8">
        <!-- Signup Form -->
        <div class="p-8 bg-black rounded-lg shadow-xl">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-white">Sign Up</h2>
                <p class="mt-2 text-gray-400">Join the Youdemy community</p>
            </div>

            <form action="?action=auth_register" method="post" class="space-y-6">
                <div>
                    <label for="username" class="block mb-2 text-gray-300">Username</label>
                    <input type="text" name="username"
                        class="input-field"
                        placeholder="First name">
                </div>

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
                        placeholder="Enter a password">
                </div>

                <div>
                    <label for="role" class="block mb-2 text-gray-300">Role</label>
                    <select class="input-field" name="role">
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <div>
                    <p class="block mb-2 text-gray-300">Already a user?
                        <a href="/login" class="font-bold text-blue-500">Login</a>
                    </p>
                </div>

                <input type="hidden" name="csrf" value="<?= $token = genToken(); ?>">
                <button type="submit"
                    class="w-full btn_primary">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</div>