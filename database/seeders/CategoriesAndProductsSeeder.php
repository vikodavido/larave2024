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
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('category_product')->truncate(); 
        DB::table('products')->truncate();
        DB::table('categories')->truncate();

        Storage::deleteDirectory('faker');

        Category::factory(2)->create();
        Category::factory(5)->hasProducts(3)->create();

        Category::factory(2)->withParent()->create();
        Category::factory(2)->withParent()->hasProducts(2)->create();
        
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
