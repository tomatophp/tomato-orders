<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class UpdateOrderingSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ordering.ordering_active_shipping_fees', false);
        $this->migrator->add('ordering.ordering_shipping_fees', 10);
    }
}
