<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rules', 'status'];

    protected $casts = [
        'rules' => 'array', // Cast rules attribute to array
    ];

    public function customers()
    {
        return $this->belongsToMany(User::class, 'assign_customer_to_groups', 'customer_group_id', 'customer_id');
    }
}
