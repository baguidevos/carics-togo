# 📋 CARICS-Togo — Modernisation Frontend

## 🎯 Phase 1 : Hub de Publications & Ressources (Filtres instantanés & Citations)
- [x] Ajouter la recherche en temps réel (`search`) et filtres (`selectedType`, `selectedYear`) sur `⚡ressource-publication.blade.php`.
- [x] Ajouter les actions rapides : bouton copier la citation (APA), badge DOI, téléchargement direct du PDF / document.
- [x] Accordéon / aperçu fluide d'abstract avec Alpine.js.

## 🎯 Phase 2 : Projets de Recherche & Carte Interactive du Togo
- [x] Ajouter les filtres dynamiques par statut (`selectedStatus`) et recherche sur `⚡research_expertize_project.blade.php`.
- [x] Créer le composant SVG interactif des 5 régions du Togo (`togo-map.blade.php`) avec répartition dynamique des projets.

## 🎯 Phase 3 : Actualités & Opportunités (Filtres & Bento Grid)
- [x] Layout Bento Grid moderne pour mettre en avant l'article vedette et les actualités clés sur `⚡actu-opportunites.blade.php`.
- [x] Filtrage réactif Livewire des offres d'emploi, stages et bourses avec alerte "Urgent" pour les deadlines proches (< 7 jours).

## 🎯 Phase 4 : Recherche Globale & Confort de Navigation
- [x] Créer le modal de recherche globale Frontend (`Ctrl+K` / `Cmd+K` : `global-search-modal.blade.php`) dans le header.
- [x] Compteurs dynamiques et chiffres clés animés basés sur la BDD réelle sur `⚡home.blade.php`.

## 🎯 Phase 5 : Validation & Tests
- [x] Tests Pest dédiés dans `tests/Feature/FrontendModernizationTest.php`.
- [x] Formatage de conformité avec Laravel Pint.
