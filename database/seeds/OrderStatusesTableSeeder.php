<?php

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Name, description, color
        factory(OrderStatus::class)->create([
            'name' => Order::PENDING_ORDER,
            'description' => 'a new order',
            'color' => 'info'
        ]);
        factory(OrderStatus::class)->create([
            'name' => Order::APPROVED_ORDER,
            'description' => 'an accepted order',
            'color' => 'primary'
        ]);
        factory(OrderStatus::class)->create([
            'name' => Order::READY_ORDER,
            'description' => 'a ready to be delivered order',
            'color' => 'success'
        ]);
        factory(OrderStatus::class)->create([
            'name' => Order::DELIVERING_ORDER,
            'description' => 'an order on the way to the customer',
            'color' => 'info'
        ]);
        factory(OrderStatus::class)->create([
            'name' => Order::COMPLETED_ORDER,
            'description' => 'an order that the customer has received and is satisfied with it',
            'color' => 'success'
        ]);
        factory(OrderStatus::class)->create([
            'name' => Order::REJECTED_ORDER,
            'description' => 'an order rejected by the shop due to some reason',
            'color' => 'warning'
        ]);
        factory(OrderStatus::class)->create([
            'name' => Order::CANCELLED_ORDER,
            'description' => 'an order cancelled by the customer before it is approved',
            'color' => 'danger'
        ]);
    }
}
