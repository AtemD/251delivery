<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class UpdateExpiredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired_orders:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updates status of new orders that havent been received to expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Here we change the new orders to expired
        foreach(Order::where('order_status_id', 1)->cursor() as $order){
            // First compare the current time with the time the order was created
            // if the order was created more than 5min ago,
            // then the order status should be changed to expired

            // update the order status
            $order->update([
                'order_status_id' => 8,
            ]);

            // notify the user by email/sms/telegram that their order wasn't received on time
            // also provide them a link to reorder(redirect to their dashboard order history)
            // with an option to order a fresh, and a sorry note

            // ProcessExpiredOrders is a job 
            // this job that takes care of updating the order status to expired and sends notification to user
            // ProcessExpiredOrders::dispatch($order);
        }

        $this->info('Expired Order update has been done successfully');
    }
}
