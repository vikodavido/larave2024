<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoriesAndProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Отключаем проверки внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очищаем таблицы
        DB::table('category_product')->truncate(); // Очистка связующей таблицы
        DB::table('products')->truncate();
        DB::table('categories')->truncate();

        // Удаляем директорию с поддельными данными (если нужно)
        Storage::deleteDirectory('faker');

        // Включаем проверки внешних ключей обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Генерация данных
        Category::factory(2)->create();
        Category::factory(5)->hasProducts(3)->create();

        Category::factory(2)->withParent()->create();
        Category::factory(2)->withParent()->hasProducts(2)->create();
    }
}
