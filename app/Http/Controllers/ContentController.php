<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function show($cup_id, $product_id)
    {
        $cup_content = Content::where('cup_id', $cup_id)
            ->where('product_id', $product_id)
            ->get();
        return $cup_content[0];
    }

    public function store(Request $request)
    {
        $record = new Content();
        $record->fill($request->all());
        $record->save();
    }

    public function update(Request $request, $cup_id, $product_id)
    {
        $record = $this->show($cup_id, $product_id);
        $record->fill($request->all());
        $record->save();
    }

    public function destroy($cup_id, $product_id)
    {
        $this->show($cup_id, $product_id)->delete();
    }

    public function cupContent()
    {
        return $this->belongsTo(ProductRecipe::class, 'product_id', 'product')
            ->where('productrecipe.product', $this->product_id)
            ->orWhere('productrecipe.material', $this->product_id);
    }
}
