<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 't_customer_cus';

    protected $primaryKey = 'cus_id';

    protected $fillable = [
        'cus_fullname',
        'cus_phone',
        'cus_address',
        'cus_nb_orders',
        'cus_total_spendings',
        'created_at',
        'updated_at'
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
