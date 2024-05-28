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
    protected static ?string $navigationGroup = 'إدارة العملاء';
    protected static ?string $navigationLabel = 'العملاء';
    protected static ?string $pluralModelLabel = 'عميل';
    protected static ?string $label = 'عميل';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make()->schema([
                TextInput::make('customer_name')->label('اسم العميل')->required(),
                TextInput::make('serial_number')->label('الرقم التسلسي'),
                TextInput::make('phone_number')->label('رقم الجوال'),
                TextInput::make('neighbourhood')->label('الحي'),
                TextInput::make('download_speed_before_installing')->label('سرعة التحميل قبل'),
                TextInput::make('download_speed_after_installing')->label('سرعة التحميل بعد'),
                TextInput::make('upload_speed_before_installing')->label('سرعة الرفع قبل'),
                TextInput::make('upload_speed_after_installing')->label('سرعة الرفع بعد'),
                TextInput::make('ping_before_installing')->label('البنج قبل'),
                TextInput::make('ping_after_installing')->label('البنج بعد'),
                TextInput::make('cell_number')->label('رقم الخلية'),
                TextInput::make('bandwidth_strength_after_installing')->label('قوة الاشارة بعد التركيب'),
                TextInput::make('signal_db_after_installing')->label('الديبي بعد التركيب'),
                TextInput::make('card_used')->label('نوع الشريحة'),
                MarkdownEditor::make('notes')->label('ملاحظات'),
                MarkdownEditor::make('extra_notes')->label('ملاحظات اضافة'),
            ])
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')->label('اسم العميل')->sortable()->searchable(),
                TextColumn::make('serial_number')->label('الرقم التسلسلي')->searchable(),
                TextColumn::make('phone_number')->label('رقم الهاتف')->searchable(),
                TextColumn::make('neighbourhood')->label('الحي')->searchable(),
                TextColumn::make('download_speed_before_installing')->label('سرعة التحميل قبل')->sortable()->searchable(),
                TextColumn::make('download_speed_after_installing')->label('سرعة التحميل بعد')->sortable()->searchable(),
                TextColumn::make('upload_speed_before_installing')->label('سرعة الرفع قبل')->sortable()->searchable(),
                TextColumn::make('upload_speed_after_installing')->label('الرفع بعد')->sortable()->searchable(),
                TextColumn::make('ping_before_installing')->label('البنج قبل')->sortable()->searchable(),
                TextColumn::make('ping_after_installing')->label('البنج بعد')->sortable()->searchable(),
                TextColumn::make('cell_number')->label('رقم الخلية')->sortable()->searchable(),
                TextColumn::make('bandwidth_strength_after_installing')->label('قوة الاشارة بعد التركيب')->sortable()->searchable(),
                TextColumn::make('signal_db_after_installing')->label('الديبي بعد التركيب')->sortable()->searchable(),
                TextColumn::make('card_used')->label('نوع الشريحة')->sortable()->searchable(),

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
