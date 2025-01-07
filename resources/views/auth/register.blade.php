<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#02381b] flex items-center justify-center h-screen">
    <!-- Register Card -->
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-20">
        </div>
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Create Account</h2>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Field -->
            <div class="relative mb-4">
                <label for="name" class="block text-gray-600 font-semibold mb-2">Name</label>
                <input id="name" name="name" type="text" :value="old('name')" placeholder="Enter your name"
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#37a235] transition duration-300" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Email Field -->
            <div class="relative mb-4">
                <label for="email" class="block text-gray-600 font-semibold mb-2">Email</label>
                <input id="email" name="email" type="email" :value="old('email')" placeholder="Enter your email"
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#37a235] transition duration-300" required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Password Field -->
            <div class="relative mb-4">
                <label for="password" class="block text-gray-600 font-semibold mb-2">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password"
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#37a235] transition duration-300" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Confirm Password Field -->
            <div class="relative mb-6">
                <label for="password_confirmation" class="block text-gray-600 font-semibold mb-2">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm your password"
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-[#37a235] transition duration-300" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-[#37a235] hover:bg-[#2e8b2e] text-white font-bold py-3 rounded-lg shadow-md transition duration-300">
                Register
            </button>
        </form>

        <!-- Divider -->
        <div class="mt-6 text-center text-gray-500 text-sm">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-[#37a235] hover:underline font-semibold">Log In</a>
        </div>
    </div>
</body>
</html>