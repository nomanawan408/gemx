<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Package Manager</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
   
    <body class="bg-gray-50 font-['Inter']">


                <nav class="bg-white border-b border-gray-200">
                    <div class="max-w-7xl mx-auto px-4">
                        <div class="flex justify-between h-16">
                            <div class="flex items-center">
                                <a href="#" class="text-xl font-bold text-blue-600">PackageManager</a>
                                <div class="hidden md:flex items-center space-x-8 ml-10">
                                    <a href="#" class="text-gray-600 hover:text-gray-900">Features</a>
                                    <a href="#" class="text-gray-600 hover:text-gray-900">Pricing</a>
                                    <a href="#" class="text-gray-600 hover:text-gray-900">Documentation</a>
                                    <a href="#" class="text-gray-600 hover:text-gray-900">Support</a>
                                </div>
                            </div>
                            @if (Route::has('login'))
                            <div class="flex items-center space-x-6">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            @endif
                        </div>
                    </div>
                </nav>
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="text-left">
                        <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">Modern Package Management Made Simple</h1>
                        <p class="text-xl text-gray-600 mb-8">A lightning-fast, secure, and reliable package management solution that streamlines your development workflow.</p>
                        <div class="flex gap-4">
                            <a href="#" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Get Started</a>
                            <a href="#" class="bg-white text-gray-700 px-8 py-3 rounded-lg font-semibold border border-gray-300 hover:border-gray-400 transition-colors">Documentation</a>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -top-4 -right-4 w-72 h-72 bg-blue-200 rounded-full filter blur-3xl opacity-30"></div>
                        <div class="absolute -bottom-4 -left-4 w-72 h-72 bg-indigo-200 rounded-full filter blur-3xl opacity-30"></div>
                        <div class="relative">
                            <img src="https://placehold.co/800x600/2563eb/FFFFFF/png?text=Package+Manager&font=Roboto" alt="Package Manager Interface" class="rounded-xl shadow-2xl">
                            <img src="https://placehold.co/400x300/4f46e5/FFFFFF/png?text=Dependencies&font=Roboto" alt="Dependencies View" class="absolute -bottom-8 -right-8 w-48 rounded-lg shadow-xl border-4 border-white">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-shadow duration-300">
                    <div class="text-blue-600 text-4xl mb-4">📦</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Fast Installation</h3>
                    <p class="text-gray-600 leading-relaxed">Lightning-fast package installation with optimized dependency resolution and parallel downloads.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-shadow duration-300">
                    <div class="text-green-600 text-4xl mb-4">🔒</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Security First</h3>
                    <p class="text-gray-600 leading-relaxed">Built-in security features to protect your projects from vulnerable dependencies and malicious packages.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-xl transition-shadow duration-300">
                    <div class="text-purple-600 text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Caching</h3>
                    <p class="text-gray-600 leading-relaxed">Intelligent caching system that reduces installation time and bandwidth usage for repeated operations.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-24">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                    <div class="text-white">
                        <h2 class="text-4xl font-bold mb-6">Powerful Statistics</h2>
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <div class="text-5xl font-bold mb-2">1M+</div>
                                <div class="text-blue-100">Active Users</div>
                            </div>
                            <div>
                                <div class="text-5xl font-bold mb-2">5M+</div>
                                <div class="text-blue-100">Packages</div>
                            </div>
                            <div>
                                <div class="text-5xl font-bold mb-2">99.9%</div>
                                <div class="text-blue-100">Uptime</div>
                            </div>
                            <div>
                                <div class="text-5xl font-bold mb-2">24/7</div>
                                <div class="text-blue-100">Support</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <img src="https://placehold.co/600x400" alt="Dashboard Preview" class="rounded-lg shadow-2xl">
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-24">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-16">Trusted by Industry Leaders</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 items-center opacity-60">
                <img src="https://placehold.co/200x80" alt="Company Logo" class="w-full">
                <img src="https://placehold.co/200x80" alt="Company Logo" class="w-full">
                <img src="https://placehold.co/200x80" alt="Company Logo" class="w-full">
                <img src="https://placehold.co/200x80" alt="Company Logo" class="w-full">
            </div>
        </div>

        <div class="bg-blue-600 py-16">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold text-white mb-8">Ready to get started?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Join thousands of developers who trust our package manager for their projects</p>
                <a href="#" class="inline-block px-8 py-4 bg-white text-blue-600 font-semibold rounded-md hover:-translate-y-0.5 transition-transform duration-300 hover:shadow-lg">Install Now</a>
            </div>
        </div>

        <footer class="max-w-7xl mx-auto px-4 py-16 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold text-gray-900 mb-4">Package Manager</h3>
                    <p class="text-gray-600">Making package management simple and secure for everyone.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Product</h4>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="#" class="hover:text-blue-600">Features</a></li>
                        <li><a href="#" class="hover:text-blue-600">Documentation</a></li>
                        <li><a href="#" class="hover:text-blue-600">Pricing</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="#" class="hover:text-blue-600">About</a></li>
                        <li><a href="#" class="hover:text-blue-600">Blog</a></li>
                        <li><a href="#" class="hover:text-blue-600">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Connect</h4>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="#" class="hover:text-blue-600">Twitter</a></li>
                        <li><a href="#" class="hover:text-blue-600">GitHub</a></li>
                        <li><a href="#" class="hover:text-blue-600">Discord</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-16 pt-8 border-t border-gray-200 text-center text-gray-600">
                <p>© 2023 Package Manager. All rights reserved.</p>
            </div>
        </footer>
    </body></html>