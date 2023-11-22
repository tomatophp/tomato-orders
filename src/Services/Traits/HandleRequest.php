<?php

namespace TomatoPHP\TomatoOrders\Services\Traits;

use Illuminate\Http\Request;

trait HandleRequest
{
    private function handleRequest(Request &$request): void
    {
        $request->merge([
            "user_id" => auth()->id(),
            "branch_id" => (int)setting('ordering_direct_branch'),
            "type" => "order",
            "source" => "direct",
            "account_id" => (int)$request->get('account_id')['id'],
            "name" => $request->get('account_id')['name'],
            "phone" => $request->get('account_id')['phone'],
            "discount" => collect($request->get('items'))->map(fn($item) => $item['discount'])->sum(),
            "vat" => collect($request->get('items'))->map(fn($item) => $item['tax'])->sum(),
            "total" => collect($request->get('items'))->map(fn($item) => $item['total'])->sum(),
        ]);
    }
}
