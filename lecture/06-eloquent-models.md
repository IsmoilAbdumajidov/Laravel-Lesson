# Dars 6 — Eloquent Model

## Model nima?
Model — bu **bitta jadvalning PHP ko'rinishi**. `Idea` modeli → `ideas` jadvali (Laravel nomini avtomatik ko'plikka aylantiradi).

```bash
php artisan make:model Idea
php artisan make:model Idea -mc   # model + migration + controller birga
```

## Ma'lumot olish
```php
Idea::all();              // hammasi
Idea::find(1);            // id bo'yicha, topilmasa null
Idea::findOrFail(1);      // topilmasa avtomatik 404 sahifa
Idea::where('state', 'pending')->get();
```

`findOrFail` afzal — o'zing `if (!$idea) abort(404);` yozishing shart emas.

## Shartli qidiruv — when()
```php
$ideas = Idea::query()
    ->when(request('state'), function ($query, $state) {
        $query->where('state', $state);
    })
    ->get();
```
`when` — birinchi argument bo'sh bo'lmasagina filtr qo'shadi. Search/filter uchun juda qulay.

## Yaratish / yangilash / o'chirish
```php
Idea::create(['description' => '...', 'state' => 'pending']);
$idea->update(['description' => '...']);
$idea->delete();
```

## Mass assignment — $fillable va $guarded
`create()` bilan bir vaqtda ko'p maydon to'ldirilgani uchun Laravel himoya qo'yadi:

```php
protected $fillable = ['title', 'salary'];  // FAQAT shularga ruxsat (xavfsizroq)
protected $guarded = [];                    // hammasiga ruxsat (tez, lekin ehtiyot bo'l)
```

## DB facade bilan farqi
```php
DB::table('ideas')->get();  // xom SQL — oddiy array qaytaradi
Idea::all();                // Eloquent — obyekt qaytaradi, munosabatlar ishlaydi
```
Eloquent qulayroq — shuni ishlatamiz.

## Eslab qol
> Migration jadvalni **quradi**, Model esa u bilan **ishlaydi**.
