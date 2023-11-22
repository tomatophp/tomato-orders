<?php

namespace TomatoPHP\TomatoOrders\Services\Traits;

use TomatoPHP\TomatoOrders\Models\Order;

trait InteractsWithOrders
{
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
