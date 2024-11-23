<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Note</h1>
            <a href="{{ route('note.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md 
                      transition duration-150 ease-in-out flex items-center gap-2">
                Back
            </a>
        </div>

        <!-- Edit Note Form -->
        <div class="bg-[#1e2632] rounded-lg overflow-hidden">
            <form action="{{ route('note.update', $note) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <textarea 
                    name="note" 
                    rows="10" 
                    class="w-full bg-[#1e2632] text-gray-300 border border-gray-700 rounded-lg p-4 focus:outline-none focus:border-indigo-500"
                    required
                >{{ old('note', $note->note) }}</textarea>

                <div class="mt-4 flex justify-end">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md 
                                   transition duration-150 ease-in-out">
                        Update Note
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

