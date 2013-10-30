<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.59
 * To change this template use File | Settings | File Templates.
 */

class VProfilo extends View
{

    private $_layout='default';



    /**
     * Imposta i dati nel template identificati da una chiave ed il relativo valore
     *
     * @param string $key
     * @param mixed $valore
     */
    public function impostaDati($key,$valore)
    {
        $this->assign($key,$valore);
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
     * restituisce la username passata tramite GET o POST
     *
     * @return mixed
     */
    public function getUsername()
    {
        if (isset($_REQUEST['username']))
            return $_REQUEST['username'];
        else
            return false;
    }


    public function processaTemplate()
    {
        $contenuto=$this->fetch('registrazione_'.$this->_layout.'.tpl');
        return $contenuto;
    }


    public function setLayout($layout)
    {
        $this->_layout=$layout;
    }


    /**
     * Imposta l'eventuale errore nel template
     *
     * @param string $errore
     */
    public function impostaErrore($errore)
    {
        $this->assign('errore',$errore);
    }
    

}
?>