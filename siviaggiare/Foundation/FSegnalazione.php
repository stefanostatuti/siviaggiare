<?php

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

    /**
     * Salva lo stato di un oggetto di tipo segnalazione sul DB
     *
     * @return int
     */
    public function store( $object )
    {
        $id = parent::store($object);
        $object->id=$id;
        return $object->id;
    }

    /**
     * Metodo che permette di caricare una segnalazione partendo da un id
     * @param int
     * @return obj
     */
    public function loadSegnalazione($idSegnalazione)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$idSegnalazione.'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }

    /**
     * Metodo che permette di caricare dal DB tutte le segnalazioni
     *
     * @return obj
     */
    public function loadTUTTEleSegnalazioni()
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ';
        $obj=parent::getObjectInArray(parent::query($query));
        return $obj;
    }


    /**
     * Cancella dal database una Segnalazione
     *
     * @param idsegnalazione
     * @return boolean
     */
    public function deleteSegnalazione($idsegnalazione)
    {
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$idsegnalazione.'\'';
        unset($object);

        $Fdb= new FDatabase();//mi serve per ottenere il metodo query da FDB
        return $Fdb->query($query);
    }
}
?>