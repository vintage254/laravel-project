<x-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-5xl font-bold mb-4">Welcome to Notes</h1>
                <p class="text-gray-400 text-xl">A simple and elegant way to keep your thoughts organized</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 justify-center">
                @auth
                    <a href="{{ route('note.index') }}" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md 
                              transition duration-150 ease-in-out flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                        </svg>
                        My Notes
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-md 
                                       transition duration-150 ease-in-out">
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md 
                              transition duration-150 ease-in-out">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="bg-[#1e2632] hover:bg-gray-700 text-white px-6 py-3 rounded-md 
                                  transition duration-150 ease-in-out">
                            Register
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-16">
                <!-- View Notes Card -->
                <div class="bg-[#1e2632] p-6 rounded-lg">
                    <div class="text-indigo-500 mb-4">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <a href="{{ route('note.index') }}" class="block hover:text-indigo-400 transition duration-150">
                        <h3 class="text-xl font-semibold mb-2">View Notes</h3>
                        <p class="text-gray-400">Browse all your notes</p>
                    </a>
                </div>

                <!-- Create Notes Card -->
                <div class="bg-[#1e2632] p-6 rounded-lg">
                    <div class="text-indigo-500 mb-4">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <a href="{{ route('note.create') }}" class="block hover:text-indigo-400 transition duration-150">
                        <h3 class="text-xl font-semibold mb-2">Create Notes</h3>
                        <p class="text-gray-400">Quickly capture your thoughts</p>
                    </a>
                </div>

                <!-- Organize Card -->
                <div class="bg-[#1e2632] p-6 rounded-lg">
                    <div class="text-indigo-500 mb-4">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Organize</h3>
                    <p class="text-gray-400">Keep your notes organized</p>
                </div>

                <!-- Secure Card -->
                <div class="bg-[#1e2632] p-6 rounded-lg">
                    <div class="text-indigo-500 mb-4">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Secure</h3>
                    <p class="text-gray-400">Your notes are private</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
