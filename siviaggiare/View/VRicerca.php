<?php

class VRicerca extends View
{

    private $_layout = 'default';
    private $_layoutInterno = 'default';


    /**
     * Imposta il layout
     *
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->_layout=$layout;
    }


    /**
     * Imposta il layout interno
     *
     * @param string $layout interno
     */
    public function setLayoutInterno($layout)
    {
        $this->_layoutInterno=$layout;
    }


    /**
     * Restituisce il nome del task richiesto tramite GET o POST
     *
     * @return mixed
     */
    public function getTask()
    {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }


    /**
     * Restituisce il nome della città
     *
     * @return mixed
     */
    public function getNome()
    {
        if (isset($_REQUEST['nome']))
            return $_REQUEST['nome'];
        if (isset($_REQUEST['nomecitta']))
            return $_REQUEST['nomecitta'];
        else
            return false;
    }


    /**
     * restituisce i dati relativi alla città
     *
     * @return array
     */
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


    /**
     * restituisce i dati relativi al luogo
     *
     * @return array
     */
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


    /**
     * restituisce i dati relativi al commento
     *
     * @return array
     */
    public function getDatiCommento()
    {
        $dati_viaggio=array('idviaggio','nomeluogo','nomecitta','testo','voto');
        $dati=array();
        $session= USingleton::getInstance('USession');
        $dati['autore']= $session->leggi_valore('username');
        foreach ($dati_viaggio as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
            // $dati[$dato]=mysql_real_escape_string($_REQUEST[$dato]);
        }
        return $dati;
    }


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


    /**
     * Processa il layout scelto nella variabile _layout
     *
     * @return string
     */
    public function processaTemplate()
    {
        $contenuto=$this->fetch('ricerca_'.$this->_layout.'.tpl');
        return $contenuto;
    }


    /**
     * Processa il layout interno scelto nella variabile _layoutInterno
     *
     * @return string
     */
    public function processaTemplateInterno()
    {
        $contenuto=$this->fetch('ricerca_'.$this->_layoutInterno.'.tpl');
        return $contenuto;
    }

}
?>