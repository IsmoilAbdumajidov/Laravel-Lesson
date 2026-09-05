# Dars 1 — Routing (Marshrutlash)

## Nima bu?
Route — bu **URL manzil → nima qilish** degan bog'lanish. Barcha web route'lar `routes/web.php` faylida yoziladi.

## Asosiy sintaksis
```php
Route::get('/about', function () {
    return view('about');
});
```
- `Route::get` — brauzerda sahifa ochilganda ishlaydi
- `/about` — URL manzil
- `function()` — nima qaytarish kerak

## HTTP metodlar
| Metod | Nima uchun |
|---|---|
| `Route::get` | Ma'lumot olish / sahifa ko'rsatish |
| `Route::post` | Yangi ma'lumot yaratish |
| `Route::patch` | Mavjudini yangilash |
| `Route::delete` | O'chirish |

## Parametrli route
```php
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('job', ['job' => $job]);
});
```
`{id}` — dinamik qism. `/jobs/2` ochilsa `$id = 2` bo'ladi.

## Qisqartma: Route::view
Agar faqat view qaytarish kerak bo'lsa:
```php
Route::view('/contact', 'contact', ['tasks' => ['Task 1', 'Task 2']]);
```

## Controller bilan bog'lash
Logika ko'payganda funksiyani controllerga ko'chiramiz:
```php
Route::get('/ideas', [IdeaController::class, 'index']);
```

## Guruhlash (group)
Bir xil qoidali route'larni birlashtiramiz:
```php
Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index']);
    Route::get('/jobs', ...);
});
```
Bu yerdagi hamma route faqat **login qilgan** foydalanuvchi uchun ishlaydi.

## Eslab qol
> Route — bu "eshik". U so'rovni oladi va kerakli joyga (controller yoki view'ga) uzatadi.
