<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 15.56
 * To change this template use File | Settings | File Templates.
 */

class EViaggio {

    public $id;
    public $utenteusername;
    public $datainizio;
    public $datafine;
    public $mezzotrasporto;
    public $costotrasporto;
    public $budget;
    public $_elenco_luoghi = array();//tiene l'elenco dei POI



    public function addLuogo(ELuogo $luogo) {
        $this->_elenco_luoghi[] = $luogo;
    }

    public function getElencoLuoghi() {
        return $this->_elenco_luoghi;
    }

}