<?php

use App\User;
use App\Models\OrderType;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $order_types = OrderType::all();
        $payment_methods = PaymentMethod::all();

        // For each user generate between 1 and 13 orders
        $users->each(function($user) use($order_types, $payment_methods){
            factory('App\Models\Order', mt_rand(1, 13))->create([
                'user_id' => $user->id,
                'order_type_id' => $order_types->random()->id,
                'payment_method_id' => $payment_methods->random()->id
            ]);
        });
        
    }
}
