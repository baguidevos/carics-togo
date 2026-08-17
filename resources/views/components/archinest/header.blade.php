{{-- @php
    if (request()->has('variant')) {
        session(['nav_variant' => request('variant')]);
    }
    $variant = session('nav_variant', 'v1');
@endphp --}}

{{-- @if ($variant === 'v2') --}}
    {{-- <x-archinest.header-v2 /> --}}
{{-- @else --}}
    <x-archinest.header-v1 />
{{-- @endif --}}