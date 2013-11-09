<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 12.21
 * To change this template use File | Settings | File Templates.
 */

class FSegnalazione extends FDatabase
{

    public function __construct()
    {
        $this->tabella='segnalazioni';
        $this->chiave='id';
        $this->classe='ESegnalazione';
        $this->auto_incremento=true;
        USingleton::getInstance('FDatabase');
    }

    public function store( $object )
    {
        $id = parent::store($object);
        $object->id=$id;
        return $object->id;// forse non serve
    }

    public function loadSegnalazione($idSegnalazione)
    {
        var_dump($idSegnalazione);
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$idSegnalazione.'\'';
        $obj=parent::getObject(parent::query($query));
        debug("query fatta!");
        var_dump($obj);
        //var_dump("ecco l'oggetto ricevuto".$obj);
        return $obj;
    }


    //questo metodo sotto probabilmente è deprecabile richiamando la load in FDatabase
    //
    public function loadTUTTEleSegnalazioni()
    {
        //debug("ci entro in caricatutte le segnalazioni?");
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ';
        $obj=parent::getObjectInArray(parent::query($query));
        //debug("query fatta!");
        //var_dump("numero risultati ".count($obj));
        return $obj;
    }

}
?>