<?php

class VAdmin extends View
{

    private $_layout='default';


    //METODI GET:


    /**
     * Restituisce il nome del task oppure "false"
     *
     * @return task || false;
     */
    public function getTask()
    {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }


    /**
     * Restituisce il nome del controller oppure "false"
     *
     * @return controller || false;
     */
    public function getController()
    {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }


    /**
     * Restituisce l'id della segnalazione sia nel caso in cui venga passato come "id"
     * sia nel caso in cui venga passato come idsegnalazine.(in alcuni casi è necessario inviare piu "IDs" dietro e questo
     * permette di facilitare la lettura del giusto id)
     *
     * @return id || idsegnalazione || false;
     */
    public function getIdSegnalazione()
    {   if (isset($_REQUEST['id']))
        return $_REQUEST['id'];
        if (isset($_REQUEST['idsegnalazione']))
        return $_REQUEST['idsegnalazione'];
        else
            return false;
    }


    /**
     * Restituisce l'id del Viaggio, false altrimenti
     *
     * @return idviaggio || false;
     */
    public function getIdViaggio()
    {
        if (isset($_REQUEST['idviaggio']))
            return $_REQUEST['idviaggio'];
        else
            return false;
    }


    /**
     * Restituisce il testo della segnalazione, false altrimenti
     *
     * @return testosegnalazione || false;
     */
    public function getTestoSegnalazione()
    {
        if (isset($_REQUEST['testosegnalazione']))
            return $_REQUEST['testosegnalazione'];
        else
            return false;
    }


    /**
     * Restituisce il nome della citta, false altrimenti
     *
     * @return nomecitta || false;
     */
    public function getNomeCitta()
    {
        if (isset($_REQUEST['nomecitta']))
            return $_REQUEST['nomecitta'];
        else
            return false;
    }


    /**
     * Restituisce l'autore del commento, false altrimenti
     *
     * @return autorecommento || false;
     */
    public function getAutoreCommento()
    {
        if (isset($_REQUEST['autorecommento']))
            return $_REQUEST['autorecommento'];
        else
            return false;
    }


    /**
     * Restituisce il nome del luogo, false altrimenti
     *
     * @return nomeluogo || false;
     */
    public function getNomeLuogo()
    {
        if (isset($_REQUEST['nomeluogo']))
            return $_REQUEST['nomeluogo'];
        else
            return false;
    }


    /**
     * Restituisce l'id del commento, false altrimenti
     *
     * @return idcommento || false;
     */
    public function getIdCommento()
    {
        if (isset($_REQUEST['idcommento']))
            return $_REQUEST['idcommento'];
        else
            return false;
    }


    /**
     * Svuota i campi controller e task Solo se sono settati,
     * false altrimenti
     *
     * @return testosegnalazione || false;
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
     * Restituisce il nome utente, false altrimenti
     *
     * @return nomeutente || false;
     */
    public function getNomeUtente()
    {
        if (isset($_REQUEST['nomeutente']))
            return $_REQUEST['nomeutente'];
        else
            return false;
    }


     //ALTRI METODI:


    /**
     * Setta il layout della pagina
     *
     * @param  layout
     * @return testosegnalazione || false;
     */
    public function setLayout($layout)
    {
        $this->_layout=$layout;
    }


    /**
     * Processa il Template, restituisce il template generato dall'unione di
     * "admin_" + "il campo private della classe" + "l'estensione .tpl"
     *
     * @return template name;
     */

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
    public function impostaDati($key,$valore)
    {
        $this->assign($key,$valore);
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
     * Restituisce l'array contenente i dati dell'utente modificati
     *
     * @return array();
     */
    public function getDatiModificati()
    {
        $dati_richiesti=array(
            'username',
            'cognome',
            'nome',
            'residenza',
            'nazione',
            'mail',
            'password',
            'telefono',
            'stato',
            'lavoro',
            'avvertimenti',
            'sesso',
            'datanascita',
            'cod_attivazione',
            'avvertimenti'
        );
        $dati=array();
        foreach ($dati_richiesti as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
    }

}
?>