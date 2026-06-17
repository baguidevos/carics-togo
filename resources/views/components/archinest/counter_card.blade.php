@props([
    'number' => 00,
    'title' => "null",
])

<div class="col-lg-6 col-md-6">
    <div class="counter-block-three wow zoomIn">
        <div class="inner">
            {{-- <div class="top-box">
                <div class="number">{{ $number }}</div>
                <div class="count-box"><span class="count-text" data-speed="3000" data-stop="120">0</span>+</div>
            </div> --}}
            <div class="content">
                <div class="number">{{ $number }}</div>
                <div class="counter-title">{{ $title }}</div>
                <div class="text">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>