# 📋 Roadmap & Suivi du Projet CARICS-Togo

Dernière mise à jour : 16 Août 2026  
Branche active : `fix/content-corrections` (ou future branche `feature/i18n-static`)

---

## 📊 Tableau de Bord d'Avancement

- [x] **Phase 0 : Audit & Nettoyage Initial** (100%)
- [x] **Phase 1 : Traduction & Internationalisation (i18n)** (100%)
- [ ] **Phase 2 : Stabilisation des Modèles & Données** (30%)
- [ ] **Phase 3 : Panneau d'Administration Filament v5** (15%)
- [ ] **Phase 4 : Dynamisation Frontend Livewire SFC** (10%)
- [ ] **Phase 5 : Modules Interactifs & Formulaires** (0%)
- [ ] **Phase 6 : Qualité, Tests Pest & Sécurité** (20%)
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

## 🌍 Phase 1 : Internationalisation (i18n) — Éléments Statiques & Dynamiques

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

## 🛠️ Phase 2 : Stabilisation des Modèles & Base de Données

- [ ] **Migration TeamData ➔ Eloquent** :
  - [ ] Écrire un Seeder `TeamMemberSeeder` qui charge les données de `TeamData.php` en base de données
  - [ ] Mettre à jour les composants Livewire pour requêter `TeamMember::published()->ordered()->get()` au lieu de `TeamData::all()`
  - [ ] Supprimer ou archiver `TeamData.php`
- [x] **Compatibilité SQLite** :
  - [x] Corriger [Publication::authors()](file:///c:/Users/D3vOs/Projets/Laravel/Web/carics-togo/app/Models/Publication.php) pour remplacer la fonction MySQL `FIELD()` par une méthode compatible SQLite/PostgreSQL
- [ ] **Seeders & Données Initiales** :
  - [ ] `CategorySeeder` (Catégories pour Blog, Ressources, Opportunités, Actualités)
  - [ ] `PartnerSeeder` (Partenaires scientifiques et institutionnels)
  - [ ] `ResearchProjectSeeder` (Projet CPS Savanes et futurs projets)
  - [ ] `SiteSettingSeeder` (Téléphones, emails, mission, réseaux sociaux)
  - [ ] Mettre à jour [DatabaseSeeder](file:///c:/Users/D3vOs/Projets/Laravel/Web/carics-togo/database/seeders/DatabaseSeeder.php) pour exécuter l'ensemble
- [ ] **Model Factories** :
  - [ ] Créer les factories pour chaque modèle : `BlogPostFactory`, `ResearchProjectFactory`, `PublicationFactory`, `OpportunityFactory`, `NewsFactory`, etc.

---

## 🎛️ Phase 3 : Panneau d'Administration Filament v5

- [ ] **Ressources CRUD manquantes** :
  - [ ] `ResearchProjectResource` (Gestion des projets de recherche, partenaires associés, statut)
  - [ ] `BlogPostResource` (Articles de blog, fiches projet, slug auto, éditeur riche)
  - [ ] `PublicationResource` (Publications scientifiques, DOIs, auteurs associés)
  - [ ] `NewsResource` (Actualités et événements)
  - [ ] `OpportunityResource` (Offres d'emploi, bourses, stages, dates limites)
  - [ ] `PartnerResource` (Partenaires et bailleurs avec logos)
  - [ ] `ResourceItemResource` (Ressources documentaires et outils téléchargeables)
  - [ ] `CategoryResource` (Gestion des catégories polymorphiques par modèle)
  - [ ] `ContactSubmissionResource` (Visualisation des messages reçus, statut lu/traité)
  - [ ] `NewsletterSubscriberResource` (Exportation et gestion des abonnés)
  - [ ] `SiteSettingPage` / `ManageSettings` (Gestion visuelle des paramètres globaux du site)
- [ ] **Gestion des Médias** :
  - [ ] Configurer Spatie Media Library ou intégrer le stockage Filament pour les photos, documents PDF et logos

---

## 💻 Phase 4 : Dynamisation Frontend Livewire SFC

- [ ] Connecter la page **Accueil** à la base de données (derniers articles, projet phare, partenaires actifs)
- [ ] Connecter la page **Recherche & Projets** aux modèles `ResearchProject` et domaines réels
- [ ] Connecter la page **Ressources & Publications** aux modèles `Publication` et `Resource`
- [ ] Connecter la page **Actualités & Opportunités** aux modèles `News` et `Opportunity`
- [ ] Connecter la page **Équipe** et fiche individuelle `team-detail` aux enregistrements `TeamMember`
- [ ] Gérer les états vides ("Aucun résultat pour le moment") de manière élégante et bilingue

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
