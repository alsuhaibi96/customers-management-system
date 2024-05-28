<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Services\StockService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->maxLength(255)
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $livewire,$component,Forms\Set $set) {
                      $product = $component->getRecord();
                      
                        $this->updateProductQuantity($product->product_id, $state);
                    }),
            ]);
    }

    private function updateProductQuantity($product, $newQuantity)
    {
        // Assuming you have a StockService or similar logic to update the stock
        $stockService = new StockService();  // Create instance of your stock service
        $stockService->updateStock($product, $newQuantity);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('quantity')
            ->columns([
                Tables\Columns\TextColumn::make('quantity'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
