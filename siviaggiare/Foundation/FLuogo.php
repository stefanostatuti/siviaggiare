<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 26/08/13
 * Time: 15.36
 * To change this template use File | Settings | File Templates.
 */

class FLuogo extends FDatabase{

    public function __construct() {
        $this->tabella='luogo';
        $this->chiave=array('idviaggio','nome','nomecitta');
        $this->classe='ELuogo';
        $this->auto_incremento=false;
        USingleton::getInstance('FDatabase');
    }

    public function loadLuogo($key)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio'].'\' AND '.'`'.$this->chiave[1].'` = \''.$key['nome'].'\' AND '.'`'.$this->chiave[2].'` = \''.$key['nomecitta'].'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }
}