<?php

class EViaggio
{

    public $id;
    public $utenteusername;
    public $datainizio;
    public $datafine;
    public $mezzotrasporto;
    public $costotrasporto;
    public $budget;
    public $valutabudget;
    public $valutatrasporto;
    public $_elenco_citta = array();//tiene l'elenco dei POI


    /**
     * Carica tutte le città associate al viaggio nell'attributo $_elenco_citta
     *
     * @return array
     */
    public function getElencoCitta()
    {
        $FCitta=new FCitta();
        $this->_elenco_citta=$FCitta->loadRicerca('idviaggio',$this->id);
        return $this->_elenco_citta;
    }


    /**
     * restituisce l'id
     *
     * @return int
     */
    public function getID()
    {
        return $this->id;
    }

}
?>