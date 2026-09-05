# Dars 3 — Blade Components (Layout, Slot, Props)

## Muammo
Har bir sahifada `<html>`, `<head>`, `navbar` takrorlanadi. Buni bir joyda yozib, qayta ishlatish kerak.

## Component yaratish
`resources/views/components/layout.blade.php` faylini yaratamiz. Endi uni har joyda `<x-layout>` deb chaqiramiz.

Nomi: `components/nav-link.blade.php` → `<x-nav-link>`
Papkada: `components/forms/error.blade.php` → `<x-forms.error>`

## $slot — ichki kontent
```blade
{{-- layout.blade.php --}}
<body>
    {{ $slot }}
</body>
```
```blade
{{-- home.blade.php --}}
<x-layout>
    <h1>Salom</h1>   {{-- shu $slot ichiga tushadi --}}
</x-layout>
```
> React'dagi `children` yoki `Outlet` bilan bir xil.

## Props uzatish — 2 usul
**1) Atribut orqali** (qisqa qiymatlar uchun):
```blade
<x-layout title="About">
```
**2) Named slot orqali** (uzun HTML uchun):
```blade
<x-layout>
    <x-slot:heading>About page</x-slot:heading>
</x-layout>
```

## Dinamik prop — `:` belgisi
```blade
<x-layout title="About">        {{-- oddiy matn --}}
<x-layout :title="$job['title']">  {{-- PHP qiymat --}}
```
`:` qo'yilsa qiymat PHP sifatida hisoblanadi.

## @props — standart qiymat
```blade
@props(['active' => false])

<a class="{{ $active ? 'bg-gray-950' : 'text-gray-300' }}">
    {{ $slot }}
</a>
```
Agar `active` berilmasa — `false` bo'ladi.

## $attributes — qolgan atributlarni o'tkazish
```blade
<a class="..." {{ $attributes }}>{{ $slot }}</a>
```
`<x-nav-link href="/about" id="x">` deb yozsak, `href` va `id` avtomatik `<a>` ga tushadi.

**merge()** — o'z klassini saqlab, ustiga qo'shadi:
```blade
<a {{ $attributes->merge(['class' => 'card rounded-xl']) }}>
```

## Loyihadagi misol
```blade
<x-nav-link :active="request()->is('about')" href="/about">About</x-nav-link>
```
`request()->is('about')` — hozirgi URL `/about` bo'lsa `true`, ya'ni link "aktiv" ko'rinadi.

## Eslab qol
> `$slot` = children, `@props` = default props, `$attributes` = qolgan hamma atribut.
