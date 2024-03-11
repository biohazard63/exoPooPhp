### Partie 1 : Les guerriers

La classe `Warrior` permet de créer des objets possédant les propriétés suivantes :

- `$name` : string
- `$power` : number
- `$life` : number

Et les méthodes :

- `attack($opponent)`
- `isAlive()`

La méthode `attack` a un paramètre `opponent` (de type `Warrior`). Il faut réduire le nombre (`life`) de `opponent` d'autant de dégâts (`power`) de l'attaquant.

Exemple : Si le guerrier "Joan" attaque "Leon", cela sera représenté par :

```php
$joan->attack($leon);
```

La méthode `isAlive` doit retourner `true` si le nombre de points de vie du guerrier est supérieur à zéro et `false` sinon.

### Partie 2 : Armes

Crée trois classes `WarriorAxe`, `WarriorSword` et `WarriorSpear` qui héritent de `Warrior`.

Dans les classes `WarriorAxe`, `WarriorSword` et `WarriorSpear`, redéfinis la méthode `attack` pour prendre en compte les cas suivants :

- `WarriorAxe` : si le type de `opponent` est `WarriorSword`, multiplier `power` par deux
- `WarriorSword` : si le type de `opponent` est `WarriorSpear`, multiplier `power` par deux
- `WarriorSpear` : si le type de `opponent` est `WarriorAxe`, multiplier `power` par deux

Créer des instances des trois classes `WarriorAxe`, `WarriorSword` et `WarriorSpear` et vérifier que leurs méthodes `attack` fonctionnent correctement.

### Partie 3 : Bataille

Crée une boucle qui fait que deux instances de sous-classes `Warrior` s'affrontent (elles attaquent en même temps).

Quand au moins l'une d'entre elles est morte, affiche `{WarriorName} wins`. Si les deux sont morts, affiche `It's a draw`.

## Livrables

Un lien vers GitLab

## Critères de performance

- Connaissance des concepts de la programmation orientée objet
- Les bonnes pratiques de la programmation orientée objet (POO) sont respectées
- Coder dans un langage orienté objet avec un style défensif
- Le code source est documenté
- Utiliser les normes de codage du langage
- Utiliser un outil de gestion de versions

## Suite 

1) creer une classe Weapon chaque Warrior devra utiliser une $arme de la classe Weapon
2) utiliser au moin une methode abstraite dans la classe de votre choix
3) utiliser au moin 1 trait dans votre code
4) ajouter des faiblesses selon le type d'arme (sur la classe Warrior)