Voici un exemple de fichier `README.md` que tu peux fournir à ton formateur pour expliquer ton projet :

---

# 🧙‍♂️ Chasse aux Sorcières – Gestion des Rôles

Bienvenue dans le projet Symfony réalisé dans le cadre de ma formation. Ce site a pour objectif de gérer les rôles d’un jeu de débat appelé **Chasse aux Sorcières**, inspiré du Loup-Garou.

## 🎯 Objectif du projet

Ce projet permet de :

* Présenter les différents rôles jouables.
* Gérer la base de données de ces rôles via une interface.
* Donner un visuel dynamique et personnalisé de chaque rôle selon son camp (Villageois, Sorcière, Indépendant).

---

## ⚙️ Fonctionnalités principales

* 🔐 **Connexion utilisateur** : Système de connexion avec gestion des rôles utilisateurs (admin).
* 🛠️ **CRUD complet sur les rôles** : Création, modification, suppression et affichage des rôles.
* 🧩 **Gestion d'entité liée** : Chaque rôle possède un ou plusieurs pouvoirs (relation OneToMany).
* 🧙‍♀️ **Affichage conditionnel** :

  * Les boutons d’édition/suppression sont visibles uniquement si l'utilisateur est administrateur.
  * Le champ "But" d’un rôle ne s’affiche (et ne devient obligatoire) que si le camp est "Indépendant".
* 📜 **Enum Symfony** : Utilisation d’une enum PHP pour représenter les camps des rôles, synchronisée avec une colonne ENUM en base de données.
* 📑 **Formulaire imbriqué** : Formulaire de rôle contenant un sous-formulaire pour les pouvoirs.
* 🔍 **Recherche croisée** : Barre de recherche combinant champ texte et filtre par camp, avec requête DQL personnalisée.
* 🎨 **Personnalisation visuelle** : Couleurs et styles adaptés selon le camp du rôle dans les templates Twig.
* ✨ **Javascript dynamique** :

  * Ajout/Suppression de pouvoirs dans le formulaire de rôle.
  * Logique JS pour masquer/afficher le champ "But" selon le camp sélectionné, avec restauration automatique si on revient à "Indépendant"(seulement sur la page de modification).

---

## 📁 Structure technique

* Symfony 6+
* Doctrine ORM
* Twig
* Tailwind CSS (pour le style)
* Javascript natif

---

## ✅ Compétences mises en œuvre

* Maîtrise des entités Doctrine (relations, types ENUM…)
* Génération et personnalisation de formulaires Symfony complexes
* Système d’authentification et gestion des rôles utilisateurs
* Utilisation de JavaScript pour enrichir les interactions côté client
* Personnalisation avancée des vues avec Twig et Tailwind
* Requêtes DQL personnalisées pour la recherche filtrée
