<x-layout title="Idea">
    <x-slot:heading>Idea page</x-slot:heading>



    <div class="mt-6 text-white">
        <a href="/ideas">
            <button class="border px-5 py-1 rounded border-white/10 bg-gray-800">Back</button>
        </a>
        {{-- <h2 class="font-bold mt-4">Your Ideas</h2> --}}
        <div class="mt-6 bg-slate-950 rounded-xl p-4">
            <h2 class="text-sm">{{ $idea->description }}</h2>
            <div class="flex gap-4">
                <a href="/ideas/{{ $idea->id }}/edit"
                    class="border px-5 py-1 rounded border-white/10 bg-green-800 mt-4">Edit</a>
                {{-- <button form="delete-idea-form"
                    class="border px-5 py-1 rounded border-white/10 bg-red-800 mt-4">Delete</button> --}}
                <form  method="POST"action="/ideas/{{ $idea->id }}">
                    @csrf
                    @method("DELETE")
                    <button class="border px-5 py-1 rounded border-white/10 bg-red-800 mt-4">Delete</button>
                </form>
            </div>
        </div>
    </div>

    {{-- <form id="delete-idea-form" method="POST"action="ideas/{{ $idea->id }}">
        @csrf
        @method('DELETE')

    </form> --}}



    {{-- <div class="mt-6 text-white">
            <h2 class="font-bold">Your Ideas</h2>
            <ul class="mt-6">
                @foreach ($ideas as $idea)
                    <li class="text-sm">{{ $idea }}</li>
                @endforeach
            </ul>
        </div> --}}

</x-layout>
