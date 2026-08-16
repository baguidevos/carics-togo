@props([
    'titre' => '',
    'description' => '',
    'href' => null,
])


<div class="service-block-five anim-fade-move col-xl-5 col-md-6 border " data-fade-from="right" data-delay="0.15">
    <div class="inner-box">
        <div class="icon-box">
            <div class="icon">
                {{ $slot }}
            </div>
        </div>
        <div class="content-box text-center">
            <h4 class="title"><a href="{{ $href ?? route('about') }}">{{ $titre }}</a></h4>
            <div class="text">{{ $description }}</div>
        </div>
        <div class="btn-box">
            <a href="{{ $href ?? route('about') }}" class="btn-style-link"><span>{{ __('navigation.actions.learn_more') }} </span><i
                    class="icon fa-light fa-arrow-up-right"></i></a>
        </div>
    </div>
</div>