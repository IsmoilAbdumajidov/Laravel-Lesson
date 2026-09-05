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

### B) Route'da — `can` middleware
```php
Route::get('/admin', function () {
    return "Private Admin Page";
})->middleware('can:view-admin');
```
Ruxsat yo'q bo'lsa → **403 Forbidden**.

### C) Controllerda
```php
Gate::allows('view-admin');   // true/false
Gate::denies('view-admin');   // teskarisi

$this->authorize('view-admin');  // ruxsat yo'q bo'lsa avtomatik 403
```

---

## ⚠️ Muhim
Faqat linkni yashirish **yetarli emas**. User to'g'ridan-to'g'ri `/admin` manzilini yozib kirishi mumkin.
Shuning uchun **route'ni ham** `can:view-admin` middleware bilan yopish shart.

Hozirgi loyihada `/admin` route himoyalanmagan — himoyalash kerak:
```php
Route::get('/admin', function () {
    return "Private Admin Page";
})->middleware(['auth', 'can:view-admin']);
```

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
