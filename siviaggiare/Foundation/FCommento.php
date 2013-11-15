<?php

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


    /**
     * salva in database un commento
     *
     * @param $object
     * @return mixed
     */
    public function store( $object )
    {
        $id = parent::store($object);
        $object->id=$id;
    }


    /**
     * carica dal database un commento
     *
     * @param $idcommento
     * @return array
     */
    public function loadCommento($idcommento)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$idcommento.'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


    /**
     * Cancella dal database un commento
     *
     * @param $id
     * @return array
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