# Dars 2 — View va Blade

## View nima?
View — bu foydalanuvchi ko'radigan HTML sahifa. `resources/views/` papkasida `.blade.php` kengaytmasi bilan turadi.

```php
return view('home');        // resources/views/home.blade.php
return view('ideas.index'); // resources/views/ideas/index.blade.php  (nuqta = papka)
```

## View'ga ma'lumot uzatish
```php
return view('jobs', ['jobs' => Job::all()]);
```
View ichida:
```blade
{{ $jobs }}
```

`{{ }}` — bu `<?php echo e(...) ?>` ning qisqasi. `e()` — XSS'dan himoya qiladi (HTML'ni matnga aylantiradi).

## Blade — bu shablon tili
Oddiy PHP ham ishlaydi, lekin Blade qisqaroq:

| PHP | Blade |
|---|---|
| `<?php echo $x; ?>` | `{{ $x }}` |
| `<?php if(...): ?>` | `@if(...)` |
| `<?php foreach(...): ?>` | `@foreach(...)` |

## Izoh
```blade
{{-- Bu Blade izohi, HTML'ga chiqmaydi --}}
<!-- Bu HTML izohi, brauzer kodida ko'rinadi -->
```

## Eslab qol
> Controller **ma'lumot** beradi, View faqat **ko'rsatadi**. View ichida murakkab logika yozma.
