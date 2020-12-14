<?php 

namespace App\Search;

use Carbon\Carbon;
use App\Models\Order;

class OrderSearch 
{
    public static function apply($filters){

        $order = (new Order)->newQuery();

        // order of results, desc or asc
        // <option name="sortOrder" value="asc">Ascending</option>
        // if($filters->has('sortByComments')){
            // sortByOrderNo, sortByOrderDate, sortByOrderType, sortByOrderStatus, sortByPaymentMethod, etc... 
        //     $sortOrder = $filters->input('sortByComments'); // asc, or desc

        //     $post_query->orderBy('comments_count', $sortOrder);
        // }
        
        // search for and order based on its number
        if($filters->has('global_order_search')  && !empty($filters->input('global_order_search'))){
            $global_order_search = $filters->input('global_order_search');
            $order = $order->where('number', $global_order_search);
        }

        // Order Status
        if($filters->has('order_status')  && !empty($filters->input('order_status'))){
            $order = $order->whereHas('orderStatus', function($query) use($filters) {
                $query->where('order_statuses.id', $filters->input('order_status'));
            });
        }

        // Order Type
        if($filters->has('order_type')  && !empty($filters->input('order_type'))){
            $order_type_id = $filters->input('order_type');

            $order = $order->whereHas('orderType', function($query) use($order_type_id) {
                $query->where('order_types.id', (int)$order_type_id);
            });
        }

        // Payment Method
        if($filters->has('payment_method')  && !empty($filters->input('payment_method'))){
            $payment_method_id = $filters->input('payment_method');

            $order = $order->whereHas('paymentMethod', function($query) use($payment_method_id) {
                $query->where('payment_methods.id', (int)$payment_method_id);
            });
        }

        // Date from - Date to
        if(!empty($filters->input('from_date')) && !empty($filters->input('to_date'))){
            $from_date = $filters->input('from_date'); // start date
            $to_date = $filters->input('to_date'); // end date

            $from_date = Carbon::parse($from_date);
            $to_date = Carbon::parse($to_date);

            $order = $order->whereBetween('created_at', [$from_date, $to_date]);
        }
        
        return $order;
    }
}