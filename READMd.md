# Travaux pratiques - Symfony

L'objectif de ce TP est de créer une application permettant de publier des recettes de cuisine. Tu vas devoir te lancer sur le ring et créer l'application tout seul à partir de rien... 💪 mais rassure-toi, nous t'avons quand même laissé quelques pistes (respire! 😮‍💨).

> Note: l'icône [📜](https://symfony.com/) dénote des liens vers les passages pertinents de la documentation de Symfony afin de te guider un peu!

## Modèle de données

![Image](ER-model.png)

Le modèle de données de l'application est inspiré par l'application [The Meal DB](https://www.themealdb.com/). Celle-ci contient un bon nombre de recettes différentes qu'elle renvoie sous forme de données JSON (exemple: [recette #52772](https://www.themealdb.com/api/json/v1/1/lookup.php?i=52772))

### Meal

Représente une recette. Chaque **Meal** est lié à un nombre indéterminé de **Instruction** et de **Ingredient**.

| **Propriété** | **Type** | **Commentaire** | **Exemple** |
| --- | --- | --- | --- |
| name | `string` | Nom de la recette | "Gaufres liégeoises" |
| category | `string` | Nom de la catégorie à laquelle appartient la recette | "Dessert" |
| area | `string` | Nationalité de la recette | "Belge" |
| image | `string` | URL de l'image illustrant la recette | "https://gastronomicvoyage.files.wordpress.com/2012/04/gaufre-liege1.jpg" |

### Instruction

Représente une étape de la recette. Chaque **Instruction** est liée à un (et un seul) **Meal**.

| **Propriété** | **Type** | **Commentaire** | **Exemple** |
| --- | --- | --- | --- |
| description | `string` | Description de l'étape | "Creusez un puits dans la farine et cassez les oeufs." |
| rank | `integer` | Ordre de l'étape dans la recette | `5` _(pour la 5ème étape d'une recette)_ |

### Ingredient

Représente un ingrédient de la recette. Chaque **Ingredient** est lié à un (et un seul) **Meal**.

| **Propriété** | **Type** | **Commentaire** | **Exemple** |
| --- | --- | --- | --- |
| name | `string` | Nom de l'ingrédient | "Beurre" |
| measure | `string` | Quantité de l'ingrédient dans la recette | "375g" |

## Travail à réaliser

### 1. Initialiser un nouveau projet Symfony [📜](https://symfony.com/doc/current/setup.html#running-symfony-applications)

- Crée un nouveau projet Symfony à l'intérieur de ce dépôt.

- Ajuste la configuration du projet à ton installation (notamment ton moteur de base de données).

- Lance le serveur local pour vérifier que ton application est correctement configurée.

### 2. Construire la base de données [📜](https://symfony.com/doc/current/doctrine.html)

Utilise l'outil en ligne de commande de Symfony pour créer les _mappings_ nécessaires afin de générer la base de données décrite dans la section **Modèle de données**.

Tu peux ensuite créer deux ou trois recettes en t'inspirant (ou non) des recettes présentes dans [The Meal DB](https://www.themealdb.com/).

> Note: "rank" étant un mot réservé du langage MySQL, il faut bien, dans l'implémentation, remplacer son nom par autre chose (par exemple, `instructionRank`).

#### Bonus [📜](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)

Ajoute des _fixtures_ afin de remplir automatiquement la base de données avec des données factices. Pour cela tu peux utiliser le code suivant afin d'extraire des recettes de [The Meal DB](https://www.themealdb.com/).

```php
$data = file_get_contents('https://www.themealdb.com/api/json/v1/1/lookup.php?i=52772');
$json_data = json_decode($data, true);
```

### 3. Afficher les recettes [📜](https://symfony.com/doc/current/controller.html)

Crée une route permettant d'afficher une liste de toutes les recettes existantes en base de données (avec au moins leur nom et leur image).

Puis, crée une route permettant d'afficher une seule recette (avec son nom, son image, sa catégorie, sa nationalité, la liste de ses étapes et la liste de ses ingrédients).

### 4. Ajouter, modifier, supprimer une recette

Crée un ensemble de routes permettant d'ajouter et modifier une recette, en prenant soin de valider la saisie de l'utilisateur.

Puis, crée une route permettant de supprimer une recette.

#### Bonus [📜](https://symfony.com/doc/current/forms.html)

Utiliser le _form builder_ de Symfony afin de générer automatiquement le formulaire d'ajout et de modification d'une recette.

### 5. Ajouter, modifier, supprimer un ingrédient d'une recette

Répète les étapes précédentes afin de rendre possible la création, la modification et la suppression d'un ingrédient dans une recette.

### Bonus

Ajoute un CRUD pour les étapes de recette, en prenant soin de vérifier que les rangs des différentes étapes sont toujours triés dans un ordre strict de 1 à n, sans laisser de trou.

### Super bonus de la mort

Rajoute une authentification dans l'application, et associe chaque recette à un utilisateur, qui serait l'auteur de cette recette. [📜](https://symfony.com/doc/current/security/form_login_setup.html)

Par la suite, vérifie bien que chaque utilisateur a le droit de modifier uniquement les recettes dont il est l'auteur. [📜](https://symfony.com/doc/current/security/voters.html)
