<?php

namespace App\Filament\Pages;

use App\Models\Symbol;
use Filament\Pages\Page;

class ListHiragana extends Page
{
    protected static ?string $navigationLabel = 'Hiragana';
    protected static ?string $title  = 'Hiragana';
    protected static ?string $navigationGroup = 'Practice';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.pages.list-hiragana';

    public $symbols;

    public function mount()
    {
        $this->symbols = Symbol::where('type', 'hiragana')->get(['japanese', 'pronunciation']);
    }
}
