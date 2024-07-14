<?php
// Inclure l'autoloader de Composer
require 'vendor/autoload.php';

// Initialiser l'objet Translate global
use PhpTranslate\Translate;
$translator = new Translate();
?>
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
