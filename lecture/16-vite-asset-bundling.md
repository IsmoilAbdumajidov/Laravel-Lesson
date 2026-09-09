# Dars 16 — Frontend Asset Bundling with Vite

## Muammo: CDN
Ilgari layout'da shunday edi:
```blade
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
```

CDN o'rganish uchun qulay, lekin **production uchun yaramaydi**:
- ❌ Har user har safar tashqi saytdan yuklaydi — sekin
- ❌ Internet yo'q bo'lsa / CDN o'chsa — sayt buziladi
- ❌ Tailwind brauzerda ishlaydi (klasslarni real vaqtda hisoblaydi) — sekin
- ❌ Ishlatilmagan CSS ham yuklanadi (Tailwind'da bu ~3 MB)

## Yechim: Vite
**Vite** = build tool. `resources/` dagi CSS/JS fayllarni oladi → siqadi, birlashtiradi →
`public/build/` ga tayyor fayl chiqaradi.

---

## 1. Fayllar qayerda?
```
resources/css/app.css   ← manba (siz yozadigan)
resources/js/app.js     ← manba
        ↓  vite build
public/build/assets/    ← natija (brauzer yuklaydigan)
```

⚠️ `public/build/` ni **hech qachon qo'lda tahrirlama** — har build'da qaytadan yoziladi.

---

## 2. `vite.config.js`
```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
```

| Qism | Vazifasi |
|---|---|
| `input` | **kirish nuqtalari** — Vite shu fayllardan boshlab hammasini yig'adi |
| `refresh: true` | Blade fayl o'zgarsa brauzer **avtomatik yangilanadi** |
| `tailwindcss()` | Tailwind v4 plugini (v3 da `postcss.config.js` kerak edi, endi shart emas) |

---

## 3. `@vite` direktivasi
Layout `<head>` ida:
```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

Bu direktiva **rejimga qarab** har xil HTML chiqaradi:

**Dev rejimda** (`npm run dev` ishlab tursa):
```html
<script src="http://localhost:5173/@vite/client"></script>
<link rel="stylesheet" href="http://localhost:5173/resources/css/app.css">
```
→ Vite serveri jonli xizmat qiladi, fayl o'zgarsa **darrov** ko'rinadi (HMR).

**Production'da** (`npm run build` qilingan):
```html
<link rel="stylesheet" href="/build/assets/app-B2xK9d.css">
```
→ siqilgan, tayyor fayl.

**Laravel qanday biladi?** `public/hot` fayli bor-yo'qligiga qaraydi.
`npm run dev` shu faylni yaratadi, to'xtatilsa o'chiradi.
Shuning uchun `.gitignore` da `/public/hot` bor.

---

## 4. Buyruqlar
```bash
npm install       # kutubxonalarni yuklash (bir marta)
npm run dev       # ishlash paytida — ochiq turadi, kuzatadi
npm run build     # deploy oldidan — public/build/ ga yakuniy fayl
```

⚠️ **Ikki terminal kerak**:
```bash
php artisan serve   # 1-terminal — Laravel
npm run dev         # 2-terminal — Vite
```

`npm run dev` ni **to'xtatib qo'ysang sayt styleisiz** ko'rinadi (`public/hot` bor, lekin server yo'q).

---

## 5. `resources/css/app.css`
```css
@import 'tailwindcss';

@source '../**/*.blade.php';
@source '../**/*.js';

@plugin "daisyui";

@theme {
    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
    /* --color-primary: red; */
}
```

| Direktiva | Vazifasi |
|---|---|
| `@import 'tailwindcss'` | Tailwind'ni ulaydi (v3 dagi `@tailwind base/components/utilities` o'rniga) |
| `@source '...'` | **Qaysi fayllarni skanerlash kerak** — Tailwind shu fayllardagi klasslarni topib, faqat o'shalarni CSS'ga qo'shadi |
| `@plugin "daisyui"` | daisyUI komponentlarini qo'shadi (`btn`, `card`, `card-body`) |
| `@theme` | Dizayn o'zgaruvchilari — rang, shrift, o'lcham |

### `@source` nima uchun juda muhim?
Tailwind'da minglab klass bor. Hammasini chiqarsa CSS 3 MB bo'ladi.
Shuning uchun u fayllaringizni **o'qib chiqadi** va faqat ishlatgan klasslaringizni CSS'ga yozadi.
Natija — odatda 10-30 KB.

⚠️ Shuning uchun klassni **string yasab ishlatish mumkin emas**:
```blade
{{-- ❌ Tailwind buni topolmaydi --}}
<div class="text-{{ $color }}-500">

{{-- ✅ To'liq klass yozilsin --}}
<div class="{{ $active ? 'text-red-500' : 'text-gray-500' }}">
```
Shuning uchun `nav-link.blade.php` da to'liq klasslar yozilgan.

### `@theme` — o'z ranglaringiz
```css
@theme {
    --color-primary: red;
}
```
Buni yozsang, `bg-primary`, `text-primary` klasslari o'sha rangga o'tadi.

---

## 6. `resources/js/app.js`
```js
import './bootstrap';
```

`bootstrap.js` ichida:
```js
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
```

- `import` — ES modul sintaksisi. Vite hamma `import` larni kuzatib, bitta faylga birlashtiradi.
- `window.axios = axios` — axios'ni global qiladi, har joyda `import` yozish shart bo'lmaydi.
- `X-Requested-With: XMLHttpRequest` — Laravel'ga "bu AJAX so'rov" deb bildiradi.
  Shunda validatsiya xatosida redirect emas, **JSON** qaytaradi.

---

## 7. `package.json`
```json
"scripts": {
    "dev": "vite",
    "build": "vite build"
},
"devDependencies": {
    "tailwindcss": "^4.0.0",
    "daisyui": "^5.7.32",
    "vite": "^7.0.7",
    "laravel-vite-plugin": "^2.0.0"
}
```

- `devDependencies` — faqat **ishlab chiqish** paytida kerak. Tayyor sayt faqat `public/build/` dagi
  natijani ishlatadi, `node_modules` serverda kerak emas.
- `"type": "module"` — `import` sintaksisiga ruxsat beradi.
- `^4.0.0` — "4.x.x ning eng yangisi, lekin 5 ga o'tma".

---

## Rasm va boshqa fayllar
```blade
<img src="{{ Vite::asset('resources/images/logo.png') }}">
```
CSS ichida esa oddiy yo'l ishlaydi — Vite o'zi topib, hashli nomga almashtiradi:
```css
background-image: url('/resources/images/bg.png');
```

---

## Eslab qol
> `resources/` — siz yozasiz. `public/build/` — Vite yasaydi.
> `npm run dev` = ishlash paytida (jonli), `npm run build` = deploy oldidan (siqilgan).
> `@vite(...)` ikkalasini ham o'zi hal qiladi — layout'ni o'zgartirish shart emas.
