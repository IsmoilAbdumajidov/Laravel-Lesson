<x-layout title="About">
    <x-slot:heading>About page</x-slot:heading>
    <h1>Hello from the About Page</h1>
</x-layout>




{{-- 1 usul prop berishni --}}
{{-- <x-layout heading="About page">
  <h1>Hello form the About Page</h1>
</x-layout> --}}
{{-- 2-usul --}}
{{-- <x-layout>
    <x-slot:heading>About page</x-slot:heading>
    <h1>Hello from the About Page</h1>
</x-layout> --}}
{{-- <x-layout>
  <h1>Hello form the About Page</h1>
</x-layout> --}}

{{-- prop oldiga : qo'yilsa bu dinamik prob bo'ladi --}}

{{-- layoutga childrendan tashqari ham prop berib yuborsa bo\ladi masalan qandaydir title kerak bizga va uni styli doim bir xil uni layutda yozamiz va titlni shu yerdan prop qilib berib yuborsak bo'ladi --}}
{{-- va buni ikki xil usuli mavjud  --}}



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
  <h1>Hello form the About Page</h1>
</body>
</html> --}}
