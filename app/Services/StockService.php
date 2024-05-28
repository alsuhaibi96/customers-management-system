<?php 

namespace App\Services;

use App\Models\Product;

class StockService
{
    public function updateStock($productId, $orderedQuantity, $oldQuantity = 0)
    {
        $product =Product::findOrFail($productId);
        $stock = $product->stocks()->first();

        if ($stock) {
            $currentStock = $stock->quantity;
            $quantityDifference = $orderedQuantity - $oldQuantity;
            $newQuantity =  $currentStock - $quantityDifference;

            // Ensure stock does not go negative
            $newQuantity = max($newQuantity, 0);

            // Update the stock entry with the new quantity
            $stock->update([
                'quantity' => $newQuantity
            ]);

            return $stock;
        }

        // Optionally, handle cases where no stock exists yet
        throw new \Exception("No stock record found for this product.");
    }
}