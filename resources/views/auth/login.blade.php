<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center h-screen">

    <!-- Login Card -->
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class=" h-20 ">
        </div>
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Welcome Back!</h2>
        
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="relative mb-4">
                <label for="email" class="block text-gray-600 font-semibold mb-2">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email"
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500 transition duration-300">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="relative mb-4">
                <label for="password" class="block text-gray-600 font-semibold mb-2">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password"
                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-500 transition duration-300">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-gray-600">
                    <input id="remember_me" type="checkbox" name="remember" 
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm">Remember Me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-300">
                Log In
            </button>
        </form>

        <!-- Divider -->
        <div class="mt-6 text-center text-gray-500 text-sm">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Sign Up</a>
        </div>
    </div>
</body>
</html>
