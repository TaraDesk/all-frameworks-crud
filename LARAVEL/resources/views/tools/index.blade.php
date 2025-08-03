<x-layout>
    <x-slot:title>
        Home | Laravel App - TaraDesk
    </x-slot:title>

    <main class="h-screen w-screen flex items-center justify-center bg-gray-50">
        <div class="bg-white w-[90vw] h-[90vh] shadow-lg rounded-2xl flex flex-col overflow-hidden border border-gray-100">
          
            <x-navbar />
      
            <div class="p-6 overflow-y-auto flex-1">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-xl font-semibold text-gray-900">Tool Dashboard</h1>
                    <button data-toggle="create-tool-modal" class="flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-green-300">
                        <i class="fa fa-plus text-sm"></i>
                        Add Tool
                    </button>
                </div>
        
                <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                    @if ($tools->isEmpty())
                    <div class="text-center py-20">
                        <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                            <i class="fa-solid fa-toolbox text-4xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">No tools yet</h3>
                        <p class="text-gray-500 text-sm mb-5">Get started by adding your first tool.</p>
                        <button data-toggle="create-tool-modal" class="flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-green-300 mx-auto">
                            <i class="fa fa-plus text-xs"></i>
                            Add Your First Tool
                        </button>
                    </div>
                    @else
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wide font-medium">
                            <tr>
                                <th class="px-5 py-3 text-left rounded-tl-lg">Created</th>
                                <th class="px-5 py-3 text-left">Tool Name</th>
                                <th class="px-5 py-3 text-left">Description</th>
                                <th class="px-5 py-3 text-left rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($tools as $tool)
                            <tr class="hover:bg-gray-50 transition duration-100">
                                <td class="px-5 py-4 text-gray-500 text-sm">
                                    {{ $tool->created_at->format('M d, Y') }}
                                </td>
                        
                                <td class="px-5 py-4 font-medium text-gray-900">
                                    {{ $tool->name }}
                                </td>
                                <td class="px-5 py-4 text-gray-600">
                                    {{ $tool->description }}
                                </td>
    
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ $tool->link }}" target="_blank"
                                            class="flex items-center gap-1.5 text-xs font-medium text-white bg-gray-600 hover:bg-gray-700 px-3 py-1.5 rounded-lg transition"
                                            title="Open in new tab">
                                            <i class="fa fa-external-link-alt text-xs"></i>
                                            Go to
                                        </a>
    
                                        <a href="{{ route('show.tool', ['slug' => $tool->slug]) }}"
                                            class="flex items-center gap-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 px-3 py-1.5 rounded-lg transition"
                                            title="View details">
                                            <i class="fa fa-eye text-xs"></i>
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    
        <!-- Create Tool Modal -->
        <x-modals.tool-create />
    </main>
</x-layout>