<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:40',
            'type' => 'sometimes|string|size:1',
            'category' => 'sometimes|string|size:3',
            'is_available' => 'sometimes|boolean',
            'current_price' => 'sometimes|numeric|min:0',
            'unit_ml' => 'sometimes|integer|min:0',
        ]);

        $record = new Product();
        $record->fill($validatedData);
        $record->save();
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        return Product::find($id);
       
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:40',
            'type' => 'sometimes|string|size:1',
            'category' => 'sometimes|string|size:3',
            'is_available' => 'sometimes|boolean',
            'current_price' => 'sometimes|numeric|min:0',
            'unit_ml' => 'sometimes|integer|min:0',
        ]);
        

        $product->fill($validatedData);
        $product->save();
        
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        
    }

    public function getProductsByType($type)
    {
        if (!in_array($type, ['I', 'F'])) {
            return response()->json(['error' => 'Type is not find'], 400);
        }
    
        $products = Product::where('type', $type)
            ->orderBy('product_name') 
            ->get(['product_name', 'current_price','chategory', 'is_available' ]);
    
    }
    

}
