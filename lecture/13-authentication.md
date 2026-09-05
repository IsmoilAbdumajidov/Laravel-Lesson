# Dars 13 — Authentication (Kim ekanligini aniqlash)

> **Authentication** = "sen kimsan?" (login)
> **Authorization** = "senga ruxsat bormi?" (14-dars)

## 1. Ro'yxatdan o'tish — RegisterUserController
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'email', 'unique:users'],
        'password' => ['required', Password::default()],
    ]);

    $user = User::create([
        'name'     => $validated['name'],
        'email'    => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);      // darrov kirgizamiz
    return redirect('/ideas');
}
```
- `Hash::make()` — parolni shifrlaydi (bazada ochiq saqlanmaydi)
- `Password::default()` — Laravel'ning standart parol qoidasi
- `unique:users` — bu email allaqachon bormi tekshiradi

> User modelida `'password' => 'hashed'` cast bo'lsa, `Hash::make` avtomatik bajariladi.

## 2. Kirish — SessionsController
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($validated)) {
        $request->session()->regenerate();
        return redirect('/ideas');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}
```
- `Auth::attempt()` — email+parolni tekshiradi, to'g'ri bo'lsa login qiladi
- `session()->regenerate()` — **session fixation** hujumidan himoya (eski session ID ni yangilaydi)
- Xato bo'lsa parol noto'g'ri deb aytmaymiz — umumiy xabar beramiz (xavfsizlik)

## 3. Chiqish
```php
public function destroy()
{
    Auth::logout();
    return redirect('/ideas');
}
```
Logout `DELETE` metodi bilan bo'lgani uchun formada:
```blade
<form action="/logout" method="POST">
    @csrf
    @method('DELETE')
    <button>Logout</button>
</form>
```

## 4. Middleware — himoya
```php
Route::middleware('auth')->group(function () {
    // faqat login qilganlar
});

Route::middleware('guest')->group(function () {
    // faqat login qilmaganlar (login/register sahifalari)
});
```
`auth` middleware login qilmaganni `/login` ga yuboradi. Shuning uchun login route'ga `->name('login')` berilgan.

## 5. Auth helperlari
```php
Auth::user()      // hozirgi user obyekti
Auth::id()        // uning id'si
Auth::check()     // login qilganmi? true/false
```

## 6. Blade'da
```blade
@auth
    <form action="/logout">...</form>
@else
    <a href="/login">Login</a>
@endauth
```

## Eslab qol
> Register → `Hash::make` + `Auth::login`. Login → `Auth::attempt` + `session()->regenerate()`.
