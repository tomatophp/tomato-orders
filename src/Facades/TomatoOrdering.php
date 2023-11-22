<?php

namespace TomatoPHP\TomatoOrders\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static setOrder(\TomatoPHP\TomatoOrders\Models\Order $order)
 * @method static \TomatoPHP\TomatoOrders\Models\Order store(\Illuminate\Http\Request $request)
 * @method static \TomatoPHP\TomatoOrders\Models\Order|string storeWebOrder(\Illuminate\Http\Request $request)
 * @method static \TomatoPHP\TomatoOrders\Models\Order update(\Illuminate\Http\Request $request)
 * @method static float getShippingPrice(\Illuminate\Http\Request $request)
 * @method static \TomatoPHP\TomatoOrders\Models\Order get()
 * @method static \TomatoPHP\TomatoOrders\Models\Order find(int $id)
 * @method static \TomatoPHP\TomatoOrders\Models\Order findByUUID(string $uuid)
 * @method static Collection findByUser(int $id)
 * @method static mixed meta(string $key,mixed $value=null)
 * @method static Collection findOrderItems(\TomatoPHP\TomatoOrders\Models\Order $order = null)
 * @method static delete()
 * @method static status(string $status)
 * @method static approve()
 * @method static pending()
 * @method static prepared()
 * @method static withdrew()
 * @method static shipped()
 * @method static delivered()
 * @method static refunded()
 * @method static cancel()
 * @method static done()
 * @method static paid()
 */
class TomatoOrdering extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'tomato-ordering';
    }
}
