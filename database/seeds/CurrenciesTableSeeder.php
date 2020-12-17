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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('currencies')->truncate();

        factory(Currency::class)->create([
            'name' => Currency::ETHIOPIAN_BIRR,
            'abbreviation' => 'ETB',
        ]);

        // factory(Currency::class)->create([
        //     'name' => Currency::SOUTH_SUDANESE_POUND,
        //     'abbreviation' => 'SSP',
        // ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
