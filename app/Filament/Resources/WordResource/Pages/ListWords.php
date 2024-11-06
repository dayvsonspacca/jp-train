<?php

namespace App\Filament\Resources\WordResource\Pages;

use App\Filament\Imports\TranslationImporter;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WordResource;
use App\Filament\Exports\WordExporter;
use App\Filament\Imports\WordImporter;
use Filament\Actions;

class ListWords extends ListRecords
{
    protected static string $resource = WordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make('import-japanese-words')->importer(WordImporter::class),
            Actions\ImportAction::make('import-japanese-translations')->importer(TranslationImporter::class),
            Actions\ExportAction::make('export-japanese-words')->exporter(WordExporter::class)
        ];
    }
}
