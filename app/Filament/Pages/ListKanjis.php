<?php

namespace App\Filament\Pages;

use App\Models\Symbol;
use Filament\Pages\Page;

class ListKanjis extends Page
{ 
    protected static ?string $navigationLabel = 'Kanjis';
    protected static ?string $title  = 'Kanjis';
    protected static ?string $navigationGroup = 'Practice';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.pages.list-kanjis';

    public $symbols;

    public function mount()
    {
        $this->symbols = Symbol::where('type', 'kanji')->get(['japanese', 'pronunciation']);
    }
}
