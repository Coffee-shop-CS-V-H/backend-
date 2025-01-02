<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /** @use HasFactory<\Database\Factories\ContentFactory> */
    use HasFactory;
    protected $fillable = [
        'cup_id',
        'product_id',
        'product_type'
    ];
    
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('cup_id', '=', $this->getAttribute('cup_id'))
            ->where('product_id', '=', $this->getAttribute('product_id'));

        return $query;
    }

    // Kapcsolat az OrderItem modellel (ha szükséges)
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'cup_id', 'cup_id');  // Helyes kapcsolódás
    }

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}