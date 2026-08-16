<?php

use App\Models\News;
use App\Models\Partner;
use App\Models\Publication;
use App\Models\ResearchProject;
use App\Models\TeamMember;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::archinest')] class extends Component {
    public function with(): array
    {
        return [
            'members'          => TeamMember::published()->with('media')->ordered()->take(4)->get(),
            'partners'         => Partner::active()->ordered()->get(),
            'latestNews'       => News::published()->with(['category', 'media'])->recent()->take(3)->get(),
            'featuredProject'  => ResearchProject::published()->with(['partners', 'media'])->featured()->first() ?? ResearchProject::published()->first(),
            'statsProjects'    => ResearchProject::published()->count(),
            'statsMembers'     => TeamMember::published()->count(),
            'statsPublications'=> Publication::published()->count(),
            'statsPartners'    => Partner::active()->count(),
        ];
    }
};
?>

<div>


    <!-- Banner Section Three-->
    <x-archinest.hero />
    <!--End Banner Section Three -->

    <!-- Services Section -->
    <section class="services-section-five">
        <div class="auto-container">
            <div class="outer-box">
                <div class="row gap-2 justify-content-center">
                    <!-- Service Block -->

                    <x-archinest.service_block :titre="__('home.mission.title')"
                        :description="__('home.mission.description')">
                        <svg width="42" height="42" viewbox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.70485 20.5791C4.56394 20.5791 4.4288 20.6351 4.32916 20.7347C4.22952 20.8344 4.17354 20.9695 4.17354 21.1104V37.5695C3.0881 37.57 2.20528 38.453 2.20528 39.5385C2.20528 40.6241 3.08851 41.5073 4.17436 41.5073H37.8259C38.9112 41.5073 39.7945 40.6241 39.7945 39.5385C39.7945 38.4527 38.9113 37.5694 37.8259 37.5694H37.8226V21.1062C37.8226 20.8128 37.5848 20.5749 37.2913 20.5749C36.9978 20.5749 36.76 20.8127 36.76 21.1062V37.5694H5.23609V21.1104C5.2361 21.0406 5.22237 20.9716 5.19567 20.9071C5.16898 20.8426 5.12985 20.7841 5.08052 20.7347C5.03119 20.6854 4.97263 20.6462 4.90817 20.6195C4.84371 20.5928 4.77462 20.5791 4.70485 20.5791ZM38.7319 39.5385C38.7319 40.0382 38.3255 40.4448 37.8258 40.4448H4.17436C3.67462 40.4448 3.26783 40.0382 3.26783 39.5385C3.26783 39.0385 3.67462 38.632 4.17436 38.632H37.8259C38.3256 38.632 38.7319 39.0386 38.7319 39.5385ZM40.0634 14.6106L37.8225 13.3341V2.26931C37.8225 1.28953 37.0256 0.492676 36.046 0.492676H32.4715C31.4895 0.492676 30.6905 1.28961 30.6905 2.26931V9.27158L23.3036 5.06395C21.8833 4.25496 20.1172 4.25479 18.696 5.0642L1.93679 14.6106C0.619781 15.361 0.158273 17.0437 0.908695 18.3611C1.66117 19.6817 3.33813 20.1414 4.65916 19.3894L21.0001 10.0812L37.3411 19.3894C38.6741 20.1487 40.3462 19.6693 41.0915 18.3611C41.842 17.0436 41.3805 15.361 40.0634 14.6106ZM31.7531 2.26931C31.7531 1.87564 32.0756 1.55523 32.4715 1.55523H36.046C36.4395 1.55523 36.76 1.87564 36.76 2.26931V12.7288L31.7531 9.87681V2.26931ZM40.1684 17.8351C39.7066 18.6451 38.6777 18.9281 37.8674 18.4662L21.2633 9.00826C21.1831 8.96257 21.0924 8.93855 21.0001 8.93855C20.9078 8.93855 20.8171 8.96257 20.737 9.00826L4.13285 18.4663C3.32279 18.928 2.29387 18.6456 1.83179 17.8352C1.37152 17.0269 1.65452 15.9944 2.4631 15.5337L19.222 5.98746C20.3194 5.36238 21.682 5.36304 22.7778 5.98721L39.5371 15.5336C40.3457 15.9944 40.6288 17.0268 40.1684 17.8351Z"
                                fill="#111111"></path>
                            <path
                                d="M20.9962 33.3682H21.0154C21.401 33.3682 26.0139 33.3049 28.9501 30.3729C31.0698 28.2486 31.6887 25.2127 31.8692 23.5894C31.9166 23.1436 31.763 22.7065 31.4471 22.3906C31.1308 22.0746 30.6963 21.9202 30.2447 21.9681C28.9642 22.1107 26.6734 22.5469 24.7182 23.8665C24.2713 21.5662 22.9801 19.654 22.1481 18.6152C22.0108 18.4427 21.8362 18.3034 21.6375 18.2078C21.4388 18.1122 21.221 18.0627 21.0005 18.063H21.0001C20.5514 18.063 20.133 18.264 19.8517 18.6152C19.0197 19.6539 17.7286 21.5661 17.2816 23.8661C15.3265 22.5467 13.0356 22.1107 11.7526 21.9677C11.5338 21.9436 11.3123 21.9692 11.1046 22.0424C10.897 22.1156 10.7085 22.2346 10.5531 22.3906C10.2372 22.7065 10.0836 23.1435 10.1314 23.5918C10.3115 25.2126 10.9303 28.2486 13.0509 30.3737C15.9867 33.3051 20.5996 33.3681 20.9848 33.3681L20.9962 33.3682ZM30.3596 23.0245C30.5323 23.0058 30.6435 23.09 30.6954 23.1417C30.7468 23.1934 30.8307 23.3054 30.8128 23.4743C30.648 24.957 30.089 27.7273 28.1987 29.6216C26.3922 31.4251 23.7808 32.0146 22.2509 32.2087C23.2905 30.8851 24.8775 28.3876 24.8775 25.4743C24.8775 25.3404 24.8702 25.2084 24.8636 25.0762C26.7082 23.6254 29.0823 23.1667 30.3596 23.0245ZM20.6808 19.2796C20.7883 19.1457 20.9269 19.1256 21 19.1256C21.0731 19.1256 21.2117 19.1457 21.3188 19.2794C22.251 20.4435 23.815 22.7963 23.815 25.4744C23.815 28.4705 21.841 31.0761 20.9996 32.0505C20.1575 31.078 18.1846 28.4787 18.1846 25.4744C18.1846 22.7962 19.7486 20.4435 20.6808 19.2796ZM11.1875 23.4769C11.1803 23.4158 11.1871 23.3539 11.2074 23.2958C11.2277 23.2377 11.2609 23.185 11.3046 23.1417C11.3564 23.0903 11.4702 23.0069 11.6375 23.0241C12.9175 23.1667 15.2915 23.6253 17.136 25.0759C17.1294 25.2082 17.1221 25.3404 17.1221 25.4744C17.1221 28.389 18.7107 30.8875 19.7503 32.2107C18.2224 32.0185 15.6132 31.431 13.802 29.6226C11.911 27.7273 11.3519 24.9571 11.1875 23.4769Z"
                                fill="#111111"></path>
                        </svg>
                    </x-archinest.service_block>

                    <x-archinest.service_block :titre="__('home.vision.title')"
                        :description="__('home.vision.description')">
                        <svg width="43" height="43" viewbox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_18402_227)">
                                <path
                                    d="M40.1056 28.599V26.3408C40.1056 24.2349 38.3924 22.5218 36.2867 22.5218H21.6606C21.4972 22.5218 21.3404 22.5867 21.2247 22.7023C21.1091 22.818 21.0442 22.9748 21.0442 23.1383C21.0442 23.3018 21.1091 23.4586 21.2247 23.5742C21.3404 23.6898 21.4972 23.7547 21.6606 23.7547H36.2867C37.7127 23.7547 38.8728 24.9148 38.8728 26.3408V28.599C37.5072 28.8843 36.4783 30.0973 36.4783 31.5462V33.8356H16.782V31.5462C16.782 30.0972 15.7531 28.8843 14.3876 28.5991V26.3408C14.3876 24.9148 15.5478 23.7547 16.9737 23.7547H19.195C19.3584 23.7547 19.5153 23.6898 19.6309 23.5742C19.7465 23.4586 19.8114 23.3018 19.8114 23.1383C19.8114 22.9748 19.7465 22.818 19.6309 22.7023C19.5153 22.5867 19.3584 22.5218 19.195 22.5218H16.9737C14.8679 22.5218 13.1547 24.235 13.1547 26.3408V28.599C11.7893 28.8842 10.7603 30.0972 10.7603 31.5461V40.3257C10.7602 40.4066 10.7762 40.4868 10.8072 40.5616C10.8381 40.6364 10.8835 40.7044 10.9408 40.7616C10.998 40.8189 11.066 40.8643 11.1408 40.8953C11.2156 40.9262 11.2958 40.9422 11.3767 40.9422H30.3901C30.7306 40.9422 31.0066 40.6662 31.0066 40.3257C31.0066 39.9852 30.7306 39.7092 30.3901 39.7092H16.782V35.0684H36.4783V39.7092H32.8558C32.5153 39.7092 32.2393 39.9852 32.2393 40.3257C32.2393 40.6662 32.5153 40.9422 32.8558 40.9422H41.8836C41.9646 40.9422 42.0448 40.9262 42.1196 40.8953C42.1944 40.8643 42.2623 40.8189 42.3196 40.7616C42.3768 40.7044 42.4222 40.6364 42.4532 40.5616C42.4842 40.4868 42.5001 40.4066 42.5001 40.3257V31.5462C42.5 30.0972 41.4711 28.8843 40.1056 28.599ZM11.9931 31.5462C11.9931 30.5659 12.7907 29.7683 13.7711 29.7683C14.7516 29.7683 15.5492 30.5659 15.5492 31.5462V39.7093H11.9931V31.5462ZM41.2672 39.7093H37.7111V31.5462C37.7111 30.5659 38.5087 29.7683 39.4892 29.7683C40.4695 29.7683 41.2671 30.5659 41.2671 31.5462V39.7093H41.2672ZM16.2074 18.1228C16.2375 18.4335 16.5083 18.679 16.8208 18.679H36.4395C36.7747 18.679 37.0559 18.3979 37.0559 18.0626V3.57643C37.0559 3.24108 36.7748 2.95996 36.4395 2.95996H32.8558C32.5153 2.95996 32.2393 3.23591 32.2393 3.57643C32.2393 3.91694 32.5153 4.19289 32.8558 4.19289H34.9513L33.8101 5.33411H19.4502L18.3089 4.19289H30.3899C30.7304 4.19289 31.0064 3.91694 31.0064 3.57643C31.0064 3.23591 30.7304 2.95996 30.3899 2.95996H16.8207C16.4851 2.95996 16.2043 3.24149 16.2043 3.57643V18.0626C16.2043 18.0824 16.2054 18.103 16.2074 18.1228ZM18.3089 17.4462L19.4502 16.3049H33.81L34.9512 17.4462H18.3089ZM33.4489 15.072H27.8482L26.8206 13.9306L30.1532 10.2288C30.3513 10.0086 30.7037 10.0118 30.9011 10.231L33.4489 13.0338V15.072ZM26.1892 15.072H19.8113V14.6223L22.5091 11.6257C22.6617 11.4563 22.9341 11.4562 23.0866 11.6257L26.1892 15.072ZM35.823 5.06472V16.5743L34.6818 15.4331V6.20594L35.823 5.06472ZM33.4489 11.201L31.8154 9.40393C31.1366 8.64998 29.9157 8.64998 29.2369 9.40393L25.9911 13.0092L24.0029 10.8008C23.8508 10.6321 23.6649 10.4971 23.4574 10.4047C23.2498 10.3123 23.0251 10.2644 22.7979 10.2643C22.3421 10.2643 21.8978 10.4621 21.5928 10.8008L19.8113 12.7797V6.56696H33.4489V11.201ZM18.5784 6.20594V15.4331L17.4372 16.5744V5.06472L18.5784 6.20594Z"
                                    fill="#111111"></path>
                                <path
                                    d="M7.44744 37.4881H6.84263V16.1535H8.42599V23.1284C8.42599 23.2919 8.49094 23.4487 8.60655 23.5643C8.72216 23.6799 8.87896 23.7448 9.04246 23.7448C9.20596 23.7448 9.36276 23.6799 9.47837 23.5643C9.59398 23.4487 9.65892 23.2919 9.65892 23.1284V16.1535H11.3362C11.7258 16.1535 12.024 15.7797 11.9372 15.3996L9.77549 5.94415C9.74437 5.80805 9.66797 5.68654 9.5588 5.59951C9.44963 5.51248 9.31415 5.46509 9.17453 5.46509H3.2778C3.13818 5.46509 3.0027 5.51248 2.89352 5.59951C2.78435 5.68654 2.70795 5.80805 2.67683 5.94415L0.515147 15.3996C0.428276 15.7797 0.726542 16.1535 1.11611 16.1535H5.60978V37.488H5.00496C3.49124 37.488 2.25979 38.7195 2.25979 40.2331V40.3257C2.25979 40.4067 2.27573 40.4869 2.30671 40.5617C2.33769 40.6364 2.3831 40.7044 2.44035 40.7616C2.49759 40.8189 2.56555 40.8643 2.64034 40.8953C2.71513 40.9263 2.7953 40.9422 2.87625 40.9422H9.57615C9.65711 40.9422 9.73727 40.9263 9.81207 40.8953C9.88686 40.8643 9.95482 40.8189 10.0121 40.7616C10.0693 40.7044 10.1147 40.6364 10.1457 40.5617C10.1767 40.4869 10.1926 40.4067 10.1926 40.3257V40.2331C10.1925 38.7196 8.96108 37.4881 7.44744 37.4881ZM3.76924 6.69802H8.68316L10.563 14.9207H1.88933L3.76924 6.69802ZM3.58615 39.7094C3.79968 39.1329 4.35503 38.721 5.00488 38.721H7.44736C8.09721 38.721 8.65257 39.1328 8.86609 39.7094H3.58615ZM25.991 10.7214C26.9509 10.7214 27.7318 9.94047 27.7318 8.98062C27.7318 8.02069 26.9509 7.23983 25.991 7.23983C25.0311 7.23983 24.2502 8.02077 24.2502 8.98062C24.2502 9.94047 25.0311 10.7214 25.991 10.7214ZM25.991 8.47268C26.2711 8.47268 26.499 8.70056 26.499 8.98062C26.499 9.26067 26.2711 9.48856 25.991 9.48856C25.711 9.48856 25.4831 9.26067 25.4831 8.98062C25.4832 8.84595 25.5368 8.71684 25.632 8.62162C25.7272 8.5264 25.8564 8.47283 25.991 8.47268Z"
                                    fill="#111111"></path>
                            </g>
                        </svg>
                    </x-archinest.service_block>


                    <!-- Service Block -->

                    <!-- Service Block -->

                </div>
            </div>
        </div>
    </section>
    <!-- End Services Section-->

    <!-- Intervention Section -->
    <section class="funfact-section-three">
        <div class="container">
            <div class="sec-title-style-two  col-lg-12">
                {{-- <h6 class="sub-title">// Nos interventions //</h6> --}}
                <h2 class="title text-reveal-anim">{{ __('home.interventions.title') }}</h2>
            </div>
            <div class="row justify-content-between">
                <div class="col-xxl-5 col-xl-5 h-auto">
                    <div class="images-box">
                        <figure class="image reveal"><img src="{{ asset('images/hero.jpg') }}" alt=""></figure>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 ">
                    <div class="counter-column-three">
                        <div class="inner-column">
                            <div class="content-box">
                                <div class="text text-reveal-anim">{{ __('home.interventions.subtitle') }}
                                </div>
                            </div>
                            <div class="row gx-2">
                                <x-archinest.counter_card number="01" :title="__('home.interventions.item_1')">
                                    <br>

                                </x-archinest.counter_card>
                                <x-archinest.counter_card number="02"
                                    :title="__('home.interventions.item_2')">
                                </x-archinest.counter_card>
                                <x-archinest.counter_card number="03" :title="__('home.interventions.item_3')">
                                    <br>
                                </x-archinest.counter_card>
                                <x-archinest.counter_card number="04"
                                    :title="__('home.interventions.item_4')">
                                </x-archinest.counter_card>
                                <x-archinest.counter_card number="05" :title="__('home.interventions.item_5')">
                                </x-archinest.counter_card>
                                <x-archinest.counter_card number="06"
                                    :title="__('home.interventions.item_6')">
                                </x-archinest.counter_card>

                            </div>
                            <!-- Counter block-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Emd Intervention Section -->


    <!-- Projet Phare Section -->
    <section class="about-section-home-three">
        <div class="auto-container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="sec-title-style-three">
                        {{-- <h6 class="sub-title">// Projet phare //</h6> --}}
                        <h2 class="title text-reveal-anim">{{ __('home.featured_project.section_title') }}</h2>
                    </div>
                    <div class="container">
                        <div class="row">

                            <div class="">
                                <div class="pricing-block-two">
                                    <div class="d-flex gap-4 align-items-center flex-wrap mb-2 p-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <span><i class="fa fa-calendar"></i></span>
                                            <span>{{ __('home.featured_project.period_label') }}: {{ __('home.featured_project.period_value') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span><i class="fa fa-location-arrow"></i></span>
                                            <span>{{ __('home.featured_project.zone_label') }}: {{ __('home.featured_project.zone_value') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span><i class="fa fa-info-circle"></i></span>
                                            <span>{{ __('home.featured_project.status_label') }}: <span class="text-theme badge bg-success">{{ __('home.featured_project.status_ongoing') }}</span></span>
                                        </div>


                                    </div>
                                    <div class="inner-block">
                                        <div class="feature-box">
                                            <h3 class="pricing-title mb-3 h4">{{ __('home.featured_project.title') }}</h3>
                                            <p>
                                                {{ __('home.featured_project.description') }}
                                            </p>
                                            <a class="btn-style-four theme-btn" href="{{ route('recherche-expertize-projet') }}"><span>{{ __('navigation.actions.learn_more') }}
                                                </span></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 d-none d-xl-block">
                    <figure class="image reveal">
                        <img src="{{ asset('archinest/images/resource/about-4.jpg') }}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- End Projet Phare Section-->


    <!-- Chiffres clés Section-->
    <section class="funfact-section pt-0">
        <div class="large-container">
            <h1>{{ __('home.stats.section_title') }}</h1>
            <div class="inner-container" style="background-image: url({{ asset('archinest/images/background/fun-fact1-1.jpg') }});">
                <div class="fact-counter">
                    <div class="row justify-content-between">
                        <!-- Counter block Projets -->
                        <div class="col-lg-3 col-md-6 col-sm-12 counter-clomun">
                            <div class="counter-block wow zoomIn">
                                <div class="inner">
                                    <div class="border-style"></div>
                                    <div class="border-style2"></div>
                                    <div class="count-box">
                                        <span class="count-text" data-speed="2500" data-stop="{{ max(1, $statsProjects) }}">{{ max(1, $statsProjects) }}</span>
                                    </div>
                                    <h5 class="counter-title">{{ __('home.stats.funded_projects') }}</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Counter block Publications -->
                        <div class="col-lg-3 col-md-6 col-sm-12 counter-clomun">
                            <div class="counter-block wow zoomIn" data-wow-delay="300ms">
                                <div class="inner">
                                    <div class="border-style"></div>
                                    <div class="border-style2"></div>
                                    <div class="count-box style-two">
                                        <span class="count-text" data-speed="2500" data-stop="{{ max(5, $statsPublications) }}">{{ max(5, $statsPublications) }}</span>+
                                    </div>
                                    <h5 class="counter-title">Publications & Rapports</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Counter block Régions -->
                        <div class="col-lg-3 col-md-6 col-sm-12 counter-clomun">
                            <div class="counter-block wow zoomIn" data-wow-delay="600ms">
                                <div class="inner">
                                    <div class="border-style"></div>
                                    <div class="border-style2"></div>
                                    <div class="count-box">
                                        <span class="count-text" data-speed="2500" data-stop="5">5</span>
                                    </div>
                                    <h5 class="counter-title">{{ __('home.stats.intervention_regions') }} (Togo)</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Counter block Chercheurs & Experts -->
                        <div class="col-lg-3 col-md-6 col-sm-12 counter-clomun">
                            <div class="counter-block wow zoomIn" data-wow-delay="900ms">
                                <div class="inner mr-0">
                                    <div class="border-style"></div>
                                    <div class="border-style2"></div>
                                    <div class="count-box style-two">
                                        <span class="count-text" data-speed="2500" data-stop="{{ max(4, $statsMembers) }}">{{ max(4, $statsMembers) }}</span>
                                    </div>
                                    <h5 class="counter-title">Experts & Chercheurs</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Chiffres clés Section-->

    <!-- Team Section -->
    <section class="section py-5 bg-bg-alt">
        <div class="container">
            <div class="sec-title-style-three text-center mb-5">
                {{-- <h6 class="sub-title">// Notre Leadership //</h6> --}}
                <h2 class="title text-reveal-anim">{{ __('home.leadership.title') }}</h2>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ($members as $member)
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('team-detail', ['slug' => $member['slug']]) }}"
                            class="text-decoration-none text-reset d-block h-100">
                            <div class="team-card h-100">
                                <div class="team-photo">
                                    <img src="{{ asset('images/equipes/' . $member['imageName']) }}"
                                        alt="{{ $member['fullName'] }}">
                                </div>
                                <div class="team-body">
                                    <h3 class="h6 mb-1">{{ $member['fullName'] }}</h3>
                                    <div class="team-role">{{ $member['roleTitle'] }}</div>
                                    <p class="team-excerpt">
                                        {{ $member['bioShort'] }}
                                    </p>
                                    <div class="team-link">{{ __('navigation.actions.view_profile') }} <i class="fa-solid fa-arrow-right ms-1"></i></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partenaires Section -->
    <section class="clients-section home-3 pt-0">
        <div class="outer-container">
            <div class="inner-container" style="background-image: url(archinest/images/background/bg-claint1-1.jpg);">
                <div class="outer-box">
                    <div class="sec-title-style-three text-center">
                        {{-- <h6 class="sub-title">// Nos Partenaires //</h6> --}}
                        <h2 class="title text-reveal-anim">{{ __('home.work_together.title') }}</h2>
                    </div>
                    <p class="partenaire-content">
                        {{ __('home.work_together.description') }}
                    </p>
                    @if ($partners->isNotEmpty())
                        <div class="d-flex flex-wrap justify-content-center gap-3 my-4">
                            @foreach ($partners as $partner)
                                <div class="px-4 py-2 rounded-pill bg-white text-dark shadow-sm border fw-semibold d-inline-flex align-items-center" style="font-size: 0.9rem; letter-spacing: 0.02em;">
                                    <i class="bi bi-building me-2 text-primary"></i> {{ $partner->name }}
                                </div>
                            @endforeach
                        </div>
                    @endif
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
                            <a href="{{ route('contact') }}" class="theme-btn btn-style-one">
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
    <!-- End Partenaires Section--    <!-- News Section -->
    @if ($latestNews->isNotEmpty())
        <section class="news-section-four py-5">
            <div class="container">
                <div class="sec-title-box mb-4">
                    <div class="sec-title-style-three text-left">
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                            <i class="fa fa-solid fa-newspaper"></i> Actualités Récentes
                        </div>
                        <h2 class="title text-reveal-anim">Dernières nouvelles du terrain & de la recherche</h2>
                    </div>
                    <div class="sec-right-box">
                        <div class="text">
                            Suivez les avancées scientifiques, les ateliers de formation et les interventions communautaires du CARICS.
                        </div>
                        <a href="{{ route('actu-opportunites') }}" class="theme-btn btn-style-one">
                            <span class="btn-title">Toutes les actualités</span>
                            <span class="icon">
                                <i class="fa-light fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row g-4">
                    @foreach ($latestNews as $newsItem)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="card h-100 p-4 border rounded-4 bg-white shadow-sm d-flex flex-column justify-content-between transition-all hover-shadow">
                                <div>
                                    @if ($newsItem->cover_image_url)
                                        <div class="mb-3 rounded-3 overflow-hidden" style="height: 180px; background: #f1f5f9;">
                                            <img src="{{ $newsItem->getCoverImageUrl('thumb') }}" 
                                                 alt="{{ $newsItem->title }}" 
                                                 loading="lazy" 
                                                 decoding="async" 
                                                 class="w-100 h-100 object-fit-cover" 
                                                 style="object-fit: cover;">
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-light text-primary border px-2 py-1 rounded-pill small">
                                            {{ $newsItem->category?->name ?? 'Actualité' }}
                                        </span>
                                        @if ($newsItem->published_date)
                                            <span class="text-muted small">
                                                <i class="fa fa-regular fa-calendar me-1"></i>{{ $newsItem->published_date->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="h5 fw-bold text-dark mb-2" style="line-height: 1.4;">
                                        <a href="{{ route('news-detail', ['slug' => $newsItem->slug]) }}" class="text-dark text-decoration-none hover-primary">
                                            {{ $newsItem->title }}
                                        </a>
                                    </h3>
                                    <p class="text-secondary small mb-3" style="line-height: 1.5;">
                                        {{ Str::limit($newsItem->excerpt, 120) }}
                                    </p>
                                </div>
                                <div class="pt-3 border-top">
                                    <a href="{{ route('news-detail', ['slug' => $newsItem->slug]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Lire l'article <i class="fa fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>


</div>