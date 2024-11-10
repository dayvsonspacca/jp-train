<x-filament-panels::page>
  <div class="flex gap-4">
    @foreach ($symbols as $hiragana)
      <x-filament::section>
        <p class="text-3xl text-center">{{ $hiragana->japanese }}</p> <br>
        <p class="text-sm text-center">{{ $hiragana->pronunciation }}</p>
      </x-filament::section>
    @endforeach
  </div>
</x-filament-panels::page>