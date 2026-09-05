# Dars 5 — Migration va Database

## Migration nima?
Migration — bu **jadval yaratish/o'zgartirishning kod ko'rinishi**. Ya'ni "database'ning git'i". Boshqa kompyuterda bitta buyruq bilan bir xil jadvallarni tiklaydi.

## Yaratish
```bash
php artisan make:migration create_ideas_table
php artisan make:migration add_state_to_ideas_table
```
Fayl nomi sana bilan boshlanadi — Laravel qaysi biri avval ishlashini shu tartibda biladi.

## Ichi: up() va down()
```php
public function up(): void   // o'zgarishni qo'llash
{
    Schema::create('ideas', function (Blueprint $table) {
        $table->id();                  // auto-increment PK
        $table->text('description');
        $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
        $table->timestamps();          // created_at + updated_at
    });
}

public function down(): void  // orqaga qaytarish
{
    Schema::dropIfExists('ideas');
}
```

## Mavjud jadvalga ustun qo'shish
`Schema::create` emas, `Schema::table` ishlatiladi:
```php
Schema::table('ideas', function (Blueprint $table) {
    $table->string('state');
});

public function down(): void
{
    Schema::table('ideas', function (Blueprint $table) {
        $table->dropColumn('state');
    });
}
```

## Buyruqlar
```bash
php artisan migrate            # yangi migratsiyalarni ishga tushirish
php artisan migrate:rollback   # oxirgi partiyani orqaga qaytarish
php artisan migrate:fresh      # hammasini o'chirib qaytadan qurish (ma'lumot yo'qoladi!)
```

## Eslab qol
> Migration ishlab bo'lgandan keyin uni **tahrirlama** — yangi migration yozib qo'sh. Chunki eskisi allaqachon bazada bajarilgan.
