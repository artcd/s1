<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'         => 'required|string|max:255',
            'customer_email'        => 'required|email|max:255',
            'products'              => 'required|array',
            'products.*.id'         => 'required|integer|exists:products,id',
            'products.*.quantity'   => 'required|integer|min:1',
        ]);

        $order = Order::query()->create([
            'customer_name'  => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'total_amount'   => 0,
        ]);

        $total = 0;
        foreach($validated['products'] as $item)
        {
            $product = Product::query()->findOrFail($item['id']);

            $order->products()->attach($product->id, [
                'quantity' => $item['quantity']
            ]);

            $total += $product->price * $item['quantity'];
        }

        $order->update(['total_amount' => $total]);

        return response()->json($order->load('products'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Order::query()->with('products')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'total_amount'      => 'required|numeric|min:0',
        ]);

        return Order::query()->findOrFail($id)->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Order::query()->findOrFail($id)->delete();
    }
}
