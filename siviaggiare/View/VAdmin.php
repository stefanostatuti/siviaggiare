<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.58
 * To change this template use File | Settings | File Templates.
 */

class VAdmin extends View
{

    private $_layout='default';



              //metodi get:

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


    public function getIdSegnalazione()
    {
        if (isset($_REQUEST['idsegnalazione']))
            return $_REQUEST['idsegnalazione'];
        /*elseif (isset($_REQUEST['id']))
            return $_REQUEST['id'];*/
        else
            return false;
    }



    public function setLayout($layout)
    {
        $this->_layout=$layout;
    }


               //altri metodi:



    public function processaTemplate()
    {
        return $this->fetch('admin_'.$this->_layout.'.tpl');
    }


    /**
     * Imposta i dati nel template identificati da una chiave ed il relativo valore
     *
     * @param string $key
     * @param mixed $valore
     */
    public function impostaDati($key,$valore){ //chiave , valore
        $this->assign($key,$valore);
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