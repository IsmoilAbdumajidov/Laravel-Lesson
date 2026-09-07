# Dars 15 — Authorization using Policies

## Gate'ning muammosi
Gate qoidalari `AppServiceProvider::boot()` ichida yig'iladi. Bitta model uchun 5-6 ta qoida bo'lsa
(`create-idea`, `update-idea`, `delete-idea`, `view-idea`...) — bu fayl axlatxonaga aylanadi.

**Policy** = bitta modelga tegishli barcha ruxsat qoidalari **alohida class**da.

| | Gate | Policy |
|---|---|---|
| Qayerda | `AppServiceProvider::boot()` | `app/Policies/XPolicy.php` |
| Nima uchun | modelga bog'liq bo'lmagan qoida (`view-admin`) | aniq bitta modelga oid (`Idea`) |

---

## 1-qadam: Policy yaratish
```bash
php artisan make:policy IdeaPolicy --model=Idea
```
`app/Policies/IdeaPolicy.php` hosil bo'ladi.

⚠️ **Nom muhim**: `Idea` modeli → `IdeaPolicy`. Laravel shu nom orqali **avtomatik topadi**.
Hech qayerda ro'yxatdan o'tkazish (`register`) shart emas.

---

## 2-qadam: Qoidalarni yozish

Sizning kodingiz:
```php
class IdeaPolicy
{
    public function update(User $user, Idea $idea): bool
    {
        return $user->is($idea->user);
        // return $user->id === $idea->user_id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }
}
```

### Metod nomlari = amal nomlari
| Metod | Ma'nosi |
|---|---|
| `viewAny(User $user)` | ro'yxatni ko'rish |
| `view(User $user, Idea $idea)` | bittasini ko'rish |
| `create(User $user)` | yaratish |
| `update(User $user, Idea $idea)` | tahrirlash |
| `delete(User $user, Idea $idea)` | o'chirish |

### Nega `create()` da `$idea` yo'q?
Chunki yaratishdan **oldin** idea hali mavjud emas. Tekshirish uchun obyekt yo'q — faqat user bor.
Qolgan metodlarda esa "qaysi idea?" degan savol bor, shuning uchun ikkinchi argument keladi.

### `$user->is($idea->user)` nima?
`is()` — ikkita Eloquent modelni solishtiradi: **bir xil model + bir xil id** bo'lsa `true`.

```php
$user->is($idea->user)        // idea egasi shu userni o'zimi?
$user->id === $idea->user_id  // bir xil natija
```
Farqi: `is()` toza o'qiladi, lekin `$idea->user` — bazaga **qo'shimcha so'rov** yuboradi.
`$user->id === $idea->user_id` esa so'rovsiz ishlaydi (tezroq).

---

## 3-qadam: Ishlatish

Controllerda:
```php
public function create()
{
    Gate::authorize('create', Idea::class);   // obyekt yo'q → class nomi
    return view('ideas.create');
}

public function edit(Idea $idea)
{
    Gate::authorize('update', $idea);         // obyekt bor → obyektning o'zi
    return view('ideas.edit', ['idea' => $idea]);
}
```

⚠️ **Muhim farq**: Gate'da birinchi argument qoidaning **nomi** edi (`'view-admin'`).
Policy'da esa u **metod nomi** (`'update'`), ikkinchi argument esa qaysi Policy ekanini ko'rsatadi:
- `$idea` (obyekt) → `IdeaPolicy`
- `Idea::class` → `IdeaPolicy`

Laravel ikkinchi argumentdan modelni bilib, o'sha modelning Policy'sini topadi.

### Boshqa usullar
```php
$this->authorize('update', $idea);   // controller ichida (bir xil)
Gate::allows('update', $idea);       // true/false
```

Blade'da:
```blade
@can('update', $idea)
    <a href="/ideas/{{ $idea->id }}/edit">Edit</a>
@endcan

@can('create', App\Models\Idea::class)
    <a href="/ideas/create">Create Idea</a>
@endcan
```

Route'da:
```php
Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->can('update', 'idea');
```

---

## Sizning koddagi holat

`IdeaController` da hamma joyda `Gate::authorize('update', $idea)` turibdi — `show`, `edit`, `update`, `destroy`.
Ya'ni "faqat o'z ideangni ko'rasan/o'zgartirasan/o'chirasan".

Ishlaydi, lekin keyinchalik ajratish yaxshiroq — chunki qoidalar farq qilishi mumkin:
```php
public function view(User $user, Idea $idea): bool    // ko'rish — hammaga ochiq bo'lishi mumkin
public function update(User $user, Idea $idea): bool  // tahrirlash — faqat egasiga
public function delete(User $user, Idea $idea): bool  // o'chirish — egasi yoki admin
```

Hozircha bitta `update` bilan ishlatish — normal boshlanish.

⚠️ **Diqqat**: `AppServiceProvider` dagi `view-admin` Gate'ning ichi butunlay izohga olingan —
hozir u hech narsa qaytarmayapti (`null`). Bu **rad etish** degani, ya'ni Admin linki ko'rinmaydi
va `/admin` sahifasi ochilmaydi. Agar ataylab bo'lsa — muammo yo'q.

---

## Policy vs Gate — qachon qaysi biri?
- Model bilan bog'liq (`Idea`, `Post`, `Comment`) → **Policy**
- Modelga bog'liq emas (`view-admin`, `access-dashboard`) → **Gate**

## Eslab qol
> Policy = bitta modelning ruxsat qoidalari bitta class'da. Nomi to'g'ri bo'lsa (`Idea` → `IdeaPolicy`),
> Laravel o'zi topadi. Chaqirish: `Gate::authorize('metodNomi', $obyekt)`.
