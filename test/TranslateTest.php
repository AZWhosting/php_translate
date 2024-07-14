<?php

use PhpTranslate\Translate;
use PHPUnit\Framework\TestCase;

class TranslateTest extends TestCase
{
    protected $translator;

    protected function setUp(): void
    {
        $this->translator = new Translate();
        $this->translator->setLanguage('en');
    }

    public function testTranslateEnglish()
    {
        $this->assertEquals('Welcome', $this->translator->translate('welcome'));
        $this->assertEquals('Goodbye', $this->translator->translate('goodbye'));
    }

    public function testTranslateFrench()
    {
        $this->translator->setLanguage('fr');
        $this->assertEquals('Bienvenue', $this->translator->translate('welcome'));
        $this->assertEquals('Au revoir', $this->translator->translate('goodbye'));
    }

    public function testInvalidLanguage()
    {
        $this->expectException(\Exception::class);
        $this->translator->setLanguage('de'); // Langue non supportée
    }

    public function testMissingTranslation()
    {
        $this->assertEquals('nonexistent_key', $this->translator->translate('nonexistent_key'));
    }

    public function testLanguagePersistenceInSession()
    {
        $_POST['language'] = 'fr';
        $translator = new Translate();
        $this->assertEquals('fr', $translator->getLanguage());
        $this->assertEquals('Bienvenue', $translator->translate('welcome'));

        // Simuler un nouvel objet Translate avec la session déjà définie
        unset($_POST['language']);
        $newTranslator = new Translate();
        $this->assertEquals('fr', $newTranslator->getLanguage());
        $this->assertEquals('Bienvenue', $newTranslator->translate('welcome'));
    }

    public function testAdditionalLanguage()
    {
        // Simuler l'ajout d'une nouvelle langue
        file_put_contents(__DIR__ . '/../languages/es_lang.php', '<?php return ["welcome" => "Bienvenido", "goodbye" => "Adiós"];');

        // Ajouter la nouvelle langue à la liste des langues autorisées
        $reflection = new ReflectionClass(Translate::class);
        $property = $reflection->getProperty('allowedLanguages');
        $property->setAccessible(true);
        $property->setValue($this->translator, ['en', 'fr', 'es']);

        // Tester la traduction en espagnol
        $this->translator->setLanguage('es');
        $this->assertEquals('Bienvenido', $this->translator->translate('welcome'));
        $this->assertEquals('Adiós', $this->translator->translate('goodbye'));

        // Nettoyer le fichier de langue ajouté pour le test
        unlink(__DIR__ . '/../languages/es_lang.php');
    }
}
?>
