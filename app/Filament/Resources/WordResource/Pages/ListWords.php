<?php

namespace App\Filament\Resources\WordResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WordResource;
use App\Filament\Exports\WordExporter;
use App\Filament\Imports\WordImporter;
use Filament\Support\Colors\Color;
use Filament\Actions;

class ListWords extends ListRecords
{
    protected static string $resource = WordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ImportAction::make('import-japanese-words')->importer(WordImporter::class)->color(Color::Rose),
            Actions\ExportAction::make('export-japanese-words')->exporter(WordExporter::class)->color(Color::Green)
        ];
    }
}
