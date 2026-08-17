{{-- @php
    $variant = session('nav_variant', request('variant', 'v1'));
@endphp

@if ($variant === 'v2')
    <x-archinest.footer-v2 />
@else --}}
    <x-archinest.footer-v1 />
{{-- @endif --}}