<?php

namespace TomatoPHP\TomatoOrders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class ShippingPriceController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoOrders\Models\ShippingPrice::class;
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
            view: 'tomato-orders::shipping-prices.index',
            table: \TomatoPHP\TomatoOrders\Tables\ShippingPriceTable::class
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
            model: \TomatoPHP\TomatoOrders\Models\ShippingPrice::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-orders::shipping-prices.create',
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
            model: \TomatoPHP\TomatoOrders\Models\ShippingPrice::class,
            validation: [
                            'shipping_vendor_id' => 'nullable|exists:shipping_vendors,id',
            'delivery_id' => 'nullable|exists:deliveries,id',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'area_id' => 'nullable|exists:areas,id',
            'type' => 'nullable|max:255|string',
            'price' => 'nullable'
            ],
            message: __('ShippingPrice updated successfully'),
            redirect: 'admin.shipping-prices.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\ShippingPrice $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoOrders\Models\ShippingPrice $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::shipping-prices.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\ShippingPrice $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoOrders\Models\ShippingPrice $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::shipping-prices.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoOrders\Models\ShippingPrice $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoOrders\Models\ShippingPrice $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'shipping_vendor_id' => 'nullable|exists:shipping_vendors,id',
            'delivery_id' => 'nullable|exists:deliveries,id',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'area_id' => 'nullable|exists:areas,id',
            'type' => 'nullable|max:255|string',
            'price' => 'nullable'
            ],
            message: __('ShippingPrice updated successfully'),
            redirect: 'admin.shipping-prices.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\ShippingPrice $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoOrders\Models\ShippingPrice $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('ShippingPrice deleted successfully'),
            redirect: 'admin.shipping-prices.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
