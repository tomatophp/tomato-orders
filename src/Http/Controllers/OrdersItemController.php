<?php

namespace TomatoPHP\TomatoOrders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class OrdersItemController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoOrders\Models\OrdersItem::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-orders::orders-items.index',
            table: \TomatoPHP\TomatoOrders\Tables\OrdersItemTable::class
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \TomatoPHP\TomatoOrders\Models\OrdersItem::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-orders::orders-items.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoOrders\Models\OrdersItem::class,
            validation: [
                            'order_id' => 'required|exists:orders,id',
            'account_id' => 'nullable|exists:accounts,id',
            'product_id' => 'nullable|exists:products,id',
            'refund_id' => 'nullable',
            'warehouse_move_id' => 'nullable',
            'item' => 'nullable|max:255|string',
            'price' => 'nullable',
            'discount' => 'nullable',
            'tax' => 'nullable',
            'total' => 'nullable',
            'returned' => 'nullable',
            'qty' => 'nullable',
            'returned_qty' => 'nullable',
            'is_free' => 'nullable',
            'is_returned' => 'nullable',
            'options' => 'nullable'
            ],
            message: __('OrdersItem updated successfully'),
            redirect: 'admin.orders-items.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\OrdersItem $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoOrders\Models\OrdersItem $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::orders-items.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\OrdersItem $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoOrders\Models\OrdersItem $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::orders-items.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoOrders\Models\OrdersItem $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoOrders\Models\OrdersItem $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'order_id' => 'sometimes|exists:orders,id',
            'account_id' => 'nullable|exists:accounts,id',
            'product_id' => 'nullable|exists:products,id',
            'refund_id' => 'nullable',
            'warehouse_move_id' => 'nullable',
            'item' => 'nullable|max:255|string',
            'price' => 'nullable',
            'discount' => 'nullable',
            'tax' => 'nullable',
            'total' => 'nullable',
            'returned' => 'nullable',
            'qty' => 'nullable',
            'returned_qty' => 'nullable',
            'is_free' => 'nullable',
            'is_returned' => 'nullable',
            'options' => 'nullable'
            ],
            message: __('OrdersItem updated successfully'),
            redirect: 'admin.orders-items.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\OrdersItem $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoOrders\Models\OrdersItem $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('OrdersItem deleted successfully'),
            redirect: 'admin.orders-items.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
