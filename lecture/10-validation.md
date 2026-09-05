# Dars 10 — Validation (Tekshirish)

## Controllerda tekshirish
```php
public function store(Request $request)
{
    $request->validate([
        'description' => ['required', 'min:5'],
    ]);

    Idea::create([...]);
    return redirect('/ideas');
}
```
Agar tekshiruv o'tmasa — Laravel **avtomatik** oldingi sahifaga qaytaradi va xatolarni yuboradi. Pastdagi kod umuman ishlamaydi.

## Ko'p ishlatiladigan qoidalar
```php
'required'          // bo'sh bo'lmasin
'min:5' / 'max:255' // uzunlik
'email'             // email formati
'unique:users'      // users jadvalida takrorlanmasin
'confirmed'         // password_confirmation maydoni bilan mos kelsin
'string'
```
Ikki yozuv usuli bir xil: `'required|min:5'` yoki `['required', 'min:5']`.

## Xatoni ko'rsatish
```blade
@error('description')
    <p class="text-red-500">{{ $message }}</p>
@enderror
```

Yoki `$errors` obyekti orqali:
```blade
@if ($errors->has('description'))
    {{ $errors->first('description') }}
@endif
```

## Xato bo'lganda inputni bo'yash
```blade
<textarea class="@error('description') border-red-500 @enderror ...">
```

## Xatoni komponentga chiqarish
`components/forms/error.blade.php`:
```blade
@props(['name' => 'required'])

@error($name)
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
```
Ishlatish:
```blade
<x-forms.error name="description" />
```

## Eslab qol
> `$errors` o'zgaruvchisi **hamma view'da** avtomatik mavjud — uzatish shart emas.
