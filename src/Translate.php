<?php
namespace PhpTranslate;

class Translate
{
    private $language;
    private $translations = []; // Initialisation des traductions comme un tableau vide
    private $allowedLanguages = ['en', 'fr']; // Liste des langues autorisées

    public function __construct()
    {
        $this->startSession();
        $this->initializeLanguage();
    }

    // Démarre la session si elle n'est pas déjà démarrée
    private function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start([
                'cookie_lifetime' => 86400,
                'cookie_secure' => true,
                'cookie_httponly' => true
            ]);
            session_regenerate_id(true); // Régénérer l'identifiant de session
        }
    }

    // Initialise la langue à partir de la session ou de la valeur par défaut
    private function initializeLanguage()
    {
        if (isset($_POST['language']) && in_array($_POST['language'], $this->allowedLanguages)) {
            $this->setLanguage($_POST['language']);
        } else {
            $this->setLanguage($_SESSION['language'] ?? 'en');
        }
    }

    // Définit la langue et charge les traductions correspondantes
    public function setLanguage($language)
    {
        if (!in_array($language, $this->allowedLanguages)) {
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
        // Retourne la traduction ou la clé si la traduction n'est pas trouvée
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
?>
