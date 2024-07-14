<?php
namespace PhpTranslate;

class Translate
{
    private $language;
    private $translations = []; // Initialisation des traductions comme un tableau vide
    private $allowedLanguages = ['en', 'fr']; // Liste des langues autorisées

    public function __construct()
    {
        SessionManager::startSession();
        $this->initializeLanguage();
    }

    // Initialise la langue à partir de la session ou de la valeur par défaut
    private function initializeLanguage()
    {
        if (isset($_POST['language']) && $this->isValidLanguage($_POST['language'])) {
            $this->setLanguage($_POST['language']);
        } else {
            $this->setLanguage($_SESSION['language'] ?? 'en');
        }
    }

    // Vérifie si la langue est valide
    private function isValidLanguage($language)
    {
        return in_array($language, $this->allowedLanguages);
    }

    // Définit la langue et charge les traductions correspondantes
    public function setLanguage($language)
    {
        if (!$this->isValidLanguage($language)) {
            throw new \Exception("Invalid language selection: $language");
        }
        $this->language = $language;
        $_SESSION['language'] = $language;
        $this->translations = $this->loadLanguage($language);
    }

    // Charge les fichiers de langue
    private function loadLanguage($language)
    {
        $filePath = __DIR__ . "/../languages/{$language}_lang.php";
        if (!file_exists($filePath)) {
            throw new \Exception("Language file not found: $filePath");
        }

        $translations = include $filePath;
        if (!is_array($translations)) {
            throw new \Exception("Invalid language file format: $filePath");
        }

        return $translations;
    }

    // Retourne la traduction d'une clé
    public function translate($key)
    {
        return htmlspecialchars($this->translations[$key] ?? $key, ENT_QUOTES, 'UTF-8');
    }

    // Retourne la langue actuelle
    public function getLanguage()
    {
        return $this->language;
    }

    public static function __($key)
    {
        global $translator;
        return $translator->translate($key);
    }
}
