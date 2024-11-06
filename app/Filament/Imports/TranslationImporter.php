<?php

namespace App\Filament\Imports;

use App\Models\Translation;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class TranslationImporter extends Importer
{
    protected static ?string $model = Translation::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('value')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('word')
                ->relationship()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Translation
    {
        // return Translation::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Translation();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your translation import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
