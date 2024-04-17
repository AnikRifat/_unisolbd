<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetails extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'company_name',
        'trade_license_number',
        'nid_no',
        'passport_number',
        'bin_num',
        'tin_num',
        'address',
        'city',
        'post_code',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
