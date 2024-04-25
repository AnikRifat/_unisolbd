<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDivision extends Model
{
    use HasFactory;

    protected $guarded = [];

    // ShipDivision model
    public function districts()
    {
        return $this->hasMany(ShipDistrict::class, 'division_id');
    }

    public function states()
    {
        return $this->hasMany(ShipState::class, 'division_id');
    }
}
