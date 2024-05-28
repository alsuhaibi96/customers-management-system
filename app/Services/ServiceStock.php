<?php 

namespace App\Services;

use App\Models\Product;

class ServiceStock 
{

    public function updateStock($productId,$orderedQauntity,$oldQuantity=0){
        $product =Product::findOrFail($productId);
        $stock=$product->stocks()->first();

        if($stock)
        {
            $currentStock=$stock->quantity;
            $quantityDifference=$orderedQauntity-$oldQuantity;
            $newQuantity=$currentStock-$quantityDifference;
            $newQuantity=max($newQuantity,0);
            $stock->update([
                'quantity'=>$newQuantity
            ]);
            return $stock;
        }

    }

}

