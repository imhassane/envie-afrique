<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $table = 't_order_products_opr';

    protected $primaryKey = 'opr_id';

    protected $fillable = [
      'ord_id',
      'pro_id',
      'opr_quantity',
      'opr_price',
      'created_at',
      'updated_at'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'ord_id', 'ord_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'pro_id', 'pro_id');
    }
}
