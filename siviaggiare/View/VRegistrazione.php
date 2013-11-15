<?php

class VRegistrazione extends View
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


    /**
     * Restituisce l'array contenente i dati di registrazione
     *
     * @return array();
     */
    public function getDatiRegistrazione()
    {
        $dati_richiesti=array('username','cognome','nome','residenza','nazione','mail','password','password_1');
        $dati=array();
        foreach ($dati_richiesti as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
    }


    /**
     * Restituisce il task
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
     * Restituisce il controller
     *
     * @return mixed
     */
    public function getController()
    {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }


    /**
     *
     *Rimuove controller e task
     *
     * @return mixed
     */
    public function unsetControllerTask()
    {
        if (isset($_REQUEST['controller']))
            unset($_REQUEST['controller']);
        if (isset($_REQUEST['task']))
            unset($_REQUEST['task']);
        else
            return false;
    }


    /**
     * restituisce la password passata tramite GET o POST
     *
     * @return mixed
     */
    public function getPassword()
    {
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
    public function getUsername()
    {
        if (isset($_REQUEST['username']))
            return $_REQUEST['username'];
        else
            return false;
    }


    /**
     * Verifica se l'user loggato sia amministratore o meno
     *
     * @return mixed
     */
    public function getAdmin()
    {
        if (isset($_REQUEST['admin']))
            return $_REQUEST['admin'];
        else
            return false;
    }


    /**
     * Restituisce l'e-mail dell'user
     *
     * @return mixed
     */
    public function getEmail()
    {
        if (isset($_REQUEST['mail']))
            return $_REQUEST['mail'];
        else
            return false;
    }


    /**
     * Processa i dati in un template
     *
     * @return string
     */
    public function processaTemplate()
    {
        $contenuto=$this->fetch('registrazione_'.$this->_layout.'.tpl');
        return $contenuto;
    }


    /**
     * Imposta il layout
     *
     * @return string
     */
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


    /**
     * Restituisce un array contenente i dati di attivazione
     *
     * @return mixed
     */
    public function getDatiAttivazione()
    {
        if(isset($_REQUEST['codice_attivazione']) && isset($_REQUEST['username']))
            return array('codice'=>$_REQUEST['codice_attivazione'], 'username'=>$_REQUEST['username']);
        else
            return false;
    }


}
?>