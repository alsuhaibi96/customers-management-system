<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\ProductsRelationManager;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\BelongsToManyMultiSelect;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'إدارة الطلبات';
    protected static ?string $navigationLabel = 'الطلبات';
    protected static ?string $label = 'الطلب';
    protected static ?string $pluralModelLabel = 'الطلب';

    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('customer_id')
                    ->relationship('customer', 'customer_name')
                    ->label('العميل')
                    ->searchable()

                    ->required(),
                    Select::make('product_id')
                    ->label('المنتج')
                    ->relationship('products', 'name') // Assuming 'name' is the display field for products
                    ->required(),
                    TextInput::make('price')
                    ->label('السعر')
                    ->required()->numeric(),
                    TextInput::make('status')
                    ->label('الحالة'),
                    TextInput::make('city')
                    ->label('المدينة'),
                       
                    ])
                    //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('customer.customer_name')->label('العميل')->sortable()->searchable(),
                TextColumn::make('price')->label('السعر')->sortable()->searchable(),
                TextColumn::make('status')->label('الحالة')->sortable()->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
