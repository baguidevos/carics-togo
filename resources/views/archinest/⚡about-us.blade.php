<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Data\TeamData;

new #[Layout('layouts::archinest')] class extends Component {
    public function with(): array
    {
        return [
            'members' => TeamData::all(),
        ];
    }
};
?>

<div>
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('about.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('about.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
    <!-- About Section -->
    <section class="about-section-home-two">
        <div class="auto-container">
            <div class="sec-title-style-two">
                <h2 class="title text-reveal-anim">{{ __('about.who_we_are.title') }}</h2>
            </div>
            <div class="row">
                <div class="image-column col-xl-3 col-md-6 d-none d-xl-block">
                    <figure class="image one">
                        <img src="{{ asset('archinest/images/resource/feature-h2-1.jpg') }}" alt="">
                    </figure>
                </div>
                <div class="content-column col-xl-9 col-lg-12">
                    <div class="inner-column">
                        <div class="content">
                            <div class="text">{{ __('about.who_we_are.intro') }}</div>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">{{ __('about.who_we_are.history_title') }}</a></h4>
                            <div class="text">{{ __('about.who_we_are.history_text') }}</div>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">{{ __('about.who_we_are.status_title') }}</a></h4>
                            <div class="text">{{ __('about.who_we_are.status_text') }}</div>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">{{ __('about.who_we_are.ambitions_title') }}</a></h4>
                            <div class="text">{{ __('about.who_we_are.ambitions_text') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section-->

    <!-- Approche Section -->
    <section class="why-choose-us-four pt-0">
        <div class="container">
            <div class="inner-container">
                <figure class="image reveal"><img src="{{ asset('images/recherche.jpg') }}" alt=""></figure>
                <div class="row">
                    <div class="col-xl-6 offset-xl-6">
                        <div class="content-box">
                            <div class="sec-title-style-three">
                                {{-- <h6 class="sub-title">// Notre Approche //</h6> --}}
                                <h2 class="title text-reveal-anim">{{ __('about.approach.title') }}</h2>
                                <div class="text">{{ __('about.approach.subtitle') }}</div>
                            </div>
                            <a href="{{ route('contact') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">{{ __('navigation.actions.contact_us') }}</span> <i
                                    class="icon fa-light fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-10 offset-xxl-2">
                        <div class="row g-0">
                            <div class="feature-block col-lg-4 col-md-6">
                                <div class="inner-block">
                                    <div>
                                        <div class="number">01</div>
                                        <h4 class="title"><a href="#">{{ __('about.approach.pillar_1_title') }}</a></h4>
                                        <div class="text">{{ __('about.approach.pillar_1_text') }}
                                        </div>
                                    </div>
                                    <div class="pricing-block mt-4">
                                        <div class="inner-block active">
                                            <div class="content-column">
                                                <h4 class="pricing-title">{{ __('about.approach.pillar_1_expected') }}</h4>
                                                <div class="text">{{ __('about.approach.pillar_1_result') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feature-block col-lg-4 col-md-6">
                                <div class="inner-block">
                                    <div>
                                        <div class="number">02</div>
                                        <h4 class="title"><a href="#">{{ __('about.approach.pillar_2_title') }}</a></h4>
                                        <div class="text">{{ __('about.approach.pillar_2_text') }}
                                        </div>
                                    </div>
                                    <div class="pricing-block mt-4">
                                        <div class="inner-block active">
                                            <div class="content-column">
                                                <h4 class="pricing-title">{{ __('about.approach.pillar_2_expected') }}</h4>
                                                <div class="text">{{ __('about.approach.pillar_2_result') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feature-block col-lg-4 col-md-6">
                                <div class="inner-block">
                                    <div>
                                        <div class="number">03</div>
                                        <h4 class="title"><a href="#">{{ __('about.approach.pillar_3_title') }}</a></h4>
                                        <div class="text">{{ __('about.approach.pillar_3_text') }}
                                        </div>
                                    </div>
                                    <div class="pricing-block mt-4">
                                        <div class="inner-block active">
                                            <div class="content-column">
                                                <h4 class="pricing-title">{{ __('about.approach.pillar_3_expected') }}</h4>
                                                <div class="text">{{ __('about.approach.pillar_3_result') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Approche Section-->

    <!-- Values Section -->
    <section class="work-section pt-0 pb-0">
        <div class="large-container">
            <div class="inner-container">
                <div class="sec-title-box">
                    <div class="sec-title-style-three">
                        {{-- <h6 class="sub-title">// Nos Valeurs //</h6> --}}
                        <h2 class="title text-reveal-anim">{{ __('about.values.title') }}</h2>
                    </div>
                    <div class="sec-right-box">
                        <div class="text">{{ __('about.values.intro') }}
                        </div>
                    </div>
                </div>
                <div class="row g-24">
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">01</div>
                            <h4 class="title"><a href="{{ route('recherche-expertize-projet') }}">{{ __('about.values.val_1_title') }}</a></h4>
                            <div class="text">
                                {{ __('about.values.val_1_text') }}
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">02</div>
                            <h4 class="title"><a href="{{ route('recherche-expertize-projet') }}">{{ __('about.values.val_2_title') }}</a></h4>
                            <div class="text">
                                {{ __('about.values.val_2_text') }}
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">03</div>
                            <h4 class="title"><a href="{{ route('recherche-expertize-projet') }}">{{ __('about.values.val_3_title') }}</a></h4>
                            <div class="text">
                                {{ __('about.values.val_3_text') }}
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">04</div>
                            <h4 class="title"><a href="{{ route('recherche-expertize-projet') }}">{{ __('about.values.val_4_title') }}</a></h4>
                            <div class="text">
                                {{ __('about.values.val_4_text') }}
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">05</div>
                            <h4 class="title"><a href="{{ route('recherche-expertize-projet') }}">{{ __('about.values.val_5_title') }}</a></h4>
                            <div class="text">
                                {{ __('about.values.val_5_text') }}
                            </div>
                        </div>
                    </div>
                    <div class="work-block col-xxl-3 col-xl-4 col-md-6">
                        <div class="inner-block mb-20">
                            <div class="number">06</div>
                            <h4 class="title"><a href="{{ route('recherche-expertize-projet') }}">{{ __('about.values.val_6_title') }}</a></h4>
                            <div class="text">
                                {{ __('about.values.val_6_text') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Values Section-->

    <!-- Team Section -->
    <section class="teams-section">
        <div class="auto-container">
            <div class="sec-title-box">
                <div class="sec-title-style-three">
                    {{-- <h6 class="sub-title">// Nos Membres //</h6> --}}
                    <h2 class="title text-reveal-anim">{!! __('about.governance.title') !!}</h2>
                </div>
                <div class="sec-right-box">
                    <div class="text">
                        {{ __('about.governance.description') }}
                    </div>
                    <a href="{{ route('equipe') }}" class="theme-btn btn-style-one">
                        <span class="btn-title">{{ __('navigation.actions.view_more') }}</span>
                        <span class="icon">
                            <i class="fa-light fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($members as $member)
                    <div class="team-block col-xl-3 col-md-6 col-sm-12">
                        <div class="inner-block">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('team-detail', ['slug' => $member['slug']]) }}">
                                        <img src="{{ asset('images/equipes/' . $member['imageName']) }}"
                                            alt="{{ $member['fullName'] }}">
                                    </a>
                                </figure>
                            </div>
                            <div class="info-box">
                                <h5 class="name">
                                    <a
                                        href="{{ route('team-detail', ['slug' => $member['slug']]) }}">{{ $member['fullName'] }}</a>
                                </h5>
                                <div class="designation">{{ $member['roleTitle'] }}</div>
                                <p class="mt-3">
                                    {{ $member['bioShort'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Team Section-->

    <!-- Partenaires Section -->
    <section class="clients-section home-3 pt-0">
        <div class="outer-container">
            <div class="inner-container" style="background-image: url(archinest/images/background/bg-claint1-1.jpg);">
                <div class="outer-box">
                    <div class="sec-title-style-three text-center">
                        {{-- <h6 class="sub-title">// Nos Partenaires //</h6> --}}
                        <h2 class="title text-reveal-anim">{{ __('about.collaboration.title') }}</h2>
                    </div>
                    <div class="partenaire-content">
                        {{ __('about.collaboration.paragraph_1') }}
                    </div>
                    <div class="mt-4 partenaire-content">
                        {{ __('about.collaboration.paragraph_2') }}
                    </div>
                    <div class="claint-outer">
                        <div>
                            <a href="{{ route('recherche-expertize-projet') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">{{ __('navigation.actions.discover_works') }}</span>
                                <span class="icon">
                                    <i class="fa-light fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('recherche-expertize-projet') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">{{ __('navigation.actions.become_partner') }}</span>
                                <span class="icon">
                                    <i class="fa-light fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Partenaires Section-->

    <!-- Features Section -->
    <section class="features-section-two">
        <div class="auto-container">
            <div class="inner-container position-relative">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="sec-title-style-three">
                            {{-- <h6 class="sub-title">// Stats //</h6> --}}
                            <h2 class="title text-reveal-anim">{{ __('about.in_brief.title') }}</h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="feature-block-two">
                            <div class="inner-box">
                                <div class="number">#01</div>
                                <div class="content">
                                    <h4 class="title">{{ __('about.in_brief.item_1_title') }}</h4>
                                    <div class="text">{{ __('about.in_brief.item_1_text') }}</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box active">
                                <div class="number">#02</div>
                                <div class="content">
                                    <h4 class="title">{{ __('about.in_brief.item_2_title') }}</h4>
                                    <div class="text">{{ __('about.in_brief.item_2_text') }}</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box">
                                <div class="number">#03</div>
                                <div class="content">
                                    <h4 class="title">{{ __('about.in_brief.item_3_title') }}</h4>
                                    <div class="text">{{ __('about.in_brief.item_3_text') }}</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box mb-0">
                                <div class="number">#04</div>
                                <div class="content">
                                    <h4 class="title">{{ __('about.in_brief.item_4_title') }}</h4>
                                    <div class="text">{{ __('about.in_brief.item_4_text') }}</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="feature-block-two">
                            <div class="inner-box mb-0">
                                <div class="number">#05</div>
                                <div class="content">
                                    <h4 class="title">{{ __('about.in_brief.item_5_title') }}</h4>
                                    <div class="text">{{ __('about.in_brief.item_5_text') }}</div>
                                </div>
                                <figure class="image mb-0">
                                    <img src="{{ asset('images/cta-1.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features Section -->

</div>