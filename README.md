# PHP Translate

PHP Translate est une bibliothèque simple pour ajouter la prise en charge des traductions dans vos projets PHP.

## Installation

Pour installer cette bibliothèque via Composer, exécutez la commande suivante dans votre terminal :

```bash
composer require azwhosting/php_translate
```

## Utilisation

### Configuration de la bibliothèque

1. **Inclure la classe Translate dans votre projet** :
   
   Dans votre fichier principal (par exemple, `index.php`), incluez la classe `Translate` et initialisez l'objet global :

    ```php
    require 'vendor/autoload.php';

    use PhpTranslate\Translate;

    $translator = new Translate();
    ```

2. **Créer les fichiers de langue** :

   Créez des fichiers de langue dans le répertoire `languages`. Par exemple :

   - `languages/en_lang.php` :
     ```php
     return [
         'welcome' => 'Welcome',
         'goodbye' => 'Goodbye',
         // Ajoutez plus de traductions ici
     ];
     ```

   - `languages/fr_lang.php` :
     ```php
     return [
         'welcome' => 'Bienvenue',
         'goodbye' => 'Au revoir',
         // Ajoutez plus de traductions ici
     ];
     ```

3. **Utiliser les traductions dans votre application** :

   Utilisez la fonction `translate` pour obtenir les traductions dans vos fichiers PHP :

    ```php
    echo Translate::__('welcome');
    echo Translate::__('goodbye');
    ```

   Vous pouvez également définir la langue via un formulaire POST comme montré ci-dessous :

    ```php
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Example</title>
    </head>
    <body>
        <form method="post" action="">
            <label for="language">Choose language:</label>
            <select name="language" id="language" onchange="this.form.submit()">
                <option value="en" <?= $translator->getLanguage() == 'en' ? 'selected' : '' ?>>English</option>
                <option value="fr" <?= $translator->getLanguage() == 'fr' ? 'selected' : '' ?>>Français</option>
                <!-- Ajoutez plus d'options pour d'autres langues ici -->
            </select>
        </form>

        <p><?= Translate::__('hello world') ?></p>
        <p><?= Translate::__('welcome') ?></p>
        <p><?= Translate::__('goodbye') ?></p>

    </body>
    </html>
    ```

### Structure du Projet

Voici la structure de répertoire de votre projet après l'installation de la bibliothèque :

```
php_translate
├── languages
│   ├── en_lang.php
│   └── fr_lang.php
├── src
│   ├── SessionManager.php
│   └── Translate.php
├── tests
│   └── TranslateTest.php
├── vendor
│   └── autoload.php
├── index.php
├── composer.json
└── README.md
```

### Méthodes de la classe Translate

- **setLanguage($language)** : Définit la langue et charge les traductions correspondantes.
- **getLanguage()** : Retourne la langue actuelle.
- **translate($key)** : Retourne la traduction d'une clé ou la clé si la traduction n'est pas trouvée.
- **__($key)** : Méthode statique pour retourner la traduction d'une clé globalement.

### Exemples de Traductions

Pour ajouter plus de traductions, il suffit de modifier les fichiers de langue en ajoutant les paires clé-valeur nécessaires :

- `languages/en_lang.php` :
  ```php
  return [
      'welcome' => 'Welcome',
      'goodbye' => 'Goodbye',
      'hello_world' => 'Hello World',
      // Ajoutez plus de traductions ici
  ];
  ```

- `languages/fr_lang.php` :
  ```php
  return [
      'welcome' => 'Bienvenue',
      'goodbye' => 'Au revoir',
      'hello_world' => 'Bonjour le monde',
      // Ajoutez plus de traductions ici
  ];
  ```

### Exécution des Tests

Ce projet utilise PHPUnit pour les tests unitaires. Pour exécuter les tests, suivez les étapes ci-dessous :

### Installation des dépendances de développement

Si ce n'est pas déjà fait, installez les dépendances de développement :

```bash
composer install
```

### Exécution des tests

Pour exécuter tous les tests, utilisez la commande suivante :

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```

### Résultats des tests

Vous devriez voir une sortie indiquant le nombre de tests et d'assertions passés. Par exemple :

```
PHPUnit 11.2.7 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.12

......                                                              6 / 6 (100%)

Time: 00:00.045, Memory: 6.00 MB

OK (6 tests, 12 assertions)
```

## Contributions

Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour discuter de ce que vous aimeriez voir ajouté au projet.

## Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
