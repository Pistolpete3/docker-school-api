<?php

use Illuminate\Database\Seeder;

/**
 * Class SchoolSeeder
 */
class SchoolSeeder extends Seeder
{
    const SCHOOL_SEED_COUNT = 500;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\School::class, self::SCHOOL_SEED_COUNT)->create();
    }
}
