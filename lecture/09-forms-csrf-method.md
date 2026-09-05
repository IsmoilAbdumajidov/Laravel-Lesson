# Dars 9 — Forma, CSRF va Method Spoofing

## Oddiy forma
```blade
<form method="POST" action="/ideas">
    @csrf
    <textarea name="description"></textarea>
    <button type="submit">Save</button>
</form>
```
`name="description"` — controllerda `request('description')` bilan shu nom orqali olinadi.

## @csrf — nima uchun kerak?
CSRF = boshqa sayt sizning nomingizdan forma yuborishga urinishi.
`@csrf` yashirin token qo'yadi. Laravel har POST so'rovda uni tekshiradi.
Yozilmasa → **419 Page Expired** xatosi.

## Method Spoofing — @method
Brauzer HTML formada faqat **GET** va **POST** ni tushunadi. PATCH/DELETE yo'q.
Yechim:
```blade
<form method="POST" action="/ideas/{{ $idea->id }}">
    @csrf
    @method('PATCH')
    ...
</form>
```
`@method('PATCH')` yashirin `_method=PATCH` maydonini qo'yadi. Laravel buni ko'rib route'ni PATCH deb hisoblaydi.

## Delete tugmasi
```blade
<form method="POST" action="/ideas/{{ $idea->id }}">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>
```

## Ma'lumotni olish
```php
request('description')        // eng qisqa
$request->description
$request->input('description')
$request->all()               // hammasi
```

## Eslab qol
> POST forma = `@csrf` majburiy. PATCH/DELETE = `@csrf` + `@method(...)`.
