# Système de Gestion de Rendez-vous Médicaux (PFE)



---

## Description du Projet

Ce projet est une plateforme web moderne conçue pour simplifier la prise de rendez-vous médicaux et la gestion des patients. Développée dans le cadre d'un **Projet de Fin d'Études (PFE)**, elle offre une interface intuitive et des fonctionnalités complètes pour les patients, les médecins et l'administration.

## Fonctionnalités Clés

### 👨‍⚕️ Pour les Médecins
- **Tableau de Bord Personnalisé** : Vue d'ensemble sur les activités quotidiennes.
- **Gestion des Disponibilités** : Définition des créneaux horaires libres pour les rendez-vous.
- **Gestion des Rendez-vous** : Consultation, validation ou modification des rendez-vous patients.
- **Inscription & Profil** : Système d'inscription dédié pour les nouveaux praticiens.

### Pour les Patients
- **Recherche de Médecins** : Liste complète des médecins disponibles dans le système.
- **Prise de Rendez-vous** : Réservation facile de créneaux selon les disponibilités.
- **Détails & Export PDF** : Consultation des détails du rendez-vous et génération de justificatifs en format PDF.
- **Gestion du Profil** : Mise à jour des informations personnelles.

### Pour l'Administration
- **Gestion des Comptes** : Contrôle des utilisateurs et des médecins.
- **Validation des Médecins** : Approbation des nouvelles demandes d'inscription des praticiens.
- **Supervision Globale** : Vue globale sur les statistiques et l'état du système.

## Stack Technique

- **Backend** : [Laravel 10.x](https://laravel.com) (Framework PHP)
- **Frontend** : [Blade](https://laravel.com/docs/blade) (Moteur de template), [Tailwind CSS](https://tailwindcss.com) (Styling)
- **Base de Données** : MySQL
- **Outil de Build** : [Vite](https://vitejs.dev)
- **Génération PDF** : DomPDF / Barryvdh-Laravel-DomPDF

## Installation Globale

1. **Cloner le projet** :
   ```bash
   git clone [URL_DU_REPOT]
   cd gest
   ```

2. **Installer les dépendances PHP** :
   ```bash
   composer install
   ```

3. **Installer les dépendances JS** :
   ```bash
   npm install
   npm run dev
   ```

4. **Configuration de l'environnement** :
   - Copiez `.env.example` en `.env`.
   - Configurez votre base de données dans `.env`.
   - Générez la clé d'application :
     ```bash
     php artisan key:generate
     ```

5. **Migrations et Seeding** :
   ```bash
   php artisan migrate --seed
   ```

6. **Lancer le serveur** :
   ```bash
   php artisan serve
   ```

---

## Auteurs

- **TAHIRI Abdelilah** 
