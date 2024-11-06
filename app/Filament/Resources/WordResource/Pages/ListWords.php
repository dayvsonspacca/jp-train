<?php

namespace App\Filament\Resources\WordResource\Pages;

use App\Filament\Imports\TranslationImporter;
use App\Models\Translation;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WordResource;
use App\Filament\Exports\WordExporter;
use App\Filament\Imports\WordImporter;
use Filament\Actions;
use Filament\Support\Colors\Color;

class ListWords extends ListRecords
{
    protected static string $resource = WordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ImportAction::make('import-japanese-words')->importer(WordImporter::class)->color(Color::Rose),
            Actions\ImportAction::make('import-japanese-translations')->importer(TranslationImporter::class)->color(Color::Rose),
            Actions\ExportAction::make('export-japanese-words')->exporter(WordExporter::class)->color(Color::Green)
        ];
    }
}
