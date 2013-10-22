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
        $this->chiave=array('idsegnalazione');
        //$this->chiave='idsegnalazione';
        $this->classe='ESegnalazione';
        $this->auto_incremento=true;
        USingleton::getInstance('FDatabase');
    }


    public function loadSegnalazione($idSegnalazione)
    {   var_dump($idSegnalazione);
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$idSegnalazione.'\'';
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

    /**
     * Cancella dal database una Segnalazione
     *
     * @param idsegnalazione
     * @return boolean
     */
    public function deleteSegnalazione($idsegnalazione)
    {
        var_dump($idsegnalazione);
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$idsegnalazione.'\'';
        unset($object);

        $Fdb= new FDatabase();//mi serve per ottenere il metodo query da FDB
        return $Fdb->query($query);
    }
}
?>