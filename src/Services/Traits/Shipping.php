<?php

namespace TomatoPHP\TomatoOrders\Services\Traits;

use Illuminate\Http\Request;
use TomatoPHP\TomatoOrders\Facades\TomatoOrdering;
use ProtoneMedia\Splade\Facades\Toast;

trait Shipping
{
    public function shipping(Request $request): void
    {
        $request->validate([
            "shipping_vendor_id" => "required|integer|exists:shipping_vendors,id",
            "city_id" => "required|integer|exists:cities,id",
            "area_id" => "required|integer|exists:areas,id",
            "country_id" => "required|integer|exists:countries,id",
            "address" => "required|max:255|string",
            "shipping" => "required|numeric",
        ]);

        $this->order->update($request->all());
        $this->shipped();

        $this->log(__("Your Order Has Been Shipped Successfully By" . ":" . $this->order->shippingVendor->name ));
    }
}
