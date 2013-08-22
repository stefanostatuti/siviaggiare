<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 15.57
 * To change this template use File | Settings | File Templates.
 */

class FViaggio extends FDatabase{
    public function __construct() {
        $this->tabella='viaggio';
        $this->chiave='id'; //verificare che la chiave sia ID
        $this->classe='EViaggio';
        $this->_auto_increment=true;
        USingleton::getInstance('FDatabase');
    }


    public function store( $object ){
        $id = parent::store($object);
        $object->id=$id;
    }

}