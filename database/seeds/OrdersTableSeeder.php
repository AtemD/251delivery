<?php

use App\User;
use App\Models\Shop;
use App\Models\OrderType;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('orders')->truncate();

        $users = User::all();
        $shops = Shop::all();
        $order_types = OrderType::all();
        $payment_methods = PaymentMethod::all();
        $order_statuses = OrderStatus::all();
        $admin_users = User::inRandomOrder()->limit(5)->get(); // when you add roles and permisssion, get the admin users based on roles

        // For each user generate between 1 and 13 orders
        $users->each(function($user) use($shops, $order_types, $payment_methods, $order_statuses, $admin_users){

            $random_shop = $shops->random();

            $number_of_orders = mt_rand(1, 5);
            
            for($i=0; $i<$number_of_orders; $i++){
                // $random_number = base_convert(mt_rand(12345,98765), 10, 16);

                $curr_timestamp = \Carbon\Carbon::now()->timestamp + $i;
                
                factory('App\Models\Order')->create([
                    'user_id' => $user->id,
                    'shop_id' => $random_shop->id,
                    'number' => $user->id . $curr_timestamp,
                    'order_type_id' => $order_types->random()->id,
                    'payment_method_id' => $payment_methods->random()->id,
                    'order_status_id' => $order_statuses->random()->id,
                    'status_by' => $admin_users->random()->id
                ]);
            }
            
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
