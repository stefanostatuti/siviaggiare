<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 18/09/13
 * Time: 11.06
 * To change this template use File | Settings | File Templates.
 */

class VRicerca extends View{

    private $_layout = 'default';
    private $_layoutInterno = 'default';

    public function setLayout($layout)
    {
        $this->_layout=$layout;
    }

    public function setLayoutInterno($layout)
    {
        $this->_layoutInterno=$layout;
    }

    public function getTask()
    {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }

    public function getNome()
    {
        if (isset($_REQUEST['nome']))
            return $_REQUEST['nome'];
        if (isset($_REQUEST['nomecitta']))
            return $_REQUEST['nomecitta'];
        else
            return false;
    }

    public function getDatiCitta()
    {
        $dati_viaggio=array('idviaggio','nomecitta','stato');
        $dati=array();
        foreach ($dati_viaggio as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
    }

    public function getDatiLuogo()
    {
        $dati_viaggio=array('idviaggio','nomecitta','nomeluogo');
        $dati=array();
        foreach ($dati_viaggio as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
    }

    public function getDatiCommento()
    {
        $dati_viaggio=array('idviaggio','nomeluogo','nomecitta','testo','voto');
        $dati=array();
        $session= USingleton::getInstance('USession');
        $dati['autore']= $session->leggi_valore('username');
        foreach ($dati_viaggio as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=mysql_real_escape_string($_REQUEST[$dato]);
        }
        return $dati;
    }

    public function impostaDati($key,$valore)
    {
        $this->assign($key,$valore);
    }

    public function processaTemplate()
    {
        $contenuto=$this->fetch('ricerca_'.$this->_layout.'.tpl');
        return $contenuto;
    }

    public function processaTemplateInterno()
    {
        $contenuto=$this->fetch('ricerca_'.$this->_layoutInterno.'.tpl');
        return $contenuto;
    }

}
?>