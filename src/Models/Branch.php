<?php

namespace TomatoPHP\TomatoOrders\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property Company $company_id
 * @property int $branch_number
 * @property string $phone
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property Invoice[] $invoices
 * @property Order[] $orders
 */
class Branch extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['company_id', 'branch_number','name', 'phone', 'address', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany('TomatoPHP\TomatoOrders\Models\Invoice');
    }

    public function company()
    {
        return $this->belongsTo('TomatoPHP\TomatoOrders\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('TomatoPHP\TomatoOrders\Models\Order');
    }
}
