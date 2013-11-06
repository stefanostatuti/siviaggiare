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
    public $valuta;
    public $guida;
    public $coda;
    public $durata;
    public $commentolibero;
    public $feedback;
    public $_elenco_commenti = array();


    public function getNomeLuogo()
    {
        return $this->nome;

    }

    public function addCommento(ECommento $commento)
    {
        $this->_elenco_commenti[] = $commento;
    }


    public function getElencoCommenti()
    {
        $FCommento=new FCommento();
        $this->_elenco_commenti=$FCommento->loadRicercaConTreValori('idviaggio',$this->idviaggio,'nomecitta',$this->nomecitta,'nomeluogo',$this->nome);
        debug("\n lista commenti:");
        var_dump($this->_elenco_commenti);
        return $this->_elenco_commenti;

    }
}