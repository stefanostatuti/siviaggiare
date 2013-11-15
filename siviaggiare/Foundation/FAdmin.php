<?php

class FAdmin extends FUtente
{

    public function __construct()
    {
        $this->tabella='utente'; //la tabella è la stessa
        $this->chiave='username';// chiave
        $this->classe='EAdmin';// tipo di oggetto restituito
        USingleton::getInstance('FUtente');//USingleton::getInstance('FDatabase');
    }

}
?>