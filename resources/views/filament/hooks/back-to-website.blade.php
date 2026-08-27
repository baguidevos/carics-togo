<div class="flex items-center gap-x-2 mr-2">
    {{-- Bouton complet sur écran desktop / tablette --}}
    <x-filament::button
        tag="a"
        :href="route('home')"
        target="_blank"
        rel="noopener noreferrer"
        color="gray"
        size="sm"
        icon="heroicon-o-arrow-top-right-on-square"
        icon-position="after"
        class="hidden sm:inline-flex"
    >
        Voir le site
    </x-filament::button>
</div>

{{-- <div class="sm:hidden">
     <x-filament::icon-button
        tag="a"
        :href="route('home')"
        target="_blank"
        rel="noopener noreferrer"
        color="gray"
        icon="heroicon-o-arrow-top-right-on-square"
        tooltip="Voir le site public"
        class=""
    />
</div> --}}
