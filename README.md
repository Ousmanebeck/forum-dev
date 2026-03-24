# Forum Dev Alcatraz

**Documentation & Guide d'installation**

PHP - MySQL - Bootstrap 5 | Développé par Ousmane Idriss Adam

---

## 1. Présentation du projet

Forum Dev est une plateforme web de questions-réponses dédiée aux développeurs. Les membres peuvent s'inscrire, poser des questions techniques, répondre aux questions des autres et gérer leur profil. L'application est entièrement développée en PHP natif avec PDO pour la base de données et Bootstrap 5 pour l'interface.

| **Nom du projet** | Forum Dev Alcatraz |
|-------------------|-------------------|
| **Langage** | PHP 7.4+ (natif, sans framework) |
| **Base de données** | MySQL 5.7+ via PDO |
| **CSS** | Bootstrap 5 uniquement (aucun CSS custom) |
| **Serveur local** | XAMPP
| **Auteur** | Ousmane Idriss Adam |

---

## 2. Fonctionnalités

### 2.1 Gestion des utilisateurs
- Inscription avec nom, email et mot de passe
- Connexion par email + mot de passe (session PHP)
- Déconnexion avec destruction de session
- Consultation du profil public (nom, questions publiées)
- Modification du profil (nom, email)
- Mots de passe hashés avec `password_hash()` / `password_verify()`

### 2.2 Questions
- Publier une question (titre + contenu détaillé)
- Lister toutes les questions avec pagination 5 par page
- Recherche par titre (LIKE SQL)
- Consulter le contenu complet d'une question
- Modifier sa propre question
- Supprimer sa propre question (avec vérification d'auteur)
- Liste personnelle "Mes questions"

### 2.3 Réponses
- Poster une réponse à n'importe quelle question
- Affichage des réponses classées du plus récent au plus ancien
- Nom de l'auteur de chaque réponse avec lien vers son profil

### 2.4 Sécurité
- Protection de toutes les pages par vérification de session (`session.php`)
- Requêtes SQL préparées avec PDO (protection injections SQL)
- Échappement HTML avec `htmlspecialchars()` sur toutes les sorties
- Vérification d'appartenance avant modification/suppression

---

## 3. Structure des fichiers

| **Fichier** | **Rôle** |
|-------------|----------|
| index.php | Page d'accueil (hero, stats, features) |
| connexion.php | Formulaire de connexion |
| inscription.php | Formulaire d'inscription |
| lesQuestions.php | Liste de toutes les questions + recherche |
| laQuestion.php | Affichage d'une question + ses réponses + formulaire réponse |
| poserQuestion.php | Formulaire de publication d'une question |
| mesQuestions.php | Questions de l'utilisateur connecté (CRUD) |
| modifierQuestion.php | Formulaire de modification d'une question |
| profil.php | Profil public d'un utilisateur |
| modifierProfile.php | Formulaire de modification du profil |
| includes/head.php | Balises `<head>` + chargement Bootstrap 5 |
| includes/navbar.php | Barre de navigation Bootstrap responsive |
| basededonnee.php | Connexion PDO à la base de données MySQL |
| requetes.php | Traitement des requêtes |


---

## 4. Base de données

Nom de la base : `forum` | Encodage : `utf8mb4` | Connexion : localhost, utilisateur root sans mot de passe (configuration XAMPP par défaut).

### 4.1 Table `utilisateurs`

| **Colonne** | **Type** | **Description** |
|-------------|----------|-----------------|
| id | INT UNSIGNED AI | Clé primaire auto-incrémentée |
| nom | VARCHAR(100) | Nom complet de l'utilisateur |
| email | VARCHAR(180) | Email unique |
| mdp | VARCHAR(255) | Mot de passe hashé (bcrypt) |
| date_creation | CURRENT_TIMESTAMP |  Date formatée (ex : 14/01/2024 10:35:42) |

### 4.2 Table `questions`

| **Colonne** | **Type** | **Description** |
|-------------|----------|-----------------|
| id | INT UNSIGNED AI | Clé primaire |
| titre | VARCHAR(255) | Titre de la question |
| contenu | TEXT | Contenu détaillé |
| utilisateur_id | INT UNSIGNED FK | Référence utilisateurs.id |
| date_creation | CURRENT_TIMESTAMP |  Date formatée (ex : 14/01/2024 10:35:42) |

### 4.3 Table `reponses`

| **Colonne** | **Type** | **Description** |
|-------------|----------|-----------------|
| id | INT UNSIGNED AI | Clé primaire |
| utilisateur_id | INT UNSIGNED FK | Référence utilisateurs.id |
| question_id | INT UNSIGNED FK | Référence questions.id |
| contenu | TEXT | Corps de la réponse |
| date_creation | CURRENT_TIMESTAMP |  Date formatée (ex : 14/01/2024 10:35:42) |

---

## 5. Installation

### Étape 1 — Prérequis
- XAMPP (ou WAMP/LAMP) avec Apache + PHP 7.4+ + MySQL 5.7+
- Un navigateur web

### Étape 2 — Copier les fichiers
Placer le dossier du projet dans le répertoire `htdocs` de XAMPP :
-C:\xampp\htdocs\forum\
### Étape 3 — Créer la base de données
Ouvrir phpMyAdmin (http://localhost/phpmyadmin) et importer le fichier SQL :
-forum.sql
Ou exécuter dans la console MySQL :
-mysql -u root -p < forum.sql
### Étape 4 — Vérifier la connexion
Ouvrir le fichier `basededonnee.php` et vérifier les paramètres de connexion :
```
$connexion = new PDO('mysql:host=localhost; dbname=forum; charset=utf8;', 'root', '');
```
Modifier le mot de passe si votre MySQL n'utilise pas root sans mot de passe.
