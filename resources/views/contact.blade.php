<x-layout title="Contact">

    @foreach ($tasks as $task)
        <li>{{ $task }}
    @endforeach

    @unless (count($tasks))
        <p>Thre are no active tasks</p>
    @endunless

    {{-- @if (!count($tasks))
        <p>Thre are no active tasks</p>
    @endif --}}


    {{-- @if (count($tasks))
    <p> Yes, I have some tasks, How many? {{ count($tasks) }} tasks in facet </p>
    @endif --}}

    {{-- <?php if (count($tasks)) : ?> --}}
    {{-- <p> Yes, I have some tasks, How many? {{ count($tasks) }} tasks in facet </p> --}}
    {{-- <?php endif; ?> --}}

    {{-- @dd($tasks) --}}
    {{-- @dump($tasks) --}}
    {{-- {{ $tasks }} --}}
    {{-- {{ $greeting }} --}}
    <x-slot:heading>Contact page</x-slot:heading>
    <h1>Hello from the Contact Page</h1>
</x-layout>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <nav>
    <a href="/">Home</a>
    <a href="/about">About</a>
    <a href="/contact">Contact</a>
  </nav>
  <h1>Hello form the Contact Page</h1>
</body>
</html> --}}


{{-- + we can use this "<?php if (count($tasks)) : ?>"  insteadt of  "@if (count($tasks))"  --}}
