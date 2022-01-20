<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 't_category_cat';

    protected $primaryKey = 'cat_id';

    protected $fillable = [
        'cat_name',
        'cat_description',
        'cat_avatar',
        'cat_visible',
        'created_at',
        'updated_at'
    ];


}
