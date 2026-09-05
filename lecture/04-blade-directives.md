# Dars 4 — Blade Direktivalari

## Shart (if)
```blade
@if (count($tasks))
    <p>{{ count($tasks) }} ta task bor</p>
@else
    <p>Task yo'q</p>
@endif
```

## @unless — teskari if
```blade
@unless (count($tasks))
    <p>Aktiv task yo'q</p>
@endunless
```
Bu `@if (!count($tasks))` bilan bir xil. "Agar bo'lmasa" degani.

## Sikl (loop)
```blade
@foreach ($jobs as $job)
    <li>{{ $job['title'] }}</li>
@endforeach
```

## Debug direktivalari
```blade
@dd($tasks)     {{-- ko'rsatadi va kodni to'xtatadi (dump & die) --}}
@dump($tasks)   {{-- ko'rsatadi, lekin davom etadi --}}
```
Controller/route ichida esa oddiy `dd($x)` ishlatiladi.

## Auth direktivalari (14-darsda batafsil)
```blade
@auth  ... @endauth      {{-- login qilgan bo'lsa --}}
@guest ... @endguest     {{-- login qilmagan bo'lsa --}}
@can('view-admin') ... @endcan  {{-- ruxsati bo'lsa --}}
```

## Xato direktivasi
```blade
@error('description')
    <p class="text-red-500">{{ $message }}</p>
@enderror
```

## Eslab qol
> Har bir `@if` uchun `@endif`, `@foreach` uchun `@endforeach` yopilishi shart.
