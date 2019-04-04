<?php

use Illuminate\Database\Seeder;
use App\Product;

/**
 * Class ProductSeeder
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getProductNames() as $name) {
            Product::create(['name' => $name]);
        }
    }

    /**
     * Return default product names
     *
     * @return array
     */
    private function getProductNames(): array
    {
        return [
            'Full Page Ad',
            'Half Page Ad',
            'Quarter Page Ad',
            'Eighth Page Ad',
        ];
    }
}
