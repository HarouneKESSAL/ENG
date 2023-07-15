# Guide d'installation de la plateforme d'ingénierie

Ce fichier README fournit des instructions sur la façon d'installer et de configurer la plateforme d'ingénierie sur votre machine locale. La plateforme d'ingénierie est construite à l'aide du framework Laravel et est conçue pour aider les ingénieurs dans leurs tâches quotidiennes. Suivez les étapes ci-dessous pour commencer.

## Prérequis

Avant d'installer la plateforme d'ingénierie, assurez-vous d'avoir installé les logiciels suivants sur votre système :

- PHP (7.4 ou version ultérieure)
- Composer
- Node.js (12 ou version ultérieure)
- npm (6 ou version ultérieure)
- MySQL (ou tout autre système de base de données pris en charge)

## Étapes d'installation

1. Clonez le référentiel sur votre machine locale :

   ```bash
   git clone https://github.com/HarouneKESSAL/ENG


2. Accédez au répertoire du projet :
```bash
cd ENG
```
3. Installez les dépendances PHP requises à l'aide de Composer :
```bash
composer install
```
4. Créez un nouveau fichier .env en dupliquant le fichier .env.example :
 ```bash
cp .env.example .env
```
5. Générez une nouvelle clé d'application :
 ```bash
php artisan key:generate
```
6. Configurez la connexion à la base de données dans le fichier .env :
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base_de_donnees
DB_USERNAME=votre_nom_utilisateur
DB_PASSWORD=votre_mot_de_passe
```
7. Exécutez les migrations de la base de données :
```bash
 php artisan migrate
```
8. Installez les dépendances JavaScript à l'aide de npm :
 ```bash
npm install
```
9. Compilez les ressources frontales :
 ```bash
npm run dev
```


## Démarrage de l'application
Pour démarrer la plateforme d'ENG, exécutez la commande suivante dans le répertoire du projet :
 ```bash
php artisan serve
```
