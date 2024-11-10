<x-filament-panels::page>
  <div class="flex gap-4">
      @foreach ($symbols as $kanji)
        <x-filament::section>
          <p class="text-3xl text-center">{{ $kanji->japanese }}</p> <br>
          <p class="text-sm text-center">{{ $kanji->pronunciation }}</p>
        </x-filament::section>
      @endforeach
  </div>
</x-filament-panels::page>
