<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetails::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'customer_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'sale_person_id', 'id');
    }
}
