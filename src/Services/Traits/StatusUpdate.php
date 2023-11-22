<?php

namespace TomatoPHP\TomatoOrders\Services\Traits;

use Illuminate\Http\Request;
use TomatoPHP\TomatoOrders\Models\Order;

trait StatusUpdate
{
    public function status(string $status): void
    {
        $this->order->status = $status;
        $this->order->save();

        $this->log(__("Status changed to") . " " . $status);
    }

    public function pending(): void
    {
        $this->status(setting('ordering_pending_status'));
    }

    public function prepared(): void
    {
        $this->status(setting('ordering_prepared_status'));
    }

    public function withdrew(): void
    {
        $this->status(setting('ordering_withdrew_status'));
    }

    public function shipped(): void
    {
        $this->status(setting('ordering_shipped_status'));
    }

    public function delivered(): void
    {
        $this->status(setting('ordering_delivered_status'));
    }

    public function cancel(): void
    {
        $this->status(setting('ordering_cancelled_status'));
    }

    public function refunded(): void
    {
        $this->status(setting('ordering_refunded_status'));
    }

    public function done(): void
    {
        $this->status(setting('ordering_done_status'));
    }

    public function paid(): void
    {
        $this->status(setting('ordering_paid_status'));
    }

    public function approve(): void
    {
        $this->order->is_approved = true;
        $this->order->save();

        $this->log(__("Order Has Been Approved"));

        $this->prepared();
    }
}
