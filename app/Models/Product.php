<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'pro_id';

    protected $table = 't_product_pro';

    protected $fillable = [
        'pro_name',
        'pro_description',
        'pro_article',
        'pro_cover',
        'pro_status',
        'pro_price',
        'pro_suggestion',
        'created_at',
        'updated_at'
    ];

    function getStatus() {
        $status = $this->pro_status;
        $text = "";

        switch($status) {
            case "ACTIVE":
                $text = "Visible au public";
                break;
            case "INACTIVE":
                $text = "Produit inactif";
                break;
            case "OUT_OF_STOCK":
                $text = "En rupture de stock";
                break;
            default:
                $text = "Statut non reconnu";
                break;
        }

        return $text;
    }
}
