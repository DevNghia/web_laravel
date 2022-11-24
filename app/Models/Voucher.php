<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'voucher_name', 'voucher_code', 'voucher_time', 'voucher_number', 'voucher_condition'
    ];
    protected $primaryKey = 'voucher_id';
    protected $table = 'tbl_voucher';
}
