<?php

namespace TomatoPHP\TomatoOrders\Services\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use TomatoPHP\TomatoEcommerce\Models\Cart;

trait SyncCart
{
    public Collection $carts;

    public function syncCart(Request $request): void
    {
        $account = auth('accounts')->user();
        foreach ($this->carts as $cart){
            $this->order->ordersItems()->create([
                "account_id" => $account->id,
                "product_id" => $cart->product_id,
                "item" => $cart->item,
                "price" => $cart->price,
                "discount" => $cart->discount,
                "tax" => $cart->vat,
                "total" => $cart->total,
                "qty" => $cart->qty,
                "options" => $cart->options
            ]);
        }

        if(class_exists(Cart::class)){
            Cart::query()->where('account_id', $account->id)->delete();
            Cart::query()->where('session_id', session()->getId())->delete();
        }
    }

    public function setCart(Collection $carts): void
    {
        $this->carts = $carts;
    }
}
