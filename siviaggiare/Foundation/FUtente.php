<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 12.21
 * To change this template use File | Settings | File Templates.
 */

class FUtente extends FDatabase
{

    public function __construct()
    {
        $this->tabella='utente';
        $this->chiave='username';
        $this->classe='EUtente';
        USingleton::getInstance('FDatabase');
    }
}
?>