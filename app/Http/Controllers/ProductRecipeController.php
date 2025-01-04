<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;

class ProductRecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductRecipe::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product' => 'required|exists:products,product_id',
            'material' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $record = new ProductRecipe();
        $record->fill($validatedData);
        $record->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($product, $material)
    {
        $productRecipe = ProductRecipe::where('product', $product)
            ->where('material', $material)
            ->firstOrFail();

        return $productRecipe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product, $material)
    {
        $record = $this->show($product, $material);

        $validatedData = $request->validate([
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $record->fill($validatedData);
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product, $material)
    {
        $this->show($product, $material)->delete();
    }

    public function ingredientsOfProduct()
    {
        // Képzeld el, hogy egy receptet keresel, és szeretnéd megkapni az alapanyagokat és a késztermékeket:
        $recipe = ProductRecipe::with(['ingredients', 'finishedProduct'])->get();
    }
}
