<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function getKnownSettings(): array
    {
        return [
            'contact' => [
                'label' => '📞 Contact & Coordonnées',
                'keys' => [
                    'phone_1' => ['label' => 'Téléphone Principal', 'type' => 'text', 'placeholder' => '+228 90 12 34 56'],
                    'phone_2' => ['label' => 'Téléphone Secondaire', 'type' => 'text', 'placeholder' => '+228 99 88 77 66'],
                    'email_contact' => ['label' => 'Email Général', 'type' => 'text', 'placeholder' => 'contact@carics-togo.org'],
                    'address' => ['label' => 'Adresse Physique', 'type' => 'textarea', 'placeholder' => 'Dapaong, Commune de Tône 1, Région des Savanes, Togo'],
                    'office_hours' => ['label' => 'Horaires d\'Ouverture', 'type' => 'text', 'placeholder' => 'Lundi – Vendredi : 08h00 – 17h00 (GMT)'],
                ],
            ],
            'social' => [
                'label' => '🌐 Réseaux Sociaux',
                'keys' => [
                    'linkedin_url' => ['label' => 'Page LinkedIn', 'type' => 'text', 'placeholder' => 'https://linkedin.com/company/carics-togo'],
                    'twitter_url' => ['label' => 'Compte X (Twitter)', 'type' => 'text', 'placeholder' => 'https://x.com/carics_togo'],
                    'facebook_url' => ['label' => 'Page Facebook', 'type' => 'text', 'placeholder' => 'https://facebook.com/caricstogo'],
                    'youtube_url' => ['label' => 'Chaîne YouTube', 'type' => 'text', 'placeholder' => 'https://youtube.com/@carics-togo'],
                ],
            ],
            'general' => [
                'label' => '🏢 Général & Organisation',
                'keys' => [
                    'tagline' => ['label' => 'Slogan de l\'organisation', 'type' => 'text', 'placeholder' => 'Recherche – Innovation – Action en Santé Publique'],
                    'mission_text' => ['label' => 'Texte de Mission Court', 'type' => 'textarea', 'placeholder' => 'Générer des données probantes...'],
                    'registration_info' => ['label' => 'Mentions Légales & Enregistrement', 'type' => 'textarea', 'placeholder' => 'Organisation enregistrée à Dapaong...'],
                ],
            ],
            'seo' => [
                'label' => '🔍 Référencement & SEO',
                'keys' => [
                    'meta_title' => ['label' => 'Titre Meta par défaut', 'type' => 'text', 'placeholder' => 'CARICS - Centre Africain de Recherche'],
                    'meta_description' => ['label' => 'Description Meta par défaut', 'type' => 'textarea', 'placeholder' => 'Pôle d\'excellence en recherche et santé publique au Togo...'],
                    'meta_keywords' => ['label' => 'Mots-clés SEO', 'type' => 'text', 'placeholder' => 'santé publique, recherche, togo, épidémiologie, carics'],
                ],
            ],
        ];
    }

    public static function configure(Schema $schema): Schema
    {
        $known = static::getKnownSettings();
        $groupOptions = [];
        $keyOptions = [];
        $keyMap = [];

        foreach ($known as $groupKey => $groupData) {
            $groupOptions[$groupKey] = $groupData['label'];
            foreach ($groupData['keys'] as $k => $info) {
                $keyOptions[$k] = "{$info['label']} ({$k})";
                $keyMap[$k] = [
                    'group' => $groupKey,
                    'label' => $info['label'],
                    'type' => $info['type'],
                ];
            }
        }

        return $schema
            ->components([
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Paramètre du Site')
                            ->columnSpan(['default' => 1, 'lg' => 2])
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Select::make('group')
                                            ->label('Groupe / Catégorie')
                                            ->options($groupOptions)
                                            ->default('general')
                                            ->required()
                                            ->native(false)
                                            ->helperText('Catégorie logique dans laquelle ce paramètre est classé.'),

                                        TextInput::make('key')
                                            ->label('Clé d\'accès (key)')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->datalist(array_keys($keyOptions))
                                            ->placeholder('Ex: phone_1, email_contact, linkedin_url')
                                            ->helperText('Identifiant unique utilisé dans le code (ex: SiteSetting::get(\'phone_1\')).'),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('label')
                                            ->label('Libellé explicite')
                                            ->placeholder('Ex: Téléphone Principal')
                                            ->helperText('Nom convivial affiché dans le tableau de bord.'),

                                        Select::make('type')
                                            ->label('Type de donnée')
                                            ->options([
                                                'text' => 'Texte court',
                                                'textarea' => 'Texte long / Paragraphe',
                                                'email' => 'Adresse Email',
                                                'url' => 'Lien URL',
                                                'number' => 'Nombre',
                                                'boolean' => 'Booléen (Oui / Non)',
                                            ])
                                            ->default('text')
                                            ->required()
                                            ->native(false),
                                    ]),

                                Textarea::make('value')
                                    ->label('Valeur du paramètre')
                                    ->rows(4)
                                    ->placeholder('Entrez la valeur souhaitée pour ce paramètre...')
                                    ->helperText('Valeur enregistrée et affichée sur le site web.'),
                            ]),

                        Grid::make(1)
                            ->columnSpan(['default' => 1, 'lg' => 1])
                            ->schema([
                                Section::make('Médias & Logos')
                                    ->description('Réservé si ce paramètre sert de logo ou favicon')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('logo')
                                            ->label('Logo du site')
                                            ->collection('logo')
                                            ->disk('public')
                                            ->image(),
                                        SpatieMediaLibraryFileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->collection('favicon')
                                            ->disk('public')
                                            ->image(),
                                    ]),

                                Section::make('Ordre')
                                    ->schema([
                                        TextInput::make('display_order')
                                            ->label('Ordre d\'affichage')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
