<?php

use Illuminate\Database\Seeder;
use App\School;
use App\Product;

/**
 * Class SchoolProductSeeder
 */
class SchoolProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::all()->each(function (School $school) {
            $school->products()->sync(
                $this->seedRandomProductPrices($school->circulation)
            );
        });
    }

    /**
     * Build a random array of products with random prices
     * @return array
     */
    private function seedRandomProductPrices(int $circulation): array
    {
        $min = 1;
        $max = 100;
        $productPriceSeed = [];

        foreach (Product::all()->random(rand(1,4)) as $product) {
            $price = mt_rand($min*100, $max*100)/100;

            $productPriceSeed[$product->id] = [
                'price' => $price,
                'value' => $price/$circulation,
            ];
        }

        return $productPriceSeed;
    }
}
