<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WordResource\Pages;
use Filament\Resources\Resource;
use App\Models\Translation;
use Filament\Tables\Table;
use Filament\Forms\Form;
use App\Models\Word;
use Filament\Forms;
use Filament\Tables;

class WordResource extends Resource
{
    protected static ?string $model = Word::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('japanese')->required()->label('Japanese word'),
                Forms\Components\TextInput::make('pronounciation')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('japanese')->searchable(),
                Tables\Columns\TextColumn::make('pronounciation')->searchable(),
                Tables\Columns\TextColumn::make('translations.value')
                    ->wrap()
                    ->badge()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('Add translation')
                        ->icon('heroicon-o-plus-circle')
                        ->form([
                            Forms\Components\TextInput::make('value')->label('Translation')->required()
                        ])
                        ->action(function (Word $word, $data) {
                            Translation::create([
                                'value' => $data['value'],
                                'word_id' => $word->id,
                            ]);
                        })
                ])
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
            'index' => Pages\ListWords::route('/'),
            'create' => Pages\CreateWord::route('/create'),
            'edit' => Pages\EditWord::route('/{record}/edit'),
        ];
    }
}
