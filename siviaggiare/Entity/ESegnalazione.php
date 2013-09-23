<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 02/09/13
 * Time: 15.08
 * To change this template use File | Settings | File Templates.
 */

class ESegnalazione
{
    public $idsegnalazione; //id segnalazione

    public $autore; //chi fa la segnalazione
    public $segnalato;//l'utente che riceve

    public $idviaggio; // se si segnala un viaggio inopportuno
    public $citta;  // se si segnala una citta inopportuno
    public $luogo;  // se si segnala un luogo inopportuno
    public $idcommento; // se si segnala un commento inopportuno

    public $motivo; //il motivo della segnalazione



    public function getIDSegnalazione()
    {
        return $this->idsegnalazione;
    }
}