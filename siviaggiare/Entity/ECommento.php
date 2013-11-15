<?php

class ECommento 
{
    public $id;
    public $idviaggio;
    public $nomeluogo;
    public $nomecitta;
    public $autore;
    public $testo;
    public $voto;


    /**
     * restituisce l'id del commento
     *
     * @return int
     */
    public function getIDCommento()
    {
        return $this->id;
    }
}
?>