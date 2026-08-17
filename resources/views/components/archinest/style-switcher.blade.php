@php
    $currentVariant = session('nav_variant', request('variant', 'v1'));
@endphp

<div class="carics-style-switcher" x-data="{ expanded: true }">
    <div class="d-flex align-items-center gap-2">
        <span class="d-flex align-items-center gap-1 text-white-50" style="font-size: 0.72rem; text-transform: uppercase; font-family: var(--font-mono); letter-spacing: 0.08em;">
            <i class="fa-solid fa-palette text-accent"></i>
            <span x-show="expanded" x-transition>Design :</span>
        </span>

        <div x-show="expanded" x-transition class="d-flex align-items-center gap-1">
            <a href="?variant=v1" class="switch-btn {{ $currentVariant === 'v1' ? 'active' : '' }}" title="Option A : Institutionnel Moderne & Épuré">
                🏛️ Option A (Épuré)
            </a>
            <a href="?variant=v2" class="switch-btn {{ $currentVariant === 'v2' ? 'active' : '' }}" title="Option B : High-Tech & Glassmorphism Bento">
                ✨ Option B (Glass)
            </a>
        </div>

        <button type="button" @click="expanded = !expanded" class="btn btn-sm text-white-50 p-0 ms-1 border-0" style="font-size: 0.75rem;" title="Réduire / Agrandir">
            <i class="fa-solid" :class="expanded ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
        </button>
    </div>
</div>
