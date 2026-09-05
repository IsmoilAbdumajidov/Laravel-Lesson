# Dars 7 — Route Model Binding

## Muammo
Har safar shu kodni yozish zerikarli:
```php
Route::get('/ideas/{id}', function ($id) {
    $idea = Idea::findOrFail($id);
    return view('ideas.show', ['idea' => $idea]);
});
```

## Yechim
```php
Route::get('/ideas/{idea}', function (Idea $idea) {
    return view('ideas.show', ['idea' => $idea]);
});
```
Laravel o'zi bazadan topib beradi. Topmasa — avtomatik **404**.

## Ikkita shart
1. Route parametri nomi **model o'zgaruvchisi nomi bilan bir xil** bo'lishi kerak:
   `{idea}` ↔ `Idea $idea` ✅
   `{id}` ↔ `Idea $idea` ❌ ishlamaydi
2. Model tipi ko'rsatilgan bo'lishi kerak (`Idea $idea`).

## Controllerda ham xuddi shunday
```php
public function show(Idea $idea)
{
    return view('ideas.show', ['idea' => $idea]);
}
```

## Eslab qol
> `{idea}` + `Idea $idea` = Laravel avtomatik `findOrFail` qiladi.
