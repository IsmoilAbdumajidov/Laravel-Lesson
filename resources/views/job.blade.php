<x-layout :title="$job['title']">
    <x-slot:heading>
        Job
    </x-slot:heading>
    <a href="/jobs">
        <button class="border px-5 py-1 rounded border-white/10 bg-gray-800">Back</button>
    </a>
    <h2 class="font-bold text-lg mt-5">{{ $job['title'] }}</h2>
    <p>
        This job pays {{ $job['salary'] }} per year.
    </p>
</x-layout>
