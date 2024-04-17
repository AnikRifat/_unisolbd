<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $guarded=[];

    public function specificationdetails()
    {
        return $this->hasMany(SpecificationDetail::class,'specification_id', 'id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id', 'id');
    }
}
