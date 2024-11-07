<?php

namespace App\Filament\Imports;

use Filament\Actions\Imports\Models\Import;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use App\Models\Translation;
use App\Models\Word;

class WordImporter extends Importer
{
    protected static ?string $model = Word::class;
    protected $translations = [];

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('japanese')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('pronounciation')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('translations')
                ->array(',')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Word
    {
        return Word::firstOrNew([
            'japanese' => $this->data['japanese'],
        ]);
    }

    protected function beforeFill(): void
    {
        $this->translations = $this->data['translations'];
        unset($this->data['translations']);
    }

    protected function afterSave(): void
    {
        foreach ($this->translations as $translation)
        {
            Translation::create([
                'value' => $translation,
                'word_id' => $this->record->id,
            ]);
        }
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your word import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
