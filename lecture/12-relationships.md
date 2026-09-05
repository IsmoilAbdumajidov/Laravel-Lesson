# Dars 12 — Eloquent Relationships (Munosabatlar)

## Vaziyat
Bitta **User** ko'p **Idea** yozadi. Har bir **Idea** bitta **User** ga tegishli.

## 1. Bazada bog'lash (migration)
```php
Schema::create('ideas', function (Blueprint $table) {
    $table->id();
    $table->text('description');
    $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
    $table->timestamps();
});
```
- `foreignIdFor(User::class)` → `user_id` ustunini yaratadi
- `constrained()` → `users.id` ga bog'laydi (mavjud bo'lmagan id yozib bo'lmaydi)
- `cascadeOnDelete()` → user o'chsa, uning ideas'lari ham o'chadi

## 2. Modelda bog'lash
```php
// User.php  — bitta user ko'p idea
public function ideas(): HasMany
{
    return $this->hasMany(Idea::class);
}

// Idea.php  — bitta idea bitta userga
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
```
> `user_id` ustuni qaysi jadvalda bo'lsa — o'sha model `belongsTo` yozadi.

## 3. Ishlatish
```php
Auth::user()->ideas;          // shu userning barcha ideas'lari (kolleksiya)
Auth::user()->ideas();        // query — davom ettirsa bo'ladi
$idea->user->name;            // idea egasining ismi
```

`()` bilan va `()` siz farqi:
```php
$user->ideas          // natija (Collection)
$user->ideas()->where('state', 'pending')->get()   // query, filtrlash mumkin
```

## Yaratishda foydasi
```php
// Uzun yo'l
Idea::create([
    'description' => request('description'),
    'user_id' => Auth::id(),
]);

// Munosabat orqali — user_id avtomatik qo'yiladi
Auth::user()->ideas()->create([
    'description' => request('description'),
    'state' => 'pending',
]);
```

## Eslab qol
> `hasMany` = "menda ko'p bor". `belongsTo` = "men kimgadir tegishliman".
