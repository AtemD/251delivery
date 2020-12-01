<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Currency::class)->create([
            'name' => Currency::ETHIOPIAN_BIRR,
            'abbreviation' => 'ETB',
        ]);

        // factory(Currency::class)->create([
        //     'name' => Currency::SOUTH_SUDANESE_POUND,
        //     'abbreviation' => 'SSP',
        // ]);
    }
}
