<x-layout>
    <x-slot:title>
        {{ $tool->name }} | Laravel App - TaraDesk
    </x-slot:title>

    <main class="h-screen w-screen flex items-center justify-center bg-gray-50">
        <div class="bg-white w-[90vw] h-[90vh] shadow-lg rounded-2xl flex flex-col overflow-hidden border border-gray-100">
        
            <x-navbar />

            <div class="p-6 space-y-6 overflow-auto">
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium text-sm transition">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>
                
                <div class="flex items-start lg:items-center gap-4">
                    <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                        <img src="/storage/{{ $tool->image }}" alt="{{ $tool->name }} icon" 
                            class="w-full h-full object-cover rounded-lg"/>
                    </div>

                    <div class="flex-1 min-w-0">
                        <h1 class="text-xl font-semibold text-gray-900 truncate">{{ $tool->name }}</h1>
                        <p class="text-gray-600 text-sm mt-1 leading-relaxed max-w-xl">
                            {{ $tool->description }}
                        </p>
                    </div>
                
                    <div class="flex-shrink-0 flex flex-col gap-2 ml-4">
                        <button data-toggle="update-tool-modal" class="w-10 h-10 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:text-green-700 flex items-center justify-center transition" title="Edit tool">
                            <i class="fas fa-edit text-sm"></i>
                        </button>
                        <button data-toggle="delete-tool-modal" class="w-10 h-10 rounded-lg bg-white border border-gray-300 text-red-600 hover:bg-red-50 hover:text-red-700 flex items-center justify-center transition" title="Delete tool">
                            <i class="fas fa-trash-alt text-sm"></i>
                        </button>
                    </div>
                </div>
            
                <div class="pt-2">
                    <a href="{{ $tool->link }}" target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                        <i class="fas fa-external-link-alt text-sm"></i>
                        Go to Tool
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <x-modals.tool-edit :tool="$tool" />

        <!-- Delete Modal -->
        <x-modals.tool-delete :tool="$tool" />
    </main>
</x-layout>