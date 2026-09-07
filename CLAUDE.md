# Loyiha haqida

Bu **o'quv loyihasi**. Foydalanuvchi (Ismoil) Laravel'ni video darslar orqali bosqichma-bosqich o'rganmoqda.
Loyiha — "Ideas" ilovasi: user ro'yxatdan o'tadi, o'z g'oyalarini (idea) yozadi, tahrirlaydi, o'chiradi.

Stack: Laravel 12, Blade, Tailwind + daisyUI (CDN), SQLite/MySQL.

---

# ⭐ Asosiy ish tartibi (har safar shu)

Foydalanuvchi bitta darsni ko'rib bo'lgach, menga **faqat dars mavzusini** yozadi.
Masalan: `Authorization using Gate`, `Eloquent Relationships`, `Middleware`.

Shundan keyin men **o'zim** quyidagini bajaraman — qayta so'ramayman:

1. **Yangi/o'zgargan kodni topaman** — `git diff` ishlamaydi (bu git repo emas), shuning uchun
   mavzuga aloqador fayllarni o'qib, oxirgi holatini ko'raman.
2. **Mavzuni qisqa tushuntiraman** — o'zbek tilida, uning **o'z kodidan** misol keltirib.
3. **Kodda tushuntirish kerak joy bo'lsa** — aytaman: nima uchun shunday yozilgan, alternativasi nima,
   xato yoki xavfsizlik teshigi bormi.
4. **`lecture/` papkasiga yangi `NN-mavzu.md` fayl yozaman** va `lecture/README.md` jadvaliga qator qo'shaman.
   - Fayl nomi: `15-middleware.md` ko'rinishida, raqam ketma-ket.
   - Agar mavzu allaqachon yozilgan bo'lsa — **yangi fayl ochmayman**, eskisini yangilayman.

---

# Yozish uslubi (juda muhim)

- **Til: o'zbekcha.** Texnik atamalar inglizcha qoladi (`middleware`, `route`, `migration`).
- **QISQA.** Ertak yo'q, kirish so'zi yo'q, "keling ko'rib chiqaylik" yo'q. To'g'ridan-to'g'ri mavzuga.
- Har bir tushuncha uchun: **1-2 gap izoh + kod misoli**. Uzun paragraf yozma.
- Kod misollari **shu loyihadan** olinsin — umumiy `Post`/`Comment` misollari emas.
- Jadval, ro'yxat, `⚠️` belgisi — matnni bo'lib yuborish uchun ishlatilsin.
- Har dars oxirida bitta **"Eslab qol"** qatori — mavzuning bir gaplik mag'zi.
- Foydalanuvchi bu fayllarni **keyin o'qib eslash uchun** yozadi — konspekt bo'lsin, kitob emas.

---

# Kodga aralashish qoidasi

- Mavzuni tushuntirish so'ralganda **kodni o'zgartirmayman**. Faqat `lecture/` ga yozaman.
- Kodda xato yoki xavfsizlik muammosi ko'rsam — **aytaman**, lekin so'ramasdan tuzatmayman.
- Foydalanuvchi kodni o'zi yozadi — bu o'rganish jarayoni. "Men tuzatib qo'yaman" demayman.
- Kodni o'zgartirishni **aniq so'raganda** — o'zgartiraman.

---

# Kod haqida bilish kerak bo'lgan narsalar

- `routes/web.php` da **juda ko'p izohga olingan eski kod** bor — bu ataylab: har bosqichni
  eslab qolish uchun saqlab qo'yilgan. **O'chirma, tozalama.**
- `app/Models/Job.php` — bu Eloquent model emas, oddiy class (hardcode array). Dars boshida shunday qilingan.
- Blade komponentlarida ham izohga olingan alternativ yechimlar bor — ular ham ataylab.

---

# O'tilgan darslar

To'liq ro'yxat: `lecture/README.md`

Routing → Blade → Components → Direktivalar → Migration → Eloquent → Route Model Binding →
Controllers → Forma/CSRF → Validation → Form Request → Relationships → Authentication → Gate
