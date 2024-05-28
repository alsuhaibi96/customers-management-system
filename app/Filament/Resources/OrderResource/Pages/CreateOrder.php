<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\Stock;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    public static function store(Form $form)
    {
        return $form->store(function (Form $form) {
            $data = $form->getState();
            
            // Create the order
            $order = Order::create([
                'customer_id' => $data['customer_id'],
                'price' => $data['price'],
                // other fields as necessary
            ]);
    
            // Handle each product in the order (assuming 'products' is a repeater/array)
            foreach ($data['products'] as $productData) {
                $order->products()->attach($productData['product_id'], ['quantity' => $productData['quantity']]);
                
                // Update stock
                $stock = Stock::where('product_id', $productData['product_id'])->first();
                if ($stock) {
                    $stock->decrement('quantity', $productData['quantity']);
                }
            }
    
            return $order;
        });
    }
}
