<section id="update-tool-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/10 backdrop-blur-sm transition-opacity duration-300">
    <div class="w-full max-w-2xl p-5 sm:p-6">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Update Tool Information</h3>
                <button type="button" class="close text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg w-8 h-8 inline-flex items-center justify-center transition" onclick="closeCreateToolModal()">
                    <i class="fas fa-times text-sm"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
    
            <form action="{{ route('update.tool', ['slug' => $tool->slug]) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Tool Name</label>
                        <input type="text" id="name" name="name" value="{{ $tool->name }}"
                            placeholder="e.g. Analytics Dashboard" required
                            class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-500 transition"
                        />
                    </div>
          
                    <div>
                        <label for="link" class="block mb-2 text-sm font-medium text-gray-700">Tool Link</label>
                        <input type="url" id="link" name="link" value="{{ $tool->link }}"
                            placeholder="https://example.com" required
                            class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-500 transition"
                        />
                    </div>
                </div>
    
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="2"
                        placeholder="Briefly describe this tool and its purpose..." required
                        class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-500 transition resize-none"
                    >{{ $tool->description }}</textarea>
                </div>
        
                <div>
                    <div class="my-3" id="image-preview-container">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Preview:</label>
                        <img src="/storage/{{ $tool->image }}" id="image-preview" class="max-h-20 rounded-lg border border-gray-200 object-cover" alt="{{ $tool->name }} Image preview" />
                    </div>
                    
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Tool Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full p-2 text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-medium
                            file:bg-green-50 file:text-green-700
                            hover:file:bg-green-100
                            focus:outline-none focus:ring-2 focus:ring-green-200"
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
</section>