<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WordResource\Pages;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\Translation;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Infolists;
use App\Models\Word;
use Filament\Forms;
use Filament\Tables;

class WordResource extends Resource
{
    protected static ?string $model = Word::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';
    protected static ?string $navigationGroup = 'Dictionary';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('japanese')->required()->label('Japanese word'),
                Forms\Components\TextInput::make('pronunciation')->required(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('japanese')->searchable(),
                Tables\Columns\TextColumn::make('pronunciation')->searchable(),
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
                    Tables\Actions\ViewAction::make(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                ->schema([
                    Infolists\Components\Grid::make(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('japanese'),
                        Infolists\Components\TextEntry::make('pronunciation'),
                        Infolists\Components\TextEntry::make('translations.value')->badge()->columnSpanFull(),
                    ])

                ])
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
            'view' => Pages\ViewWord::route('/{record}'),
            'edit' => Pages\EditWord::route(path: '/{record}/edit'),
        ];
    }
}
