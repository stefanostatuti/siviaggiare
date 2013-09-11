<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 02/09/13
 * Time: 15.08
 * To change this template use File | Settings | File Templates.
 */

class ECommento 
{
    public $idcommento;
    public $idviaggio;
    public $nomeluogo;
    public $nomecitta;
    public $autore;
    public $testo;
    public $voto;

    public function getIDCommento()
    {
        return $this->idcommento;
    }
}