<?php

class FViaggio extends FDatabase
{

    public function __construct()
    {
        $this->tabella='viaggio';
        $this->chiave='id';
        $this->classe='EViaggio';
        $this->auto_incremento=true;
        USingleton::getInstance('FDatabase');
    }


    /**
     * salva sul database un Viaggio
     *
     * @param $object
     * @return int
     */
    public function store( $object )
    {
        $id = parent::store($object);
        $object->id=$id;
        return $object->id;
    }


    /**
     * carica dal database un Viaggio
     *
     * @param  $id
     * @return boolean
     */
    public function loadViaggio($id)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$id.'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


    /**
     * Cancella dal database un Viaggio
     *
     * @param id
     * @return boolean
     */
    public function deleteViaggio($id)
    {
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$id.'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }

}
?>