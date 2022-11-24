<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_code', 'product_id', 'product_name', 'product_price',
        'product_voucher', 'product_fee', 'product_sales_quantity'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';
}
