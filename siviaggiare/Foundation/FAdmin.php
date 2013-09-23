<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 12.21
 * To change this template use File | Settings | File Templates.
 */

class FAdmin extends FUtente
{

    public function __construct()
    {
        $this->tabella='utente'; //la tabella è la stessa
        $this->chiave='username';// chiave
        $this->classe='EAdmin';// tipo di oggetto restituito
        USingleton::getInstance('FUtente');//USingleton::getInstance('FDatabase');
    }

/*
    public function loadViaggio($id)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$id.'\'';
        $obj=parent::getObject(parent::query($query));
        //debug("query fatta!");
        //var_dump($obj);
        //debug("ecco l'oggetto ricevuto".$obj);
        return $obj;
    }*/


}
?>