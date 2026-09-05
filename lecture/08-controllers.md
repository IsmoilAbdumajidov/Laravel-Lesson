# Dars 8 — Controllers

## Nima uchun?
`web.php` uzayib ketadi. Logikani alohida class'ga ko'chiramiz — o'qish oson, tartib bor.

```bash
php artisan make:controller IdeaController --resource
```

## 7 ta standart metod (RESTful)
| Metod | Route | Vazifasi |
|---|---|---|
| `index` | GET /ideas | ro'yxat |
| `create` | GET /ideas/create | yaratish **formasi** |
| `store` | POST /ideas | bazaga **saqlash** |
| `show` | GET /ideas/{idea} | bittasini ko'rsatish |
| `edit` | GET /ideas/{idea}/edit | tahrirlash **formasi** |
| `update` | PATCH /ideas/{idea} | bazani **yangilash** |
| `destroy` | DELETE /ideas/{idea} | o'chirish |

> Muhim farq: `create`/`edit` — sahifa ko'rsatadi. `store`/`update` — ma'lumot yozadi.

## Route bilan bog'lash
```php
Route::get('/ideas',              [IdeaController::class, 'index']);
Route::get('/ideas/create',       [IdeaController::class, 'create']);
Route::post('/ideas',             [IdeaController::class, 'store']);
Route::get('/ideas/{idea}',       [IdeaController::class, 'show']);
Route::get('/ideas/{idea}/edit',  [IdeaController::class, 'edit']);
Route::patch('/ideas/{idea}',     [IdeaController::class, 'update']);
Route::delete('/ideas/{idea}',    [IdeaController::class, 'destroy']);
```

⚠️ **Tartib muhim**: `/ideas/create` `/ideas/{idea}` dan **yuqorida** turishi kerak. Aks holda Laravel "create" so'zini id deb o'ylaydi.

## redirect
Ma'lumot yozgandan keyin har doim redirect qilamiz (sahifa yangilanganda qayta yuborilmasligi uchun):
```php
return redirect('/ideas');
return redirect("/ideas/{$idea->id}");
```

## Eslab qol
> Controller — "boshqaruvchi". So'rovni oladi → Model bilan ishlaydi → View yoki redirect qaytaradi.
