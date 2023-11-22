<?php

namespace TomatoPHP\TomatoOrders\Services;

use TomatoPHP\TomatoOrders\Models\Order;
use TomatoPHP\TomatoOrders\Services\Traits\CheckBalance;
use TomatoPHP\TomatoOrders\Services\Traits\DeleteOrder;
use TomatoPHP\TomatoOrders\Services\Traits\FindOrder;
use TomatoPHP\TomatoOrders\Services\Traits\GenerateUUID;
use TomatoPHP\TomatoOrders\Services\Traits\GetShippingPrice;
use TomatoPHP\TomatoOrders\Services\Traits\HandleRequest;
use TomatoPHP\TomatoOrders\Services\Traits\Logger;
use TomatoPHP\TomatoOrders\Services\Traits\Shipping;
use TomatoPHP\TomatoOrders\Services\Traits\StatusUpdate;
use TomatoPHP\TomatoOrders\Services\Traits\StoreOrder;
use TomatoPHP\TomatoOrders\Services\Traits\StoreWebOrder;
use TomatoPHP\TomatoOrders\Services\Traits\SyncCart;
use TomatoPHP\TomatoOrders\Services\Traits\SyncItems;
use TomatoPHP\TomatoOrders\Services\Traits\SyncMeta;
use TomatoPHP\TomatoOrders\Services\Traits\UpdateAccountMeta;
use TomatoPHP\TomatoOrders\Services\Traits\UpdateOrder;
use TomatoPHP\TomatoOrders\Services\Traits\ValidateOrder;

class Ordering
{
    use GenerateUUID;
    use Logger;
    use HandleRequest;
    use ValidateOrder;
    use SyncCart;
    use SyncItems;
    use SyncMeta;
    use StoreOrder;
    use UpdateAccountMeta;
    use GetShippingPrice;
    use CheckBalance;
    use StoreWebOrder;
    use Shipping;
    use UpdateOrder;
    use StatusUpdate;
    use DeleteOrder;
    use FindOrder;

    private Order $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }
}
