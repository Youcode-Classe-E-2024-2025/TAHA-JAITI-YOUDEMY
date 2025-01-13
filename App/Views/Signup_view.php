<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="grid gap-8 w-full max-w-xl">
        <!-- Signup Form -->
        <div class="bg-black p-8 rounded-lg shadow-xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white">Sign Up</h2>
                <p class="text-gray-400 mt-2">Join the Youdemy community</p>
            </div>

            <form class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-300 block mb-2">First Name</label>
                        <input type="text"
                            class="input-field"
                            placeholder="First name">
                    </div>
                    <div>
                        <label class="text-gray-300 block mb-2">Last Name</label>
                        <input type="text"
                            class="input-field"
                            placeholder="Last name">
                    </div>
                </div>

                <div>
                    <label class="text-gray-300 block mb-2">Email</label>
                    <input type="email"
                        class="input-field"
                        placeholder="Enter your email">
                </div>

                <div>
                    <label class="text-gray-300 block mb-2">Password</label>
                    <input type="password"
                        class="input-field"
                        placeholder="Create a password">
                </div>

                <div>
                    <label class="text-gray-300 block mb-2">Role</label>
                    <select class="input-field">
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <button type="submit"
                    class="btn_primary w-full">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</div>