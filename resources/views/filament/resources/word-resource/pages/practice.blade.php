<x-filament-panels::page>
  <x-filament::section>
    <x-slot name="heading">
      <div class="flex justify-between items-center">
        {{ strtoupper($correct_word->pronunciation) }}
        <x-filament::button color="gray" wire:click="randomizeWords">
          <x-filament::icon
              icon="heroicon-o-arrow-path"
              class="h-5 w-5 text-gray-500 dark:text-gray-400"
          />
        </x-filament::button>
      </div>
    </x-slot>
    <div class="flex flex-wrap gap-8">
      @foreach ($words as $word)
        <x-filament::button color="gray" wire:click="validateAnswer('{{ $word->pronunciation }}')">
          {{ $word->japanese }}
        </x-filament::button>
      @endforeach
    </div>
  </x-filament::section>
</x-filament-panels::page>