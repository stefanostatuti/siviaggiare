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
        $this->chiave=array('id','autore');
        //$this->chiave='autore';
        $this->classe='ECommento';
        $this->auto_incremento=true;
        USingleton::getInstance('FDatabase');
    }

    public function loadCommento($id)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$id.'\'';
        $obj=parent::getObject(parent::query($query));
        //debug("query fatta!");
        //var_dump($obj);
        //var_dump("ecco l'oggetto ricevuto".$obj);
        return $obj;
    }

    public function loadCommentiUtente($array)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave['1'].'` = \''.$array[0].'\'';
        $obj=parent::getObjectInArray(parent::query($query));
        debug("query fatta!");
        var_dump($obj);
        //var_dump("ecco l'oggetto ricevuto".$obj);
        return $obj;
    }
}
?>