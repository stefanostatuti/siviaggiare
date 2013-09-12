<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 12.21
 * To change this template use File | Settings | File Templates.
 */

class FCommento extends FDatabase           //TUTTA DA VEDERE   !!!!
{

    public function __construct()
    {
        $this->tabella='commento';
        $this->chiave=array('idcommento','autore');
        //$this->chiave='autore';
        $this->classe='ECommento';
        $this->auto_incremento=true;
        USingleton::getInstance('FDatabase');
    }


    public function loadCommento($idcommento)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$idcommento.'\'';
        $obj=parent::getObject(parent::query($query));
        //debug("query fatta!");
        //var_dump($obj);
        //var_dump("ecco l'oggetto ricevuto".$obj);
        return $obj;
    }


    //questo metodo sotto probabilmente è deprecabile richiamando la load in FDatabase
    // e si lascia come chiave SOLO idcommento
    public function loadCommentiUtente($array)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave['1'].'` = \''.$array[0].'\''; //chiave ['1'] è l'indice della chiave al posto 1 cioè 'autore'
        $obj=parent::getObjectInArray(parent::query($query));
        //debug("query fatta!");
        //var_dump($obj);
        //var_dump("ecco l'oggetto ricevuto".$obj);
        return $obj;
    }
}
?>