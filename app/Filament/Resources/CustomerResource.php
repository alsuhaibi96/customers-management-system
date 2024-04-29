<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationLabel = 'Customers';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make()->schema([
                TextInput::make('customer_name')->required(),
                TextInput::make('serial_number'),
                TextInput::make('phone_number'),
                TextInput::make('neighbourhood'),
                TextInput::make('download_speed_before_installing'),
                TextInput::make('download_speed_after_installing'),
                TextInput::make('upload_speed_before_installing'),
                TextInput::make('upload_speed_after_installing'),
                TextInput::make('ping_before_installing'),
                TextInput::make('ping_after_installing'),
                TextInput::make('cell_number'),
                TextInput::make('bandwidth_strength_after_installing'),
                TextInput::make('signal_db_after_installing'),
                TextInput::make('card_used'),
                MarkdownEditor::make('notes'),
                MarkdownEditor::make('extra_notes'),
            ])
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')->sortable()->searchable(),
                TextColumn::make('serial_number')->searchable(),
                TextColumn::make('phone_number'),
                TextColumn::make('neighbourhood'),
                TextColumn::make('download_speed_before_installing')->sortable()->searchable(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
