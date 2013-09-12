<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 15.57
 * To change this template use File | Settings | File Templates.
 */

class FViaggio extends FDatabase
{

    public function __construct()
    {
        $this->tabella='viaggio';
        $this->chiave='id'; //verificare che la chiave sia ID
        $this->classe='EViaggio';
        $this->auto_incremento=true;
        USingleton::getInstance('FDatabase');
    }


    public function store( $object )
    {
        $id = parent::store($object);
        $object->id=$id;
    }


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
    }


}