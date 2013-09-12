<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 23/08/13
 * Time: 17.08
 * To change this template use File | Settings | File Templates.
 */

class FCitta extends FDatabase
{

    public function __construct() 
    {
        $this->tabella='citta';
        $this->chiave=array('idviaggio','nome'); //verificare che la chiave sia ID. 30/08 ho eliminato la chiave Stato perche superflua
        $this->classe='ECitta';
        $this->auto_incremento=false;// da verificare se va tolto
        USingleton::getInstance('FDatabase');
    }


    public function loadCitta($key)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio']
            .'\' AND '.'`'.$this->chiave[1].'` = \''.$key['nome'].'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


}