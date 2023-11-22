<?php

namespace TomatoPHP\TomatoOrders\Settings;

use Spatie\LaravelSettings\Settings;


class OrderingSettings extends Settings
{
    public int $ordering_web_branch;
    public int $ordering_mobile_branch;
    public int $ordering_direct_branch;
    public string $ordering_stating_code;
    public string $ordering_pending_status;
    public string $ordering_prepared_status;
    public string $ordering_withdrew_status;
    public string $ordering_shipped_status;

    public string $ordering_delivered_status;

    public string $ordering_cancelled_status;

    public string $ordering_refunded_status;

    public string $ordering_done_status;

    public string $ordering_paid_status;

    public bool $ordering_show_company_data;

    public bool $ordering_show_branch_data;

    public bool $ordering_show_company_logo;

    public bool $ordering_show_tax_number;

    public bool $ordering_show_registration_number;


    public static function group(): string
    {
        return 'ordering';
    }
}
