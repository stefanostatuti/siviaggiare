<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.59
 * To change this template use File | Settings | File Templates.
 */

class VRegistrazione extends View {

    private $_layout='default';

    public function show($layout)
    {
        $this->display($layout);
    }       //è deprecabile!!!

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
    public function getDatiRegistrazione()
    {
        $dati_richiesti=array('username','cognome','nome','residenza','nazione','mail','password','password_1');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
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

    /**
     * restituisce la password passata tramite GET o POST
     *
     * @return mixed
     */
    public function getPassword() {
        if (isset($_REQUEST['password']))
            return $_REQUEST['password'];
        else
            return false;
    }
    /**
     * restituisce la username passata tramite GET o POST
     *
     * @return mixed
     */
    public function getUsername() {
        if (isset($_REQUEST['username']))
            return $_REQUEST['username'];
        else
            return false;
    }
    public function getEmail() {
        if (isset($_REQUEST['mail']))
            return $_REQUEST['mail'];
        else
            return false;
    }

    public function processaTemplate() {
        $contenuto=$this->fetch('registrazione_'.$this->_layout.'.tpl');
        return $contenuto;
    }

    public function setLayout($layout){
        $this->_layout=$layout;
    }

    /**
     * Imposta l'eventuale errore nel template
     *
     * @param string $errore
     */
    public function impostaErrore($errore){
        $this->assign('errore',$errore);
    }

}
?>
