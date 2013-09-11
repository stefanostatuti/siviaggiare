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
    public $id;
    public $idviaggioc;
    public $nomec;
    public $cittac;
    public $autore;
    public $testo;
    public $voto;

    public function getID()
    {
        return $this->id;
    }
}