<x-layout title="Ideas">
    <x-slot:heading>EditIdeas page</x-slot:heading>
    <h1>Hello from the Edit Ideas Page</h1>
    <form method="POST" action="/ideas/{{ $idea->id }}" class="space-y-6 mt-10">
        {{-- + brauzer undrstand only POST and Get form methods --}}
        @csrf
        @method('PATCH')
        <div>
            <label for="description" class="block text-sm/6 font-medium text-white">Edit Your Idea</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3"
                    class="@error('description') border-red-500 @enderror block w-full rounded-md bg-white/5 mb-2 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">{{ $idea->description }}</textarea>

                <x-forms.error name="description" />
            </div>

        </div>
        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Update
            </button>
        </div>
    </form>

</x-layout>
