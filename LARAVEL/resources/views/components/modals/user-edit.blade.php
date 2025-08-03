<section id="update-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm transition-opacity duration-300">
    <div class="w-full max-w-md p-5 sm:p-6">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Update your Profile</h3>
                <button type="button" class="close text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg w-8 h-8 inline-flex items-center justify-center transition">
                    <i class="fas fa-times text-sm"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
    
            <div class="p-5 sm:p-6">
                <form class="space-y-5" method="POST" action="{{ route('update.account') }}">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Your name</label>
                        <input
                            type="name" name="name" id="name" required
                            value="{{ old('name', $user->name) }}"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-500 p-3 transition duration-150"
                        />
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Your email</label>
                        <input
                            type="email" name="email" id="email"
                            value="{{ old('email', $user->email) }}" required
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-500 p-3 transition duration-150"
                        />
                    </div>
        
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3 mt-6">
                        <button type="button" class="close px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300 shadow-sm hover:shadow transition-all duration-200">
                            Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>