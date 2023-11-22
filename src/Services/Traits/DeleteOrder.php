<?php

namespace TomatoPHP\TomatoOrders\Services\Traits;

use Illuminate\Http\Request;
use TomatoPHP\TomatoOrders\Models\Order;

trait DeleteOrder
{
    public function delete(): void
    {
        $this->order->ordersItems()->delete();
        $this->order->delete();
    }
}
