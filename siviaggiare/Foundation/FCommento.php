<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 12.21
 * To change this template use File | Settings | File Templates.
 */

class FCommento extends FDatabase
{

    public function __construct()
    {
        $this->tabella='commento';
        $this->chiave='id';
        $this->classe='ECommento';
        $this->auto_incremento=true;
        USingleton::getInstance('FDatabase');
    }

    public function store( $object )
    {
        $id = parent::store($object);
        $object->id=$id;
    }


    public function loadCommento($idcommento)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$idcommento.'\'';
        $obj=parent::getObject(parent::query($query));
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
        return $obj;
    }

    /**
     * Cancella dal database un commento
     *
     * @param object $object
     * @return boolean
     */
    public function deleteCommento($id)     //CONTROLLARE SE FUNZIONA (DAVEDERE)
    {
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$id.'\'';
        unset($object);////CONTROLLARE SE SERVE!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $obj=parent::getObjectInArray(parent::query($query));
        return $obj;
    }
}
?>