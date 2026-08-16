# 📋 Roadmap & Suivi du Projet CARICS-Togo

Dernière mise à jour : 16 Août 2026  
Branche active : `fix/content-corrections` (ou future branche `feature/i18n-static`)

---

## 📊 Tableau de Bord d'Avancement

- [x] **Phase 0 : Audit & Nettoyage Initial** (100%)
- [x] **Phase 1 : Traduction & Internationalisation (i18n)** (100%)
- [x] **Phase 2 : Stabilisation des Modèles & Données** (100%)
- [x] **Phase 3 : Panneau d'Administration Filament v5** (100%)
- [x] **Phase 4 : Dynamisation Frontend Livewire SFC** (100%)
- [ ] **Phase 5 : Modules Interactifs & Formulaires** (0%)
- [ ] **Phase 6 : Qualité, Tests Pest & Sécurité** (50%)
- [ ] **Phase 7 : SEO, Performance & Déploiement** (0%)

---

## 🎯 Phase 0 : Audit & Nettoyage Initial (Terminé ✅)

- [x] Corriger les fautes d'orthographe et typographies (`correction.md`)
- [x] Remplacer les liens morts du template (`.html`) par des routes nommées Laravel
- [x] Corriger la typo de route d'administration Filament (`/cpanell` ➔ `/cpanel`)
- [x] Supprimer la route orpheline `/1` et les routes commentées résiduelles
- [x] Nettoyer les textes par défaut et placeholders non professionnels
- [x] Remplacer les tirets simples par des tirets cadratins (`Recherche – Innovation – Action`)

---

## 🌍 Phase 1 : Internationalisation (i18n) — Éléments Statiques & Dynamiques (Terminé ✅)

### 1.1 Éléments Statiques (Fichiers de Langue `lang/fr` & `lang/en`)
- [x] Créer `lang/fr/navigation.php` et `lang/en/navigation.php` (Header, Footer, Liens, Boutons)
- [x] Créer `lang/fr/home.php` et `lang/en/home.php` (Hero, Piliers, Domaines d'intervention, Chiffres clés, CTA)
- [x] Créer `lang/fr/about.php` et `lang/en/about.php` (Qui sommes-nous, Historique, Ambition, Valeurs)
- [x] Créer `lang/fr/research.php` et `lang/en/research.php` (Domaines d'expertise, Priorités, Projets phares)
- [x] Créer `lang/fr/resources.php` et `lang/en/resources.php` (Publications, Rapports, Policy briefs, Outils)
- [x] Créer `lang/fr/team.php` et `lang/en/team.php` (Titres de rôles, Labels bio, Boutons contact)
- [x] Créer `lang/fr/contact.php` et `lang/en/contact.php` (Champs formulaires, Labels, Messages de confirmation)
- [x] Créer `lang/fr/news_opp.php` et `lang/en/news_opp.php` (Actualités, Emplois, Stages, Bourses, Partenariats)

### 1.2 Intégration dans les Vues Blade
- [x] Remplacer les textes statiques dans `<x-archinest.header />` par `__('navigation....')`
- [x] Remplacer les textes statiques dans `<x-archinest.footer />` par `__('navigation....')`
- [x] Traduire la vue Accueil `⚡home.blade.php`
- [x] Traduire la vue À Propos `⚡about-us.blade.php`
- [x] Traduire la vue Recherche `⚡research_expertize_project.blade.php`
- [x] Traduire la vue Ressources `⚡ressource-publication.blade.php`
- [x] Traduire la vue Actualités & Opportunités `⚡actu-opportunites.blade.php`
- [x] Traduire la vue Équipe `⚡team.blade.php` et `⚡team-detail.blade.php`
- [x] Traduire la vue Contact `⚡contact.blade.php`

### 1.3 Système de Switch de Langue
- [x] Vérifier et perfectionner le dropdown de changement de langue FR/EN dans le header
- [x] S'assurer que le middleware [SetLocale](file:///c:/Users/D3vOs/Projets/Laravel/Web/carics-togo/app/Http/Middleware/SetLocale.php) est bien actif sur le groupe `web`

---

## 🛠️ Phase 2 : Stabilisation des Modèles & Base de Données (Terminé ✅)

- [x] **Migration TeamData ➔ Eloquent** :
  - [x] Écrire un Seeder `TeamMemberSeeder` qui charge les données de `TeamData.php` en base de données
  - [x] Mettre à jour les composants Livewire pour requêter `TeamMember::published()->ordered()->get()` au lieu de `TeamData::all()`
  - [x] Supprimer ou archiver `TeamData.php`
- [x] **Compatibilité SQLite** :
  - [x] Corriger [Publication::authors()](file:///c:/Users/D3vOs/Projets/Laravel/Web/carics-togo/app/Models/Publication.php) pour remplacer la fonction MySQL `FIELD()` par une méthode compatible SQLite/PostgreSQL
- [x] **Seeders & Données Initiales** :
  - [x] `CategorySeeder` (Catégories pour Blog, Ressources, Opportunités, Actualités)
  - [x] `PartnerSeeder` (Partenaires scientifiques et institutionnels)
  - [x] `ResearchProjectSeeder` (Projet CPS Savanes et futurs projets)
  - [x] `PublicationSeeder` (Publications scientifiques et rapports)
  - [x] `BlogPostSeeder` (Articles de blog et fiches projet)
  - [x] `NewsSeeder` (Actualités institutionnelles et scientifiques)
  - [x] `OpportunitySeeder` (Offres d'emploi, stages et consultances)
  - [x] `ResourceSeeder` (Documents, guides et synthèses)
  - [x] `SiteSettingSeeder` (Téléphones, emails, mission, réseaux sociaux)
  - [x] Mettre à jour [DatabaseSeeder](file:///c:/Users/D3vOs/Projets/Laravel/Web/carics-togo/database/seeders/DatabaseSeeder.php) pour exécuter l'ensemble
- [x] **Model Factories** :
  - [x] Créer les factories pour tous les modèles : `TeamMemberFactory`, `PartnerFactory`, `CategoryFactory`, `ResearchProjectFactory`, `BlogPostFactory`, `PublicationFactory`, `OpportunityFactory`, `NewsFactory`, `ResourceFactory`, `ContactSubmissionFactory`, `NewsletterSubscriberFactory`, `SiteSettingFactory`.
  - [x] Tests unitaires/feature de validation des factories (`ModelFactoriesTest.php`)

---

## 🎛️ Phase 3 : Panneau d'Administration Filament v5 (Terminé ✅)

- [x] **Ressources CRUD Filament** :
  - [x] `TeamMemberResource` (Membres de l'équipe, rôles, expertises, bios)
  - [x] `ResearchProjectResource` (Gestion des projets de recherche, partenaires associés, statut)
  - [x] `BlogPostResource` (Articles de blog, fiches projet, slug auto, éditeur riche)
  - [x] `PublicationResource` (Publications scientifiques, DOIs, auteurs associés)
  - [x] `NewsResource` (Actualités et événements)
  - [x] `OpportunityResource` (Offres d'emploi, bourses, stages, dates limites)
  - [x] `PartnerResource` (Partenaires et bailleurs avec logos)
  - [x] `ResourceResource` (Ressources documentaires et outils téléchargeables)
  - [x] `CategoryResource` (Gestion des catégories polymorphiques par modèle)
  - [x] `ContactSubmissionResource` (Visualisation des messages reçus, statut lu/traité)
  - [x] `NewsletterSubscriberResource` (Exportation et gestion des abonnés)
  - [x] `SiteSettingResource` (Gestion des paramètres globaux du site)
- [x] **Sécurité & Authentification Filament** :
  - [x] Implémentation du contrat `FilamentUser` et de `canAccessPanel()` sur `User`
  - [x] Tests automatisés d'accès et d'autorisation du panneau (`tests/Feature/FilamentPanelTest.php`)

---

## 💻 Phase 4 : Dynamisation Frontend Livewire SFC (Terminé ✅)

- [x] Connecter la page **Accueil** à la base de données (membres fondateurs, partenaires actifs, derniers flux)
- [x] Connecter la page **Recherche & Projets** aux modèles `ResearchProject` et domaines réels
- [x] Connecter la page **Ressources & Publications** aux modèles `Publication` et `Resource`
- [x] Connecter la page **Actualités & Opportunités** aux modèles `News`, `Opportunity` et `Partner`
- [x] Connecter la page **Équipe** et fiche individuelle `team-detail` aux enregistrements `TeamMember`
- [x] Gérer les états vides ("Aucun résultat pour le moment") de manière élégante et bilingue

---

## ✉️ Phase 5 : Modules Interactifs & Formulaires

- [ ] **Formulaire de Contact** :
  - [ ] Validation Livewire temps réel
  - [ ] Enregistrement dans `contact_submissions`
  - [ ] Envoi d'un email de notification aux administrateurs
  - [ ] Message flash de confirmation bilingue
- [ ] **Inscription Newsletter** :
  - [ ] Validation de l'email unique
  - [ ] Token de désabonnement automatique
  - [ ] Message de succès réactif

---

## 🧪 Phase 6 : Qualité, Tests Pest & Sécurité

- [ ] Tests de routage et code HTTP des pages publiques (`tests/Feature/PublicPagesTest.php`)
- [ ] Tests de bascule de langue (`tests/Feature/LocaleTest.php`)
- [ ] Tests de soumission du formulaire de contact et newsletter
- [ ] Tests d'accès et de permissions au panneau Filament
- [ ] Exécuter et valider `vendor/bin/pint`
- [ ] Valider l'analyse statique `composer types:check` (Larastan / PHPStan)

---

## 🚀 Phase 7 : SEO, Performance & Déploiement

- [ ] Balises Open Graph et Twitter Cards dynamiques
- [ ] Génération automatique de `sitemap.xml` et `robots.txt`
- [ ] Mise en cache des paramètres [SiteSetting](file:///c:/Users/D3vOs/Projets/Laravel/Web/carics-togo/app/Models/SiteSetting.php) et optimisation des requêtes N+1
- [ ] Script de build de production Vite (`npm run build`)
- [ ] Préparation des variables `.env.production`
