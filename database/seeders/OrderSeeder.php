<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->count(10)->create()->each(function($order){
            $total = 0;
            Product::query()->inRandomOrder()->take(rand(2, 5))->get()->each(function($product) use ($order, &$total){
                $quantity = rand(1, 3);

                $order->products()->attach($product->id, [
                    'quantity' => $quantity
                ]);

                $total += $product->price * $quantity;
            });

            $order->update([
                'total_amount' => $total
            ]);
        });
    }
}
