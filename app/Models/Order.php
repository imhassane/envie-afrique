<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 't_order_ord';

    protected $primaryKey = 'ord_id';

    protected $fillable = [
        'ord_price',
        'ord_status',
        'ord_date',
        'ord_time',
        'ord_paid',
        'ord_preparation_date',
        'ord_ready_date',
        'ord_delivery_date',
        'ord_done_date',
        'cus_id',
        'ord_type',
        'created_at',
        'updated_at'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'cus_id', 'cus_id');
    }

    public function products() {
        return $this->hasMany(OrderProducts::class, 'ord_id', 'ord_id');
    }
}
