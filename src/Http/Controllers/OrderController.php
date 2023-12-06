<?php

namespace TomatoPHP\TomatoOrders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use TomatoPHP\TomatoLocations\Models\Area;
use TomatoPHP\TomatoLocations\Models\City;
use TomatoPHP\TomatoOrders\Models\Order;
use TomatoPHP\TomatoOrders\Models\OrdersItem;
use TomatoPHP\TomatoOrders\Facades\TomatoOrdering;
use TomatoPHP\TomatoOrders\Settings\OrderingSettings;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoProducts\Models\Product;

class OrderController extends Controller
{
    public string $model;
    private array $order = [];
    private Collection $items;
    private array $errors = [];

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoOrders\Models\Order::class;
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
            view: 'tomato-orders::orders.index',
            table: \TomatoPHP\TomatoOrders\Tables\OrderTable::class,
            filters: [
                "branch_id",
                "status",
                "soruce",
                "name",
                "phone",
                "uuid"
            ]
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
            model: \TomatoPHP\TomatoOrders\Models\Order::class,
            filters: [
                "branch_id",
                "status",
                "soruce",
                "name",
                "phone",
                "uuid"
            ]
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-orders::orders.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = TomatoOrdering::store($request);

        Toast::success(__('Order created successfully'))->autoDismiss(2);
        return redirect()->route('admin.orders.show', $response->id);
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\Order $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoOrders\Models\Order $model): View|JsonResponse
    {
        $model = TomatoOrdering::setOrder($model)->get();
        return view('tomato-orders::orders.show', compact('model'));
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\Order $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoOrders\Models\Order $model): View
    {
        $model = TomatoOrdering::setOrder($model)->get();
        return view('tomato-orders::orders.edit', compact('model'));
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoOrders\Models\Order $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoOrders\Models\Order $model): RedirectResponse|JsonResponse
    {
        TomatoOrdering::setOrder($model)->update($request);

        Toast::success(__('Order updated successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\Order $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoOrders\Models\Order $model): RedirectResponse|JsonResponse
    {
        TomatoOrdering::setOrder($model)->delete();

        Toast::success(__('Order deleted successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    public function settings(){
        $settings = new OrderingSettings();
        return view('tomato-orders::orders.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request){
        $setting = new OrderingSettings();
        foreach ($request->all() as $key => $value) {
            if($value !== null){
                $setting->{$key} = $value;
            }
        }

        $setting->save();

        Toast::success(__('Ordering settings updated successfully'))->autoDismiss(2);
        return redirect()->route('admin.orders.settings');
    }

    public function user(Request $request){
        $request->validate([
            "search" => "required|max:255|string",
        ]);

        $q = $request->get('search');

        $account = config('tomato-crm.model')::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('phone', 'like', "%$q%");
        })
            ->with('locations')->get();
        if($account){
            return response()->json($account);
        }
    }

    public function product(Request $request){
        $request->validate([
            "search" => "required|max:255|string",
        ]);

        $q = $request->get('search');

        $account = Product::where(function ($query) use ($q) {
            $query->whereJsonContains('name', $q)
                ->orWhere('sku', 'like', "%$q%")
                ->orWhere('barcode', 'like', "%$q%");
        })->with('productMetas', function ($q){
            $q->where('key', 'options')->first();
        })->get();
        if($account){
            return response()->json($account);
        }
    }

    public function status(Request $request, Order $model){
        $request->validate([
            "status" => "required|max:255|string",
        ]);

        $status = TomatoOrdering::setOrder($model)->status($request->get('status'));

        if(is_string($status)){
            Toast::danger($status)->autoDismiss(2);
            return redirect()->back();
        }
        else {
            Toast::success(__('Order status updated successfully'))->autoDismiss(2);
            return redirect()->back();
        }

    }

    public function approve(Order $model){
        $checkStatus = TomatoOrdering::setOrder($model)->approve();
        if(is_string($checkStatus)){
            Toast::danger($checkStatus)->autoDismiss(2);
            return redirect()->back();
        }
        else {
            Toast::success(__('Order approved successfully'))->autoDismiss(2);
            return redirect()->back();
        }
    }

    public function shipping(Order $model)
    {
        return view('tomato-orders::orders.shipping', compact('model'));
    }

    public function ship(Request $request, Order $model)
    {
        TomatoOrdering::setOrder($model)->shipping($request);

        Toast::success(__('Order shipped successfully'))->autoDismiss(2);
        return redirect()->back();
    }
}
