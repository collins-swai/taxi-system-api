<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Ship the given order and trigger an event.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function shipOrder(Order $order)
    {
        // Perform the shipment logic, e.g., update the order status
        $order->status = 'shipped';
        $order->save();

        // Trigger the OrderShipped event, passing the order instance
        event(new OrderShipped($order));

        return response()->json(['message' => 'Order shipped successfully!']);
    }
}
