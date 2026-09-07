# Dars 14 — Authorization using Gate (Bugungi dars)

## Muammo
Login qilgan **hamma** user `/admin` sahifasini ko'ra oladi. Lekin faqat admin ko'rishi kerak.
`auth` middleware "kirganmi?" deb tekshiradi, "kim ekanini" emas.

## Gate nima?
Gate — bu **nomlangan ruxsat qoidasi**. "Bu ishni qilishga ruxsat bormi?" degan savolga `true`/`false` qaytaradi.

---

## 1-qadam: rolni tayyorlash

Migration'da (`users` jadvali):
```php
$table->string('role');   // user yoki admin
```

`User.php` modelida qulay metod:
```php
public function isAdmin(): bool
{
    return $this->role === 'admin';
}
```

---

## 2-qadam: AppServiceProvider

**AppServiceProvider nima?**
`app/Providers/AppServiceProvider.php` — Laravel ilova ishga tushganda **eng birinchi** o'qiydigan fayl. Global sozlamalar shu yerda ro'yxatdan o'tkaziladi.

Ikkita metodi bor:

| Metod | Qachon ishlaydi | Nima yoziladi |
|---|---|---|
| `register()` | eng avval, hech narsa tayyor emas | servislarni container'ga bog'lash |
| `boot()` | hamma servis yuklangandan keyin | Gate, View::share, Model::unguard va h.k. |

Gate **`boot()`** ichida yoziladi — chunki unga tayyor Auth tizimi kerak.

```php
use App\Models\User;
use Illuminate\Support\Facades\Gate;

public function boot(): void
{
    Gate::define('view-admin', function (User $user) {
        return $user->isAdmin();
    });
}
```

Tushuntirish:
- `'view-admin'` — ruxsatning **nomi** (o'zing tanlaysan)
- `function (User $user)` — Laravel bu yerga **hozirgi login qilgan userni o'zi** uzatadi
- `return true` → ruxsat bor, `return false` → yo'q

---

## 3-qadam: Ishlatish

### A) Blade'da — `@can`
```blade
@can('view-admin')
    <x-nav-link href="/admin">Admin</x-nav-link>
@endcan
```
Admin bo'lmasa — link umuman chizilmaydi.

### B) Route'da — `Gate::authorize()`
```php
Route::get('/admin', function () {
    Gate::authorize('view-admin');

    return 'Private Admin Page';
});
```
Ruxsat yo'q bo'lsa — pastdagi kod umuman ishlamaydi, `abort` bo'ladi.

### C) `can` middleware (bir xil natija, qisqaroq)
```php
Route::get('/admin', function () {
    return 'Private Admin Page';
})->can('view-admin');
```
`->can('view-admin')` = `->middleware('can:view-admin')` ning qisqasi.

Farqi: `Gate::authorize()` funksiya **ichida**, `->can()` esa route **ustida** turadi.
Middleware afzalroq — kod ishga tushmasdanoq to'xtaydi.

### D) Controllerda
```php
Gate::allows('view-admin');   // true/false qaytaradi
Gate::denies('view-admin');   // teskarisi
$this->authorize('view-admin');  // ruxsat yo'q bo'lsa 403
```

---

## Response — javobni boshqarish

`true`/`false` o'rniga `Response` obyektini qaytarsa bo'ladi. Bu **qanday xato chiqishini** boshqaradi:

```php
use Illuminate\Auth\Access\Response;

Gate::define('view-admin', function (User $user) {
    return $user->isAdmin()
        ? Response::allow()
        : Response::denyAsNotFound();
});
```

| Qaytaruv | Natija |
|---|---|
| `true` / `Response::allow()` | ruxsat bor |
| `false` / `Response::deny()` | **403 Forbidden** |
| `Response::denyAsNotFound()` | **404 Not Found** |
| `Response::deny('O\'z xabaring')` | 403 + o'z matning |

### Nega `denyAsNotFound()` yaxshiroq?
**403** deyish = "bu sahifa bor, lekin senga ruxsat yo'q" — ya'ni maxfiy sahifa borligini oshkor qilasan.
**404** deyish = "bunday sahifa yo'q" — hech qanday ma'lumot bermaysan.

Admin panel kabi yashirin sahifalar uchun `denyAsNotFound()` xavfsizroq.

---

## Gate'ga qo'shimcha argument
Masalan "faqat o'z ideasini tahrirlasin":
```php
Gate::define('edit-idea', function (User $user, Idea $idea) {
    return $user->id === $idea->user_id;
});
```
```blade
@can('edit-idea', $idea)
    <a href="/ideas/{{ $idea->id }}/edit">Edit</a>
@endcan
```

## Eslab qol
> Gate = `AppServiceProvider::boot()` da qoida yoziladi → `@can` / `can:` middleware bilan tekshiriladi.
> Ko'rinishni yashirish ≠ himoya. Route ham yopilishi shart.
