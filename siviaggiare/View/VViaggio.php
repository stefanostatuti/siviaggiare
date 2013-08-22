<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.58
 * To change this template use File | Settings | File Templates.
 */

class VViaggio extends View {

    public function show($layout)
    {
        $this->display($layout);
    }

    /**
     * Imposta i dati nel template identificati da una chiave ed il relativo valore
     *
     * @param string $key
     * @param mixed $valore
     */
    public function impostaDati($key,$valore){
        $this->assign($key,$valore);
    }

    /**
     * Restituisce l'array contenente i dati di registrazione
     *
     * @return array();
     */
    public function getDatiViaggio()
    {
        $dati_viaggio=array('username','datainizio','datafine','mezzotrasporto','costotrasporto','budget');
        debug("questo è quello che ricevo dal TPL");
        debug($dati_viaggio);
        $dati=array();
        foreach ($dati_viaggio as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        //questo mi scrive l'username senno me manca
        $session= USingleton::getInstance('USession');
        debug("questo è l'username: ");
        debug($session->leggi_valore('username'));
        $dati['utenteusername']= $session->leggi_valore('username');
        //end
        debug("questo è quello che ho pronto per scrivere sul DB");
        debug($dati);
        return $dati;
    }

    public function getTask()
    {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }

    public function getController()
    {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }
}
?>