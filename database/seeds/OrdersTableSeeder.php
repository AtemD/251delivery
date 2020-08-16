<?php

use App\User;
use App\Models\OrderType;
use App\Models\PaymentMethod;
use App\Models\OrderStatus;
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
        $order_statuses = OrderStatus::all();
        $admin_users = User::inRandomOrder()->limit(5)->get(); // when you add roles and permisssion, get the admin users based on roles

        // For each user generate between 1 and 13 orders
        $users->each(function($user) use($order_types, $payment_methods, $order_statuses, $admin_users){

            factory('App\Models\Order', mt_rand(1, 13))->create([
                'user_id' => $user->id,
                'order_type_id' => $order_types->random()->id,
                'payment_method_id' => $payment_methods->random()->id,
                'order_status_id' => $order_statuses->random()->id,
                'status_by' => $admin_users->random()->id
            ]);
        });
        
    }
}
