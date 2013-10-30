<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 15.56
 * To change this template use File | Settings | File Templates.
 */

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



    public function addCitta(ECitta $citta)
    {
        $this->_elenco_citta[] = $citta;
    }


    public function getElencoCitta()
    {
        $FCitta=new FCitta();
        $this->_elenco_citta=$FCitta->loadRicerca('idviaggio',$this->id);
        return $this->_elenco_citta;
    }


    public function getID()
    {
        return $this->id;
    }

}