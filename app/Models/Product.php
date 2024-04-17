<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
class Product extends Model
{
    use Searchable;
    use HasFactory;
    protected $guarded=[];

  

    public function toSearchableArray()
    {
        return [
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'subsubcategory_id' => $this->subsubcategory_id,
            'product_name' => $this->product_name,
            'quotation_product_name' => $this->quotation_product_name,
            'product_code' => $this->product_code,
            'selling_price' => $this->selling_price,
            'discount_price' => $this->discount_price,
            'opening_qty' => $this->opening_qty,
            'product_slug' => strtolower(str_replace(' ', '-', $this->product_name)),
            'product_tags' => $this->product_tags,
            'product_thambnail' => $this->product_thambnail,
            'short_descp' => $this->short_descp,
            'quotation_short_descp' => $this->quotation_short_descp,
            'long_descp' => $this->long_descp,
            'specification_descp' => $this->specification_descp,
            'on_sale' => $this->on_sale,
            'unit_id' => $this->unit_id,
            'barcode' => $this->barcode,
            'featured' => $this->featured,
            'special_offer' => $this->special_offer,
            'top_rated' => $this->top_rated,
            'is_expireable' => $this->is_expireable,
            "updated_by" => Auth::guard('admin')->user()->id,
            "updated_at" => Carbon::now()
           
        ];
    }

   
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id', 'id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubCategory::class,'subsubcategory_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        
        return $this->belongsTo(Brand::class,'brand_id', 'id');
    }

    public function unit()
    {
        
        return $this->belongsTo(Unit::class,'unit_id', 'id');
    }

    public function Multiimg()
    {
        return $this->hasMany(MultiImg::class,'product_id', 'id');
    }

    public function productspecification()
    {
        return $this->hasMany(ProductSpecification::class,'product_id', 'id');
    }

    // public function package()
    // {

    // }

    // public function packagedetails()
    // {
    //     return $this->belongsTo(PackageDetails::class,'category_id', 'category_id' )->join('packages', 'package_details.package_id', '=', 'packages.id')->select('package_details.*', 'packages.name');

    // }

    public function latestPurchase()
    {
        return $this->hasOne(PurchaseDetails::class, 'product_id', 'id')->latest('created_at');
    }



}
