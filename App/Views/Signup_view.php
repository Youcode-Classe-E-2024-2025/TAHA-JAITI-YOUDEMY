<div class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="grid gap-8 w-full max-w-xl">
        <!-- Signup Form -->
        <div class="bg-black p-8 rounded-lg shadow-xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white">Sign Up</h2>
                <p class="text-gray-400 mt-2">Join the Youdemy community</p>
            </div>

            <form action="?action=auth_register" method="post" class="space-y-6">
                <div>
                    <label for="username" class="text-gray-300 block mb-2">Username</label>
                    <input type="text" name="username"
                        class="input-field"
                        placeholder="First name">
                </div>

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
                        placeholder="Enter a password">
                </div>

                <div>
                    <label for="role" class="text-gray-300 block mb-2">Role</label>
                    <select class="input-field" name="role">
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <div>
                    <p class="text-gray-300 block mb-2">Already a user? 
                        <a href="/login" class="text-blue-500 font-bold" >Login</a>
                    </p>
                </div>
                
                <input type="hidden" name="csrf" value="<?= $token = genToken(); ?>">
                <button type="submit"
                    class="btn_primary w-full">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</div>