<?php

use App\Models\Payment;
use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('payment_statuses')->truncate();

        // Name, description, color
        factory(PaymentStatus::class)->create([
            'name' => PaymentStatus::PENDING_PAYMENT,
            'description' => 'entity has not paid',
            'color' => 'primary'
        ]);
        factory(PaymentStatus::class)->create([
            'name' => PaymentStatus::PAID_PAYMENT,
            'description' => 'entity has been paid for',
            'color' => 'success'
        ]);
        factory(PaymentStatus::class)->create([
            'name' => PaymentStatus::REFUNDED_PAYMENT,
            'description' => 'entity has been refunded',
            'color' => 'info'
        ]);
        factory(PaymentStatus::class)->create([
            'name' => PaymentStatus::REQUEST_REFUND_PAYMENT,
            'description' => 'entity requesting a refund',
            'color' => 'warning'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
