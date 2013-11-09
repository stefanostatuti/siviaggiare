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
        else
            return false;
    }

    public function getIdViaggio()
    {
        if (isset($_REQUEST['idviaggio']))
            return $_REQUEST['idviaggio'];
        else
            return false;
    }

    public function getNomeCitta()
    {
        if (isset($_REQUEST['nomecitta']))
            return $_REQUEST['nomecitta'];
        else
            return false;
    }

    public function getNomeLuogo()
    {
        if (isset($_REQUEST['nomeluogo']))
            return $_REQUEST['nomeluogo'];
        else
            return false;
    }

    public function getIdCommento()
{
    if (isset($_REQUEST['idcommento']))
        return $_REQUEST['idcommento'];
    else
        return false;
}

    public function getAutoreCommento()
    {
        if (isset($_REQUEST['autorecommento']))
            return $_REQUEST['autorecommento'];
        else
            return false;
    }

    public function getTestoSegnalazione()
    {
        if (isset($_REQUEST['testosegnalazione']))
            return $_REQUEST['testosegnalazione'];
        else
            return false;
    }

    public function getNomeUtente()
    {
        if (isset($_REQUEST['nomeutente']))
            return $_REQUEST['nomeutente'];
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