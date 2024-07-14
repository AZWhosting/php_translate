<?php
namespace PhpTranslate;

class SessionManager
{
    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_set_cookie_params([
                'lifetime' => 86400,
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            session_start();
            session_regenerate_id(true); // Régénérer l'identifiant de session pour éviter le détournement de session
        }
    }
}
