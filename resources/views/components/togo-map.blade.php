@props(['projects' => []])

@php
    // Grouper les projets par région
    $regionCounts = [
        'Maritime' => 0,
        'Plateaux' => 0,
        'Centrale' => 0,
        'Kara'     => 0,
        'Savanes'  => 0,
    ];

    $regionProjects = [
        'Maritime' => [],
        'Plateaux' => [],
        'Centrale' => [],
        'Kara'     => [],
        'Savanes'  => [],
    ];

    foreach ($projects as $project) {
        $reg = $project->region;
        foreach ($regionCounts as $key => $val) {
            if ($reg && stripos($reg, $key) !== false) {
                $regionCounts[$key]++;
                $regionProjects[$key][] = $project->title;
            }
        }
    }
@endphp

<div 
    x-data="{
        activeRegion: 'Maritime',
        regionData: {
            'Savanes': {
                name: @js(__('research.map.savanes_name')),
                chefLieu: 'Dapaong',
                projectsCount: {{ $regionCounts['Savanes'] }},
                description: @js(__('research.map.savanes_desc'))
            },
            'Kara': {
                name: @js(__('research.map.kara_name')),
                chefLieu: 'Kara',
                projectsCount: {{ $regionCounts['Kara'] }},
                description: @js(__('research.map.kara_desc'))
            },
            'Centrale': {
                name: @js(__('research.map.centrale_name')),
                chefLieu: 'Sokodé',
                projectsCount: {{ $regionCounts['Centrale'] }},
                description: @js(__('research.map.centrale_desc'))
            },
            'Plateaux': {
                name: @js(__('research.map.plateaux_name')),
                chefLieu: 'Atakpamé / Kpalimé',
                projectsCount: {{ $regionCounts['Plateaux'] }},
                description: @js(__('research.map.plateaux_desc'))
            },
            'Maritime': {
                name: @js(__('research.map.maritime_name')),
                chefLieu: 'Lomé',
                projectsCount: {{ $regionCounts['Maritime'] }},
                description: @js(__('research.map.maritime_desc'))
            }
        }
    }"
    class="card border-0 shadow-lg rounded-4 overflow-hidden p-4 p-lg-5"
    style="background: linear-gradient(145deg, #ffffff 0%, #f4f8fc 100%);"
>
    <div class="row align-items-center g-4">
        <!-- SVG Map Container -->
        <div class="col-lg-5 text-center">
            <div class="position-relative d-inline-block">
                <svg viewBox="0 0 280 500" class="togo-map-svg" style="max-height: 420px; width: auto; filter: drop-shadow(0 10px 15px rgba(27, 58, 107, 0.15));">
                    <defs>
                        <linearGradient id="gradMaritime" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#008A5E" />
                            <stop offset="100%" stop-color="#1B3A6B" />
                        </linearGradient>
                        <linearGradient id="gradHover" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#22c55e" />
                            <stop offset="100%" stop-color="#15803d" />
                        </linearGradient>
                    </defs>

                    <!-- Savanes (Nord) -->
                    <path 
                        d="M60,20 L220,15 L230,75 L180,105 L80,95 L50,60 Z" 
                        :fill="activeRegion === 'Savanes' ? '#1B3A6B' : '#93c5fd'"
                        :stroke="activeRegion === 'Savanes' ? '#ffffff' : '#ffffff'"
                        stroke-width="2"
                        @click="activeRegion = 'Savanes'"
                        @mouseenter="activeRegion = 'Savanes'"
                        class="region-path cursor-pointer transition-all"
                        style="transition: all 0.3s ease;"
                    >
                        <title>{{ __('research.map.savanes_name') }}</title>
                    </path>
                    <text x="140" y="55" text-anchor="middle" fill="#ffffff" font-size="11" font-weight="bold" pointer-events="none">SAVANES</text>

                    <!-- Kara (Nord-Centre) -->
                    <path 
                        d="M80,95 L180,105 L210,165 L170,195 L95,185 L65,135 Z" 
                        :fill="activeRegion === 'Kara' ? '#1B3A6B' : '#60a5fa'"
                        :stroke="activeRegion === 'Kara' ? '#ffffff' : '#ffffff'"
                        stroke-width="2"
                        @click="activeRegion = 'Kara'"
                        @mouseenter="activeRegion = 'Kara'"
                        class="region-path cursor-pointer transition-all"
                        style="transition: all 0.3s ease;"
                    >
                        <title>{{ __('research.map.kara_name') }}</title>
                    </path>
                    <text x="135" y="145" text-anchor="middle" fill="#ffffff" font-size="11" font-weight="bold" pointer-events="none">KARA</text>

                    <!-- Centrale (Centre) -->
                    <path 
                        d="M95,185 L170,195 L200,270 L140,290 L75,275 L80,215 Z" 
                        :fill="activeRegion === 'Centrale' ? '#1B3A6B' : '#3b82f6'"
                        :stroke="activeRegion === 'Centrale' ? '#ffffff' : '#ffffff'"
                        stroke-width="2"
                        @click="activeRegion = 'Centrale'"
                        @mouseenter="activeRegion = 'Centrale'"
                        class="region-path cursor-pointer transition-all"
                        style="transition: all 0.3s ease;"
                    >
                        <title>{{ __('research.map.centrale_name') }}</title>
                    </path>
                    <text x="135" y="235" text-anchor="middle" fill="#ffffff" font-size="11" font-weight="bold" pointer-events="none">CENTRALE</text>

                    <!-- Plateaux (Sud-Centre) -->
                    <path 
                        d="M75,275 L140,290 L195,330 L180,410 L90,400 L50,335 Z" 
                        :fill="activeRegion === 'Plateaux' ? '#1B3A6B' : '#2563eb'"
                        :stroke="activeRegion === 'Plateaux' ? '#ffffff' : '#ffffff'"
                        stroke-width="2"
                        @click="activeRegion = 'Plateaux'"
                        @mouseenter="activeRegion = 'Plateaux'"
                        class="region-path cursor-pointer transition-all"
                        style="transition: all 0.3s ease;"
                    >
                        <title>{{ __('research.map.plateaux_name') }}</title>
                    </path>
                    <text x="125" y="345" text-anchor="middle" fill="#ffffff" font-size="11" font-weight="bold" pointer-events="none">PLATEAUX</text>

                    <!-- Maritime & Lomé (Sud) -->
                    <path 
                        d="M90,400 L180,410 L195,475 L120,490 L85,465 Z" 
                        :fill="activeRegion === 'Maritime' ? '#1B3A6B' : '#1d4ed8'"
                        :stroke="activeRegion === 'Maritime' ? '#ffffff' : '#ffffff'"
                        stroke-width="2"
                        @click="activeRegion = 'Maritime'"
                        @mouseenter="activeRegion = 'Maritime'"
                        class="region-path cursor-pointer transition-all"
                        style="transition: all 0.3s ease;"
                    >
                        <title>{{ __('research.map.maritime_name') }}</title>
                    </path>
                    <text x="135" y="445" text-anchor="middle" fill="#ffffff" font-size="11" font-weight="bold" pointer-events="none">MARITIME</text>
                    
                    <!-- Point Capitale Lomé -->
                    <circle cx="125" cy="480" r="5" fill="#f59e0b" stroke="#ffffff" stroke-width="2" />
                    <text x="140" y="484" fill="#1B3A6B" font-size="9" font-weight="bold">{{ __('research.map.hq_city') }}</text>
                </svg>
            </div>
            <p class="text-muted small mt-2">
                <i class="fa fa-solid fa-hand-pointer text-primary me-1"></i> {{ __('research.map.instruction') }}
            </p>
        </div>

        <!-- Region Details Panel -->
        <div class="col-lg-7">
            <div class="p-4 bg-white rounded-4 border shadow-sm">
                <!-- En-tête Région -->
                <div class="d-flex justify-content-between align-items-start mb-3 border-bottom pb-3">
                    <div>
                        <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1 rounded-pill mb-1">
                            {{ __('research.map.zone_badge') }}
                        </span>
                        <h3 class="h4 fw-bold text-dark mb-0" x-text="regionData[activeRegion].name"></h3>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success-subtle text-success fs-6 px-3 py-2 rounded-pill">
                            <i class="fa fa-solid fa-microscope me-1"></i>
                            <strong x-text="regionData[activeRegion].projectsCount"></strong> {{ __('research.map.projects_count') }}
                        </span>
                    </div>
                </div>

                <!-- Chef lieu -->
                <p class="text-muted small mb-3">
                    <i class="fa fa-solid fa-location-dot text-danger me-1"></i>
                    {{ __('research.map.regional_hub') }} <strong class="text-dark" x-text="regionData[activeRegion].chefLieu"></strong>
                </p>

                <!-- Description -->
                <div class="p-3 bg-light rounded-3 mb-4">
                    <p class="text-secondary small mb-0" style="line-height: 1.6;" x-text="regionData[activeRegion].description"></p>
                </div>

                <!-- Boutons Sélecteurs rapides de Régions -->
                <div class="d-flex flex-wrap gap-2">
                    <template x-for="(data, key) in regionData" :key="key">
                        <button 
                            type="button" 
                            @click="activeRegion = key" 
                            class="btn btn-sm rounded-pill px-3 transition-all"
                            :class="activeRegion === key ? 'btn-primary shadow-sm' : 'btn-outline-secondary bg-white'"
                            x-text="key"
                        ></button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
