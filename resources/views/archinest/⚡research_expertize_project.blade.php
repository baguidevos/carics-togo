<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::archinest')] class extends Component {
    //
};
?>

<div>
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ asset('images/banner.jpg') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">{{ __('research.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">{{ __('navigation.menu.home') }}</a></li>
                    <li>{{ __('research.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

    <!-- Expertise Six -->
    <section class="faq-section-home-two">
        <div class="auto-container">
            <div class="sec-title-box gap-4 gap-xl-0">
                <div class="sec-title-style-three">
                    {{-- <h6 class="sub-title">// // Expertise //</h6> --}}
                    <h2 class="title text-reveal-anim">{{ __('research.header.title') }}</h2>
                </div>
                <div class="sec-right-box">
                    <div class="text">
                        {{ __('research.header.intro') }}
                    </div>
                    <a href="{{ route('contact') }}" class="theme-btn btn-style-one">
                        <span class="btn-title">{{ __('navigation.actions.learn_more') }}</span>
                        <span class="icon"><i class="fa-light fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
            <div class="row clearfix">
                <!-- Column -->
                <div class="image-column col-xl-4 col-lg-4">
                    <figure class="image reveal">
                        <img src="{{ asset('archinest/images/resource/faq-h2-1.jpg') }}" alt="">
                    </figure>
                </div>

                <!-- Column -->
                <div class="column col-xl-7 col-lg-8 offset-xl-1">
                    <!-- Accordion Box / Style Three -->
                    <ul class="accordion-box">

                        <!-- Block -->
                        <li class="accordion block active-block">
                            <div class="acc-btn active">
                                {{ __('research.domains.item_1_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content current">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_1_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Block -->
                        <li class="accordion block active-block">
                            <div class="acc-btn active">
                                {{ __('research.domains.item_2_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_2_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_3_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_3_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_4_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_4_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_5_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_5_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.item_6_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.item_6_text') }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Block -->
                        <li class="accordion block">
                            <div class="acc-btn">
                                {{ __('research.domains.priorities_title') }}
                                <div class="icon"><img src="{{ asset('archinest/images/icons/faq-h2-1.svg') }}" alt=""></div>
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">
                                        {{ __('research.domains.priorities_intro') }}
                                        <ul>
                                            <li>• {{ __('research.domains.priority_1') }}</li>
                                            <li>• {{ __('research.domains.priority_2') }}</li>
                                            <li>• {{ __('research.domains.priority_3') }}</li>
                                            <li>• {{ __('research.domains.priority_4') }}</li>
                                            <li>• {{ __('research.domains.priority_5') }}</li>
                                            <li>• {{ __('research.domains.priority_6') }}</li>
                                            <li>• {{ __('research.domains.priority_7') }}</li>
                                            <li>• {{ __('research.domains.priority_8') }}</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Expertise Six -->
    <!-- Projet phare Section -->
    <section class="project-details pt-120 pb-70">
        <div class="auto-container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 mb-5 mb-lg-0">
                    <div class="sec-title-style-three">
                        {{-- <h6 class="sub-title">// Projets //</h6> --}}
                        <h2 class="title text-reveal-anim wow fadeInUp" data-wow-delay=".3s">
                            {{ __('research.featured_project.section_title') }}
                        </h2>
                        <p class="text wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                            {{ __('research.featured_project.project_title') }}
                        </p>
                    </div>
                    <a href="{{ route('recherche-expertize-projet') }}" class="theme-btn btn-style-one">
                        <span class="btn-title">{{ __('navigation.actions.other_projects') }}</span> <i class="icon fa-light fa-arrow-right"></i>
                    </a>

                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-7">
                    <div class="project-details__content-right mt-0">
                        <div class="project-details__details-box rounded-0">
                            <ul class="list-unstyled project-details__details-list">
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.period_label') }}</h4>
                                    <p class="project-details__client">{{ __('research.featured_project.period_value') }}</p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.zone_label') }}</h4>
                                    <p class="project-details__client">{{ __('research.featured_project.zone_value') }}</p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.funding_label') }}</h4>
                                    <p class="project-details__client">{{ __('research.featured_project.funding_value') }}</p>
                                </li>
                                <li>
                                    <h4 class="project-details__name mb-2">{{ __('research.featured_project.status_label') }}</h4>
                                    <p class="project-details__client">{{ __('research.featured_project.status_value') }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5 mb-lg-0">
                <div class="">
                    <div class="project-details__top mt-5">
                        <div class="project-details__img"> <img class="rounded-0"
                                src="{{ asset('archinest/images/resource/project-details-2.jpg') }}" alt=""> </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-lg-center">
                <div class="col-lg-6">
                    <div class="sec-title mb-40">
                        <h2 class="title mb-30 wow splt-txt" data-splitting="">
                            {{ __('research.featured_project.context_title') }}
                        </h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="project-details__top mt-lg-5">
                        <div class="text mb-40">
                            {{ __('research.featured_project.context_text') }}
                        </div>

                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5 mb-lg-0">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="sec-title mb-40">
                        <h2 class="title mb-30 wow splt-txt" data-splitting="">{{ __('research.featured_project.details_title') }}</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="project-details__top mt-lg-5">
                        <div class="project-list-item mb-5">
                            <h5 class="title">
                                <i class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>
                                {{ __('research.featured_project.objective_title') }}
                            </h5>
                            <div class="text">
                                {{ __('research.featured_project.objective_text') }}
                            </div>
                        </div>
                        <div class="project-list-item mb-5">
                            <h5 class="title"><i class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>
                                {{ __('research.featured_project.results_title') }}</h5>
                            <div class="text">
                                <ul>

                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_1') }}</li>
                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_2') }}</li>
                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_3') }}</li>
                                    <li class="d-flex align-items-center"><i
                                            class="icon fa-classic fa-solid fa-check fa-fw"></i>{{ __('research.featured_project.result_4') }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="project-list-item">
                            <h5 class="title"><i
                                    class="icon fa-classic fa-solid fa-circle-check fa-fw mr-15"></i>{{ __('research.featured_project.perspectives_title') }}</h5>
                            <div class="text">
                                {{ __('research.featured_project.perspectives_text') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Projet phare Section -->



</div>