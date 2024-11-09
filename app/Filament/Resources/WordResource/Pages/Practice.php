<?php

namespace App\Filament\Resources\WordResource\Pages;

use App\Filament\Resources\WordResource;
use App\Models\Word;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class Practice extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static string $resource = WordResource::class;

    protected static string $view = 'filament.resources.word-resource.pages.practice';

    public $words = [];
    public $correct_word;

    public function mount()
    {
        $this->randomizeWords();
    }

    public function validateAnswer(string $answer)
    {
        if ($answer === $this->correct_word->pronounciation)
        {
            Notification::make()
                ->title('You answer is correctly')
                ->success()
                ->send();
        }
        else
        {
            Notification::make()
            ->title('You answer is incorrectly')
            ->danger()
            ->send();
        }
        
        $this->randomizeWords();
    }

    public function randomizeWords()
    {
        $this->words = Word::inRandomOrder()->take(5)->get();
        $this->correct_word = $this->words->random();
    }
}
