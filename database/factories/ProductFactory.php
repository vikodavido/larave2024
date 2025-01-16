<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $title = fake()->unique()->words(rand(1,3), true);
       $slug = Str::slug($title);

       return [
        'title' => $title,
        'slug' => $slug,
        'SKU' => fake()->unique()->ean13(),
        'description'=> fake()->boolean() ? fake()->sentences(rand(1, 5), true) : null,
        'price' => fake()->randomFloat(2, 10, 200),
        'discount' => fake()->boolean() ? rand(10, 85) : null,
        'quantity' => rand(0, 50),
        'thumbnail' => 'tast'
       ];

    }
    protected function generateImage(string $slug): string
    {
        $dirName = "faker/products/$slug";
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        ds($dirName)->label('dir name');


        if(! Storage::exists($dirName)) {
            Storage::createDirectory($dirName);
        }

        ds(Storage::path($dirName))->label('dir full path');
        /**
         * @var \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider $faker
         */
        
        
        return $dirName . '/' . $faker->image(
            dir: Storage::path($dirName),
            isFullPath: false,
        );
    }
}
