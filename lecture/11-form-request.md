# Dars 11 — Form Request

## Muammo
`store()` va `update()` da bir xil validatsiya qoidalari takrorlanadi.

## Yechim
```bash
php artisan make:request IdeaRequest
```
`app/Http/Requests/IdeaRequest.php` yaratiladi:

```php
class IdeaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // bu so'rovni yuborishga ruxsat bormi?
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'min:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'The :attribute is required.',
        ];
    }
}
```

## Ishlatish
Controllerda `Request` o'rniga shuni yozamiz:
```php
public function store(IdeaRequest $request) { ... }
public function update(IdeaRequest $request, Idea $idea) { ... }
```
`$request->validate()` yozish shart emas — **avtomatik** ishlaydi.

## 3 ta metod nima qiladi
| Metod | Vazifasi |
|---|---|
| `authorize()` | `false` qaytarsa → 403 Forbidden |
| `rules()` | validatsiya qoidalari |
| `messages()` | o'z xato matnlaring |

`:attribute` — maydon nomiga almashadi (`description`).

## Eslab qol
> Form Request = validatsiya + ruxsat tekshiruvi bitta faylda. Controller toza qoladi.
