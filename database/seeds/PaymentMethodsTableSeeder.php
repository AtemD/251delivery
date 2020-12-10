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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('payment_methods')->truncate();

        factory(PaymentMethod::class)->create([
            'name' => PaymentMethod::HELLO_CASH,
            'description' => 'Ethiopian mobile money company',
        ]);

        factory(PaymentMethod::class)->create([
            'name' => PaymentMethod::E_WALLET,
            'description' => 'this companies wallet payment system for its customers',
        ]);

        // factory(PaymentMethod::class)->create([
        //     'name' => PaymentMethod::M_BIRR,
        //     'description' => 'Ethiopian mobile money company',
        // ]);

        // factory(PaymentMethod::class)->create([
        //     'name' => PaymentMethod::CBE_BIRR,
        //     'description' => 'Commercial Bank of Ethiopia mobile money',
        // ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
