# 📋 CARICS-Togo — Modernisation Frontend & Pages de Détail

## 🎯 Phase 1 : Hub de Publications & Ressources (Filtres instantanés & Citations)
- [x] Ajouter la recherche en temps réel (`search`) et filtres (`selectedType`, `selectedYear`) sur `⚡ressource-publication.blade.php`.
- [x] Ajouter les actions rapides : bouton copier la citation (APA), badge DOI, téléchargement direct du PDF / document.
- [x] Accordéon / aperçu fluide d'abstract avec Alpine.js.

## 🎯 Phase 2 : Projets de Recherche & Carte Interactive du Togo
- [x] Ajouter les filtres dynamiques par statut (`selectedStatus`) et recherche sur `⚡research_expertize_project.blade.php`.
- [x] Créer le composant SVG interactif des 5 régions du Togo (`togo-map.blade.php`) avec répartition dynamique des projets.

## 🎯 Phase 3 : Actualités & Opportunités (Bento Grid & Détail)
- [x] Layout Bento Grid moderne pour mettre en avant l'article vedette et les actualités clés sur `⚡actu-opportunites.blade.php`.
- [x] Filtrage réactif Livewire des offres d'emploi, stages et bourses avec alerte "Urgent" pour les deadlines proches (< 7 jours).
- [x] Création de la **page de détail d'actualité dédiée** (`/actualites/{slug}` : `⚡news-detail.blade.php`) avec gestion de l'image de couverture, métadonnées, estimation du temps de lecture, partage social rapide (WhatsApp, X, LinkedIn, Copie de lien) et actualités récentes.
- [x] Dynamisation de la section Actualités de la Page d'Accueil (`⚡home.blade.php`) avec liens directs vers les actualités.

## 🎯 Phase 4 : Confort & Optimisations
- [x] Correction du préchargeur et sécurisation de l'affichage.
- [x] Indexation dynamique dans le Sitemap XML (`sitemap.xml`) de toutes les actualités publiées.

## 🎯 Phase 5 : Validation & Tests
- [x] Tests Pest dédiés dans `tests/Feature/FrontendModernizationTest.php`.
- [x] Formatage de conformité avec Laravel Pint.
