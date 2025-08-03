<x-layout>
    <x-slot:title>
        Laravel App | TaraDesk
    </x-slot:title>

    <main class="h-screen w-screen flex flex-col bg-gray-50 text-gray-800">
        <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-10">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">
                        TaraDesk
                    </span>
                </div>
        
                <div class="hidden md:flex md:gap-4">
                    <button data-toggle="login-modal" class="px-5 py-2 text-sm font-medium text-green-700 bg-white border border-green-600 rounded-lg hover:bg-green-50 focus:ring-2 focus:ring-green-200 transition-all duration-200 ease-in-out">
                        Sign In
                    </button>
                    <button data-toggle="register-modal" class="px-5 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-300 transition-all duration-200 ease-in-out">
                        Sign Up
                    </button>
                </div>
            </div>
        </nav>
      
        <section class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="max-w-3xl text-center space-y-6">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight tracking-tight">
                    Manage Your Data with <span class="text-green-600">Ease</span>
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    A clean, efficient CRUD app to create, view, edit, and delete records — 
                    <span class="font-medium">perfect for learning or building real-world apps.</span>
                </p>
        
                <div class="flex flex-col sm:flex-row sm:justify-center gap-4 mt-6">
                    <button data-toggle="login-modal"
                        class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-300 transition-all duration-200 shadow-sm hover:shadow-md">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Log In
                    </button>
                    <button data-toggle="register-modal"
                        class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-green-700 focus:ring-2 focus:ring-gray-200 transition-all duration-200">
                        <i class="fas fa-user-plus me-2"></i>
                        Register
                    </button>
                </div>
            </div>
        </section>    
        
        <!-- Login Modal -->
        <x-modals.login />

        <!-- Register Modal -->
        <x-modals.register />
    </main>
</x-layout>