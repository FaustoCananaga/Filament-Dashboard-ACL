<x-dynamic-component
    :component="static::isSimple() ? 'filament-panels::page.index' : 'filament-panels::page'"
>
  

    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>
</x-dynamic-component>

