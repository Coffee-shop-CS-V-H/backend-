<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Összes rendelés lekérdezése
    public function index()
    {
        return Order::all();
    }

    // Egy adott rendelés lekérdezése az order_id alapján
    public function show($order_id)
    {
        return Order::find($order_id);
    }

    // Új rendelés létrehozása
    public function store(Request $request)
    {
        $record = new Order();
        $record->fill($request->all());
        $record->save();
    }

    // Rendelés frissítése
    public function update(Request $request, $order_id)
    {
        $record = Order::find($order_id);

        if (!$record) {
            abort(404, 'Order not found.');
        }

        $record->fill($request->all());
        $record->save();
    }

    // Rendelés törlése
    public function destroy($order_id)
    {
        $record = Order::find($order_id);

        if (!$record) {
            abort(404, 'Order not found.');
        }

        $record->delete();
    }
}
