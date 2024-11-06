<?php

namespace App\Filament\Exports;

use App\Models\Word;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class WordExporter extends Exporter
{
    protected static ?string $model = Word::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('word_id'),
            ExportColumn::make('japanese'),
            ExportColumn::make('pronounciation'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your word export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
