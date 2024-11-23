<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">View Note</h1>
            <div class="flex gap-4">
                <a href="{{ route('note.edit', $note) }}" 
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md 
                          transition duration-150 ease-in-out">
                    Edit
                </a>
                <a href="{{ route('note.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md 
                          transition duration-150 ease-in-out">
                    Back
                </a>
                <form action="{{ route('note.destroy', $note) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md 
                                   transition duration-150 ease-in-out">
                        Delete
                    </button>
                    </button>
                </form>
            </div>
        </div>

        <!-- Note Content -->
        <div class="bg-[#1e2632] rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="text-gray-300 whitespace-pre-wrap">
                    {{ $note->note }}
                </div>
                
                <div class="mt-4 flex justify-between items-center text-gray-400">
                    <span>Created {{ $note->created_at->diffForHumans() }}</span>
                    <span>Updated {{ $note->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

