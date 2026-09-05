<x-layout title="Create Ideas">
    <x-slot:heading>Create Ideas page</x-slot:heading>
    {{-- <h1>Hello from the Create Ideas Page</h1> --}}
    {{-- <form method="POST" action="/ideas" class="space-y-6 mt-10">
        @csrf
        <div>
            <label for="description" class="block text-sm/6 font-medium text-white">New Idea</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3"
                    class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"></textarea>
            </div>
            <p class="mt-3 text-sm/6 text-gray-400">Have an idea you want to save for later?</p>
        </div>
        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Save
            </button>
        </div>
    </form> --}}
    @if ($ideas->count())
        <div class="mt-6 text-white">
            <div class="flex justify-between items-center">
                <h2 class="font-bold">Your Ideas</h2>
                <a href="/ideas/create" class="btn btn-primary">Create Idea</a>
            </div>
            <ul class="mt-6 grid grid-cols-2 gap-3">
                @foreach ($ideas as $idea)
                    <x-idea-card href="/ideas/{{ $idea->id }}">
                        {{ $idea->description }}
                    </x-idea-card>
                @endforeach
            </ul>
        </div>
    @else
        <div class="mt-6 text-white">

        </div>

        <div
            class="flex flex-col justify-center items-center border border-white/10 py-10 rounded-xl p-4 mt-6 text-white">

            <div class="flex justify-center items-center w-16 h-16 rounded-full bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-inbox-icon lucide-inbox">
                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12" />
                    <path
                        d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z" />
                </svg>
            </div>
            <h2 class="text-xl">No Ideas Found</h2>
            <p class="mt-3  text-gray-400">You have not created any ideas yet. <a href="/ideas/create"
                    class="text-blue-500 hover:underline">Get started by creating new first idea</a></p>

        </div>


        {{-- <div class="mt-6 text-white">
            <h2 class="font-bold">Your Ideas</h2>
            <ul class="mt-6">
                @foreach ($ideas as $idea)
                    <li class="text-sm">{{ $idea }}</li>
                @endforeach
            </ul>
        </div> --}}
    @endif
</x-layout>
