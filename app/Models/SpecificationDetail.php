<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationDetail extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function specification()
    {
        return $this->belongsTo(Specification::class,'specification_id', 'id');
        
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
        
    }


}
