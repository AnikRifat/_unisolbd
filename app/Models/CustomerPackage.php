<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPackage extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function customerPackageItems()
    {
        return $this->hasMany(CustomerPackageItem::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class); 
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,"customer_id","id");
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class,"sale_person_id","id");
    }


}
