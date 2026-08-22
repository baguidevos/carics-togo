<?php

return [
    'title' => 'Contactez-nous',
    'subtitle' => 'Notre équipe répond à toutes les demandes de collaboration, de partenariat ou d’information dans les meilleurs délais.',

    // Formulaire principal
    'form' => [
        'eyebrow' => 'Formulaire de contact',
        'title' => 'Envoyez-nous un message',
        'last_name' => 'Nom',
        'last_name_placeholder' => 'Votre nom',
        'first_name' => 'Prénom',
        'first_name_placeholder' => 'Votre prénom',
        'email' => 'Adresse email',
        'email_placeholder' => 'votre@email.com',
        'organization' => 'Organisation / Établissement',
        'organization_placeholder' => 'Votre institution ou organisation',
        'subject' => 'Objet de la demande',
        'select_subject' => 'Sélectionner un objet',
        'subjects' => [
            'collaboration' => 'Collaboration scientifique',
            'internship' => 'Stage / Mentorat',
            'partnership' => 'Partenariat institutionnel',
            'information' => 'Demande d’information générale',
            'media' => 'Demande média / Interview',
            'other' => 'Autre',
        ],
        'message' => 'Message',
        'message_placeholder' => 'Décrivez l’objet de votre prise de contact...',
        'privacy_agree' => 'J’accepte que CARICS-Togo traite mes données personnelles dans le cadre de cette prise de contact, conformément à la',
        'privacy_link' => 'politique de confidentialité',
        'send_btn' => 'Envoyer le message',
        'sending' => 'Envoi en cours...',
        'success_title' => 'Message envoyé avec succès',
        'success_text' => 'Votre message a bien été envoyé. L’équipe CARICS-Togo vous répondra dans les meilleurs délais, généralement sous 3 à 5 jours ouvrables.',
        'required_field' => 'Ce champ est obligatoire.',
        'invalid_email' => 'Veuillez saisir une adresse email valide.',
        'invalid_message' => 'Votre message doit comporter au moins 30 caractères.',
        'privacy_required' => 'Vous devez accepter la politique de confidentialité.',
    ],

    // Coordonnées
    'info' => [
        'eyebrow' => 'Informations',
        'title' => 'Nos coordonnées',
        'email_label' => 'Email',
        'phone_label' => 'Téléphone',
        'address_label' => 'Adresse',
        'address_value' => 'Quartier Nassablée<br>Commune de Tône 1, Préfecture de Tône<br>Région des Savanes<br><strong>République Togolaise</strong>',
        'location_title' => 'Dapaong, Région des Savanes',
        'location_subtitle' => 'Quartier Nassablée, Commune de Tône 1',
        'open_in_osm' => 'Ouvrir dans OpenStreetMap',
    ],

    // Formulaires spécialisés
    'specialized' => [
        'eyebrow' => 'Formulaires spécialisés',
        'title' => 'Demandes spécifiques',
        'sending' => 'Envoi...',
        'collaboration' => [
            'title' => 'Proposer une collaboration',
            'desc' => 'Vous souhaitez initier un projet collaboratif, rejoindre un consortium ou proposer une co-supervision ? Décrivez votre projet et joignez une note conceptuelle.',
            'fullname' => 'Nom et prénom',
            'institution' => 'Institution',
            'domain' => 'Domaine d’expertise',
            'project_desc' => 'Description du projet',
            'submit' => 'Soumettre',
            'success' => 'Proposition envoyée avec succès !',
        ],
        'stage' => [
            'title' => 'Candidature stage / Mentorat',
            'desc' => 'Étudiant en Master, Doctorat ou Postdoc souhaitant effectuer un stage ou bénéficier d’un mentorat scientifique ? Soumettez votre candidature spontanée.',
            'fullname' => 'Nom et prénom',
            'university' => 'Université / École',
            'level' => 'Niveau d’études',
            'select_level' => 'Sélectionner',
            'levels' => [
                'master' => 'Master',
                'doctorate' => 'Doctorat',
                'postdoc' => 'Post-doctorat',
            ],
            'domain' => 'Domaine de recherche',
            'submit' => 'Envoyer ma candidature',
            'success' => 'Candidature envoyée avec succès !',
        ],
        'media' => [
            'title' => 'Demande média / Interview',
            'desc' => 'Journaliste, documentariste ou communicant souhaitant interviewer un expert de CARICS-Togo ? Envoyez votre demande en précisant le sujet et la date souhaitée.',
            'fullname' => 'Nom et prénom',
            'organization' => 'Média / Organisation',
            'subject' => 'Sujet de l’interview',
            'date' => 'Date souhaitée',
            'email' => 'Email de contact',
            'submit' => 'Envoyer la demande',
            'success' => 'Demande envoyée avec succès !',
        ],
    ],

    // Newsletter
    'newsletter' => [
        'placeholder' => 'Votre adresse email...',
        'aria_label' => 'Votre email',
        'subscribe_btn' => 'S\'abonner',
        'already_subscribed' => 'Vous êtes déjà inscrit à notre newsletter.',
        'reactivated' => 'Votre inscription a été réactivée avec succès.',
        'thank_you' => 'Merci pour votre inscription à la lettre d\'information CARICS.',
    ],

    // FAQ
    'faq' => [
        'eyebrow' => 'FAQ',
        'title' => 'Questions fréquentes',
        'q1' => 'CARICS-Togo est-il ouvert aux collaborations avec des institutions hors du Togo ?',
        'a1' => 'Oui, tout à fait. CARICS-Togo a une vocation régionale et internationale. Nous sommes ouverts aux collaborations avec des universités, instituts de recherche, ONG et agences de développement du monde entier, en particulier d’Afrique de l’Ouest et francophone.',
        'q2' => 'Comment soumettre une proposition de projet commun ?',
        'a2' => 'Utilisez le formulaire « Proposer une collaboration » sur cette page en décrivant votre projet et en joignant si possible une note conceptuelle (2–5 pages). L’équipe vous répondra sous 5 jours ouvrables.',
        'q3' => 'Acceptez-vous des étudiants en stage de courte durée ?',
        'a3' => 'Oui, selon les capacités d’encadrement disponibles. Les stages de minimum 3 mois sont préférés. Envoyez votre candidature spontanée via le formulaire dédié sur cette page.',
        'q4' => 'Puis-je utiliser les données et publications de CARICS-Togo dans mes recherches ?',
        'a4' => 'Oui, les ressources publiées sur le site sont accessibles librement dans le respect de leurs licences respectives. Pour des demandes spécifiques d’accès à des données ou protocoles non encore publiés, contactez-nous directement.',
    ],
];
