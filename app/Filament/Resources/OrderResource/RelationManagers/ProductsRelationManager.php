<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Services\ServiceStock;
use App\Services\StockService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';
    protected static ?string $pluralModelLabel = 'المنتجات';
    protected static ?string $label = 'منتج';
    protected static ?string $title = 'مخزون المنتج';
         
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->label('الكمية')
                    ->maxLength(255)
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $livewire,$component,Forms\Set $set) {
                      $product = $component->getRecord();
                      if($product)
                      {
                        $serviceStock=new ServiceStock();
                        $result=  $serviceStock->updateStock($product->product_id,$state);
                        if(!$result['success'])
                        {
                            Notification::make()
                            ->title('خطأ')
                            ->body($result['message'])
                            ->danger()
                            ->send();

                        }
                        else {
                            Log::error('No record available in the component to update stock.');
                        }


                      }
                      else {
                        Log::error('No record available in the component to update stock.');
                      }
                     
                    }),
            ]);
    }

   
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('quantity')
            ->columns([
                Tables\Columns\TextColumn::make('quantity')->label('الكمية'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }
}
