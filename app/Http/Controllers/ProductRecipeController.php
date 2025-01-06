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
            'ingredient' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $record = new ProductRecipe();
        $record->fill($validatedData);
        $record->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($product, $ingredient)
    {
        $productRecipe = ProductRecipe::where('product', $product)
            ->where('ingredient', $ingredient)
            ->firstOrFail();

        return $productRecipe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product, $ingredient)
    {
        $record = $this->show($product, $ingredient);

        $validatedData = $request->validate([
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $record->fill($validatedData);
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product, $ingredient)
    {
        $this->show($product, $ingredient)->delete();
    }

    public function ingredientsOfProduct()
    {
        // Képzeld el, hogy egy receptet keresel, és szeretnéd megkapni az alapanyagokat és a késztermékeket:
        $recipe = ProductRecipe::with(['ingredients', 'finishedProduct'])->get();
    }
}
