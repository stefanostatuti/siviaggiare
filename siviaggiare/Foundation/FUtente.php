<?php

class FUtente extends FDatabase
{

    public function __construct()
    {
        $this->tabella='utente';
        $this->chiave='username';
        $this->classe='EUtente';
        USingleton::getInstance('FDatabase');
    }


    /**
     * carica dal database un utente
     *
     * @param $user
     * @return mixed
     */
    public function loadUtente($user)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$user.'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


    /**
     * Cancella dal database un utente
     *
     * @param $utenteusername
     * @return mixed
     */
    public function deleteUtente($utenteusername)
    {
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$utenteusername.'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }
}
?>