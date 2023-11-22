<?php

namespace TomatoPHP\TomatoOrders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class BranchController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoOrders\Models\Branch::class;
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
            view: 'tomato-orders::branches.index',
            table: \TomatoPHP\TomatoOrders\Tables\BranchTable::class
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
            model: \TomatoPHP\TomatoOrders\Models\Branch::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-orders::branches.create',
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
            model: \TomatoPHP\TomatoOrders\Models\Branch::class,
            validation: [
                'name' => 'required|max:255|string|unique:branches,name',
                'company_id' => 'required|integer|exists:companies,id',
                'phone' => 'nullable|max:255|min:12',
                'branch_number' => 'nullable|integer',
                'address' => 'nullable|max:255|string'
            ],
            message: __('Branch updated successfully'),
            redirect: 'admin.branches.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\Branch $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoOrders\Models\Branch $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::branches.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\Branch $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoOrders\Models\Branch $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-orders::branches.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoOrders\Models\Branch $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoOrders\Models\Branch $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'name' => 'sometimes|max:255|string|unique:branches,name,'.$model->id,
                'company_id' => 'required|integer|exists:companies,id',
                'phone' => 'nullable|max:255|min:12',
                'branch_number' => 'nullable|integer',
                'address' => 'nullable|max:255|string'
            ],
            message: __('Branch updated successfully'),
            redirect: 'admin.branches.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoOrders\Models\Branch $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoOrders\Models\Branch $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Branch deleted successfully'),
            redirect: 'admin.branches.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
