<div id="alerts" class="fixed top-4 right-4 flex flex-col space-y-3 max-w-xs w-full z-[100] animate-in slide-in-from-top duration-300">
    @foreach ($errors as $error)
    <div class="bg-white text-gray-800 px-5 py-4 rounded-xl shadow-lg border border-red-100 flex items-start transition-all duration-200 hover:shadow-xl hover:border-red-200" role="alert">
        <div class="flex-shrink-0 w-6 h-6 mt-0.5 text-red-600">
            <i class="fas fa-triangle-exclamation"></i>
        </div>
  
        <div class="ml-3 flex-grow">
            <p class="text-sm font-semibold text-red-700">Error</p>
            <p class="text-sm text-gray-600 mt-1">{{ $error }}</p>
        </div>
  
        <button type="button" aria-label="Close" 
            class="ml-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-1 transition-all duration-150"
            onclick="this.parentElement.parentElement.remove()">
            <i class="fas fa-xmark w-4 h-4"></i>
        </button>
    </div>
    @endforeach
</div>