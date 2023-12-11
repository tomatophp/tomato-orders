<?php

namespace Tomatophp\TomatoOrders;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use TomatoPHP\TomatoAdmin\Facade\TomatoSlot;
use TomatoPHP\TomatoAdmin\Facade\TomatoWidget;
use TomatoPHP\TomatoAdmin\Services\Contracts\Widget;
use TomatoPHP\TomatoCrm\Facades\TomatoCrm;
use TomatoPHP\TomatoCrm\Services\Contracts\AccountReleation;
use TomatoPHP\TomatoOrders\Models\Order;
use TomatoPHP\TomatoOrders\Tables\OrderTable;
use TomatoPHP\TomatoOrders\View\Components\Items;
use TomatoPHP\TomatoOrders\View\Components\Search;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;


class TomatoOrdersServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoOrders\Console\TomatoOrdersInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-orders.php', 'tomato-orders');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-orders.php' => config_path('tomato-orders.php'),
        ], 'tomato-orders-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-orders-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-orders');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-orders'),
        ], 'tomato-orders-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-orders');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => app_path('lang/vendor/tomato-orders'),
        ], 'tomato-orders-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {

        TomatoMenu::register([
            Menu::make()
                ->group(__('Ordering'))
                ->label(__('Orders'))
                ->icon('bx bxs-rocket')
                ->route('admin.orders.index'),
            Menu::make()
                ->group(__('Ordering'))
                ->label(__('Companies'))
                ->icon('bx bxs-building')
                ->route('admin.companies.index'),
            Menu::make()
                ->group(__('Ordering'))
                ->label(__('Branches'))
                ->icon('bx bxs-home-smile')
                ->route('admin.branches.index'),
            Menu::make()
                ->group(__('Shipping'))
                ->label(__('Vendors'))
                ->icon('bx bxs-truck')
                ->route('admin.shipping-vendors.index'),
            Menu::make()
                ->group(__('Shipping'))
                ->label(__('Delivery'))
                ->icon('bx bxs-car')
                ->route('admin.deliveries.index'),
            Menu::make()
                ->group(__('Shipping'))
                ->label(__('Prices'))
                ->icon('bx bx-money')
                ->route('admin.shipping-prices.index')
        ]);

        $this->loadViewComponentsAs('tomato', [
            Search::class,
            Items::class
        ]);

        $this->app->bind('tomato-ordering', function () {
            return new \TomatoPHP\TomatoOrders\Services\Ordering();
        });


        TomatoCrm::registerAccountReleation(
            AccountReleation::make('orders')
                ->label([
                    "ar" => "الطلبات",
                    "en" => "Orders"
                ])
                ->table(OrderTable::class)
                ->view('tomato-orders::orders.table')
                ->path('orders')
                ->toArray()
        );

        if(Schema::hasTable('orders')){
            $filterBy = [];
            if(request()->has('filterBy') && request()->get('filterBy') === 'today'){
                $filterBy = [
                    Carbon::now()->startOfDay(),
                    Carbon::now()->endOfDay()
                ];
            }
            elseif(request()->has('filterBy') && request()->get('filterBy') === 'week'){
                $filterBy = [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ];
            }
            elseif(request()->has('filterBy') && request()->get('filterBy') === 'month'){
                $filterBy = [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ];
            }
            elseif(request()->has('filterBy') && request()->get('filterBy') === 'year'){
                $filterBy = [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear()
                ];
            }
            else {
                $filterBy = [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ];
            }


            $totalOrders = Order::query()->whereBetween('created_at',$filterBy)->count();

            $canceledOrders = Order::query()->whereBetween('created_at',$filterBy)
                ->where('status', setting('ordering_cancelled_status'))
                ->count();

            $shippedOrdres = Order::query()->whereBetween('created_at',$filterBy)
                ->where('status', setting('ordering_shipped_status'))
                ->count();

            $sumPaidOrders = number_format(
                    Order::query()->whereBetween('created_at',$filterBy)
                        ->where('status', setting('ordering_paid_status'))
                        ->sum('total'), 2). setting('local_currency');

            TomatoWidget::register([
                Widget::make()
                    ->title(__('Total Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bxs-rocket')
                    ->counter($totalOrders),
                Widget::make()
                    ->title(__('Canceled Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bx-x')
                    ->counter($canceledOrders),
                Widget::make()
                    ->title(__('Shipped Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bxs-truck')
                    ->counter($shippedOrdres),
                Widget::make()
                    ->title(__('Paid Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bx-money')
                    ->counter($sumPaidOrders)
            ]);

            TomatoSlot::dashboardTop('tomato-orders::orders.filter');
        }
    }
}
