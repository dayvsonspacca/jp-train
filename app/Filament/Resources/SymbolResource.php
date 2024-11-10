<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SymbolResource\Pages;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Form;
use App\Models\Symbol;
use Filament\Tables;
use Filament\Forms;

class SymbolResource extends Resource
{
    protected static ?string $model = Symbol::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-yen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('japanese')->required()->label('Japanese symbol'),
                Forms\Components\TextInput::make('pronunciation')->required(),
                Forms\Components\Select::make('type')->options(['kanji' => 'Kanji', 'hiragana' => 'Hiragana', 'katakana' => 'Katakana'])->required()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('japanese')->searchable(),
                Tables\Columns\TextColumn::make('pronunciation')->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->badge()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('type')
                ->options([
                    'kanji' => 'Kanji',
                    'hiragana' => 'Hiragana',
                    'katakana' => 'Katakana',
                ])
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
            'index' => Pages\ListSymbols::route('/'),
            'create' => Pages\CreateSymbol::route('/create'),
            'edit' => Pages\EditSymbol::route('/{record}/edit'),
        ];
    }
}
