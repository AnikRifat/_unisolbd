<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignCustomerToGroup extends Model
{
    protected $fillable = ['customer_id', 'customer_group_id'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class);
    }
}
