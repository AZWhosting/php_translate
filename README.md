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
│   └── Translate.php
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

## Contributions

Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour discuter de ce que vous aimeriez voir ajouté au projet.

## Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
