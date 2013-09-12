<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 23/08/13
 * Time: 17.05
 * To change this template use File | Settings | File Templates.
 */

class ECitta 
{

    public $idviaggio;
    public $nome;
    public $stato;
    public $datainizio;
    public $datafine;
    public $tipoalloggio;
    public $costoalloggio;
    public $voto;
    public $_elenco_luoghi = array();//tiene l'elenco dei POI



    public function addLuogo(ELuogo $luogo) 
    {
        $this->_elenco_luoghi[] = $luogo;
    }


    public function getElencoLuoghi() 
    {
        $FLuogo=new FLuogo();
        $this->_elenco_luoghi=$FLuogo->loadRicerca('idviaggio',$this->idviaggio);
        //debug($this->_elenco_luoghi);
        return $this->_elenco_luoghi;
    }

}
?>