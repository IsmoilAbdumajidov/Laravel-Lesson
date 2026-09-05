# Laravel — Darslar Konspekti

Bu loyihada o'rganilgan mavzular ketma-ketligi.

| # | Dars | Asosiy tushuncha |
|---|---|---|
| 01 | [Routing](01-routing.md) | `Route::get/post/patch/delete`, parametr, group |
| 02 | [View va Blade](02-views-blade.md) | `view()`, `{{ }}`, ma'lumot uzatish |
| 03 | [Blade Components](03-blade-components.md) | `x-layout`, `$slot`, `@props`, `$attributes` |
| 04 | [Blade Direktivalari](04-blade-directives.md) | `@if`, `@foreach`, `@unless`, `@dd` |
| 05 | [Migration](05-migrations-database.md) | `up()` / `down()`, `Schema::create/table` |
| 06 | [Eloquent Model](06-eloquent-models.md) | `all/find/findOrFail/where/when`, `$guarded` |
| 07 | [Route Model Binding](07-route-model-binding.md) | `{idea}` + `Idea $idea` |
| 08 | [Controllers](08-controllers.md) | 7 ta resource metod, RESTful tartib |
| 09 | [Forma, CSRF, Method](09-forms-csrf-method.md) | `@csrf`, `@method('PATCH')` |
| 10 | [Validation](10-validation.md) | `validate()`, `@error`, `$errors` |
| 11 | [Form Request](11-form-request.md) | `rules()`, `messages()`, `authorize()` |
| 12 | [Relationships](12-relationships.md) | `hasMany`, `belongsTo`, `foreignIdFor` |
| 13 | [Authentication](13-authentication.md) | `Auth::attempt`, `Hash::make`, `auth`/`guest` middleware |
| 14 | [Authorization — Gate](14-authorization-gate.md) | `Gate::define`, `@can`, `AppServiceProvider` |

---

## So'rovning umumiy yo'li

```
Brauzer
   ↓
routes/web.php        → qaysi controller?
   ↓
Middleware            → auth / guest / can  (ruxsat bormi?)
   ↓
Controller            → nima qilish kerak?
   ↓
Form Request          → ma'lumot to'g'rimi?
   ↓
Model (Eloquent)      → bazadan o'qish / yozish
   ↓
View (Blade)          → HTML chizish
   ↓
Brauzer
```

## Foydali buyruqlar
```bash
php artisan serve
php artisan migrate
php artisan make:model Idea -mc
php artisan make:controller IdeaController --resource
php artisan make:request IdeaRequest
php artisan route:list
php artisan tinker
```
