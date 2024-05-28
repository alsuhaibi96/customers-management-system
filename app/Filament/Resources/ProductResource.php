<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'إدارة المنتجات';
    protected static ?string $navigationLabel = 'المنتجات';
    protected static ?string $label = 'منتج';
    protected static ?string $pluralModelLabel = 'المنتجات';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make()->schema([
                TextInput::make('name')->Label('اسم المنتج')->required(),
                FileUpload::make('image')
                ->Label('الصورة')
                ->image()
                ->imageEditor()
                ->maxSize(1024),
                TextInput::make('reviews')->Label('التقييم'),
                MarkdownEditor::make('description')->Label('الوصف'),

                ])
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->Label('اسم المنتج')->sortable()->searchable(),
                ImageColumn::make('image')->Label('الصورة'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
