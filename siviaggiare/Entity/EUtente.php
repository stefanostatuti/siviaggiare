<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 14/08/13
 * Time: 10.13
 * To change this template use File | Settings | File Templates.
 */

class EUtente
{

    //public poiche in questo è possibile accedere agli attributi dall'esterno

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
    public $messaggi;
    public $password;
    public $cod_attivazione;
    public $avvertimenti;
    public $stato='non_attivo';
    public $_elenco_viaggi = array();



    public function generaCodiceAttivazione()
    {
        $this->cod_attivazione=mt_rand();
    }


    public function addViaggio(EViaggio $viaggio)
    {
        $this->_elenco_viaggi[] = $viaggio;
    }


    public function getElencoViaggi()
    {
        $FViaggio=new FViaggio();
        $this->_elenco_viaggi=$FViaggio->loadRicerca('utenteusername',$this->username);
        return $this->_elenco_viaggi;
    }


    public function getAccountAttivo()
    {
        if ($this->stato=='attivo')
            return true;
        else
            return false;
    }

    public function getCodiceAttivazione()
    {
        return $this->cod_attivazione;
    }

    public function getAvvertimenti()
    {
        return $this->avvertimenti;
    }

    public function riceviAvvertimento()
    {
        debug("Prima "+$this->getAvvertimenti()+"\n");
        $this->avvertimenti++;

        var_dump($this->getAvvertimenti());
        //aggiorno il db
        $FUtente=new FUtente();
        $ris=$FUtente->update($this);
        if ($ris==true){
            debug("UPDATE OK!! ");
            debug("Dopo "+$this->getAvvertimenti()+"\n");
        }
        elseif ($ris==false){
            debug("UPDATE FALLITO!!!! ");
            debug("Dopo "+$this->getAvvertimenti()+"\n");
        }
    }

}
?>