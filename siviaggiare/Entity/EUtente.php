<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 14/08/13
 * Time: 10.13
 * To change this template use File | Settings | File Templates.
 */

class EUtente {

    //public poiche in questo è possibile accedere agli attributi dall'esterno

    public $cognome;
    public $nome;
    public $username;
    public $residenza;
    public $nazione;
    public $mail;
    public $password;
    public $cod_attivazione;
    public $stato='non_attivo';
    public $_elenco_viaggi = array();


    /*
     * Il costruttore non serve perke si crea un utente (Costruttore Default) con attributi = NULL e poi una volta
     * validati i dati (esempio: passw1 == passw) essi inseriti dal metodo CreaUtente il quale associa i valori
     * provenienti dalla form agli attributi dell'oggetto utente e in seguito li immagazzinerà nel DB
     */

    /*public function __construct($utente)
    {
        $this->cognome = str_replace('','',(trim($utente['cognome'])));
        $this->nome = str_replace('','',(trim($utente['nome'])));
        $this->username = str_replace('','',(trim($utente['username'])));
        $this->residenza = str_replace('','',(trim($utente['residenza'])));
        $this->nazione = str_replace('','',(trim($utente['nazione'])));
        $this->mail = str_replace('','',(trim($utente['mail'])));
        $this->password = $utente['password'];
        $this->cod_attivazione = $utente['cod_attivazione'];
        $this->stato = $utente['stato'];
    }*/

    public function generaCodiceAttivazione() {
        $this->cod_attivazione=mt_rand();
    }

    public function addViaggio(EViaggio $viaggio) {
        $this->_elenco_viaggi[] = $viaggio;
    }

    public function getElencoViaggi() {
        $FViaggio=new FViaggio();
        $this->_elenco_viaggi=$FViaggio->loadRicerca('utenteusername',$this->username);
        //debug($this->_elenco_viaggi);
        return $this->_elenco_viaggi;
    }

    public function getAccountAttivo() {
        if ($this->stato=='attivo')
            return true;
        else
            return false;
    }

    public function getCodiceAttivazione() {
        return $this->cod_attivazione;
    }

}
?>