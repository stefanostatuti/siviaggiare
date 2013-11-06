<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 12.21
 * To change this template use File | Settings | File Templates.
 */

class FUtente extends FDatabase
{

    public function __construct()
    {
        $this->tabella='utente';
        $this->chiave='username';
        $this->classe='EUtente';
        USingleton::getInstance('FDatabase');
    }

    public function loadUtente($id)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$id.'\'';
        $obj=parent::getObject(parent::query($query));
        //debug("query fatta!");
        //var_dump($obj);
        //debug("ecco l'oggetto ricevuto".$obj);
        return $obj;
    }

}
?>