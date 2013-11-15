<?php

class EUtente
{
    public $cognome;
    public $nome;
    public $username;
    public $residenza;
    public $nazione;
    public $mail;
    public $lavoro;
    public $telefono;
    public $sesso;
    public $datanascita;
    public $foto;
    public $galleria;
    public $password;
    public $cod_attivazione;
    public $avvertimenti;
    public $stato='non_attivo';
    public $_elenco_viaggi = array();



    /**
     * Genera il codice di attivazione per l'utente
     *
     */
    public function generaCodiceAttivazione()
    {
        $this->cod_attivazione=mt_rand();
    }


    /**
     * Carica tutti i viaggi associati all'utente nell'attributo $_elenco_viaggi
     *
     * @return array
     */
    public function getElencoViaggi()
    {
        $FViaggio=new FViaggio();
        $this->_elenco_viaggi=$FViaggio->loadRicerca('utenteusername',$this->username);
        return $this->_elenco_viaggi;
    }


    /**
     * Verifica se un account è stato attivato
     *
     * @return bool
     */
    public function getAccountAttivo()
    {
        if ($this->stato=='attivo')
            return true;
        else
            return false;
    }


    /**
     * Prende il codice di attivazione associato all'utente
     *
     * @return $this->cod_attivazione
     */
    public function getCodiceAttivazione()
    {
        return $this->cod_attivazione;
    }


    /**
     * Prende gli avvertimenti associati all'utente
     *
     * @return $this->cod_attivazione
     */
    public function getAvvertimenti()
    {
        return $this->avvertimenti;
    }


    /**
     * permette ad un utente di tipo amministratore di incrementare gli avvertimenti associati all'utente
     *
     * @return boolean
     */
    public function riceviAvvertimento()
    {
        $this->avvertimenti++;
        $FUtente=new FUtente();
        $ris=$FUtente->update($this);
        if ($ris==true){
            //debug("UPDATE OK!! ");
            //debug("Dopo "+$this->getAvvertimenti()+"\n");
        }
        elseif ($ris==false){
            //debug("UPDATE FALLITO!!!! ");
            //debug("Dopo "+$this->getAvvertimenti()+"\n");
        }return $ris;
    }
}
?>