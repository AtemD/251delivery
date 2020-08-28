<?php

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PaymentMethod::class)->create([
            'name' => 'Hello Cash',
            'description' => 'Ethiopian mobile money company',
        ]);

        factory(PaymentMethod::class)->create([
            'name' => 'M-Birr',
            'description' => 'Ethiopian mobile money company',
        ]);

        factory(PaymentMethod::class)->create([
            'name' => 'CBE-Birr',
            'description' => 'Commercial Bank of Ethiopia mobile money',
        ]);
    }
}
