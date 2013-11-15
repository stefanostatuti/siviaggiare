<?php

class ESegnalazione
{
    public $id;
    public $autore;
    public $segnalato;
    public $idviaggio;
    public $citta;
    public $luogo;
    public $idcommento;
    public $motivo;


    /**
     * Ritorna l'id della segnalazione
     *
     * @return $this->id
     */
    public function getIDSegnalazione()
    {
        return $this->id;
    }
}
?>