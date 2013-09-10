<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 26/08/13
 * Time: 15.34
 * To change this template use File | Settings | File Templates.
 */

class ELuogo
{
    public $idviaggio;
    public $nome;
    public $nomecitta;
    public $sitoweb;
    public $percorso;
    public $costobiglietto;
    public $guida;
    public $coda;
    public $durata;
    public $commentolibero;
    public $_elenco_commenti = array();



    public function addCommento(ECommento $commento)
    {
        $this->_elenco_commenti[] = $commento;
    }

    public function getElencoCommenti()     //DA VEDERE
    {
        return $this->_elenco_commenti;
    }
}