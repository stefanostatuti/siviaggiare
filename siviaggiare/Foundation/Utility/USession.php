<?php
/**
 * @access public
 * @author Alessandro Verzicco
 * @package System
 */
class USession
{

    public function __construct()
    {
        session_start();
        debug("Sessione:");
        debug($_SESSION);
    }


    /**
     * imposta un valore nella sessione
     */
    function imposta_valore($chiave,$valore)
    {
        $_SESSION[$chiave]=$valore;
    }


    /**
     * cancella un valore nella sessione
     */
    function cancella_valore($chiave)
    {
        unset($_SESSION[$chiave]);
    }


    /**
     * legge un valore nella sessione
     */
    function leggi_valore($chiave)
    {
        if (isset($_SESSION[$chiave]))
            return $_SESSION[$chiave];
        else
            return false;
    }


    function chiudi()
    {
        debug("Chiudo sessione");
        session_destroy();

    }
}
?>