# Chronotruck PHP test

Ce repository contient une commande (symfony/console) à l'intérieur d'un container docker. 
Cette commande permet de vérifier la validité d'un numéro de TVA. 
Pour ce faire, elle fait appel au [service européen vies](http://ec.europa.eu/taxation_customs/vies/vatResponse.html) 
via l'intermédiaire de [la librairie DragonB/vies](https://github.com/DragonBe/vies)

## Pour démarrer

Après avoir cloné le repo, normalement les commandes suivantes suffisent (il faut avoir composer et docker-compose sur la machine hôte)

```shell
composer --working-dir=./console install
docker-compose run console bash
```

Une fois dans le container, la commande est appelée de la manière suivante :

```shell
root@xxx:/console# php app.php check-vat-number FR85821267952
```

Ce qui doit vous donner la réponse suivante : `Vat number FR85821267952 is valid !`

## Objectifs

#### 1 - Ajouter un système de cache Redis

Pour éviter les appels réseau inutiles, mettre en place un système de cache avec Redis.

- Redis doit être dans un container docker linké à la console (utiliser l'image de base, pas besoin d'écrire un Dockerfile)
- La validité du cache est de 1 heure (une clé de cache par numéro de TVA)

#### 2 - Ajouter un système de log des exécutions

Afin d'historiser l'utilisation de la console, mettre en place un système de log dans un fichier.

- Ce fichier doit se trouver sur le système hôte (et donc être monté en tant que volume du container)
- Le système de log utilisé doit respecter PSR-3
- Pour chaque exécution de la commande, une ligne doit être insérée dans le fichier avec la forme suivante : 
```
[Date au format Y-m-d H:i:s] [numéro de TVA] [1 si le numéro est valide, 0 si non valide]
```

#### 3 - Gestion des erreurs

Le webservice VIES étant relativement peu stable, il faut prévoir que l'appel puisse échouer.
Dans le cas d'un échec, il faudra veiller à :

- ne pas mettre en cache la valeur retournée par le webservice
- Logger dans un nouveau fichier (errors.log) les appels en échec au format suivant

```
[Date au format Y-m-d H:i:s] [numéro de TVA] [message de l'exception]
```

## Quelques consignes / conseils génériques :

- Ne pas pusher sur master, créer une branche
- Créer un commit par exercice
- Ecrire le code [le plus propre possible](https://fr.wikipedia.org/wiki/SOLID_(informatique))
- Ne pas réinventer la roue, utilisez des librairies si possible
- Ne pas hésiter à ajouter des commentaires pour décrire les choix
- Have fun :-)
