<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    use HasFactory;

    // Összetett elsődleges kulcs
    protected $primaryKey = ['product', 'material'];
    public $incrementing = false;

    protected $fillable = [
        'product',
        'material',
        'quantity',
    ];

    public $timestamps = true;

    // Kapcsolat a termékek táblával
    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }

    public function material()
    {
        return $this->belongsTo(Product::class, 'material');
    }
}