<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.58
 * To change this template use File | Settings | File Templates.
 */

class VViaggio extends View
{

    private $_layout='default';



              //metodi get:


    public function getDatiViaggio()
    {
        $dati_viaggio=array('datainizio','datafine','mezzotrasporto','costotrasporto', 'valutatrasporto','budget', 'valutabudget');//tolto username e citta
        $dati=array();
        foreach ($dati_viaggio as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        $session= USingleton::getInstance('USession');
        $dati['utenteusername']= $session->leggi_valore('username');
        return $dati;
    }


    public function getDatiLuogo()
    {
        $dati_viaggio=array('nome','sitoweb','percorso','costobiglietto', 'valuta', 'guida','coda','durata','commentolibero');//tolto 'idviaggio',
        $dati=array();
        foreach ($dati_viaggio as $dato)
        {
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


    public function getIdViaggio()
    {
        if (isset($_REQUEST['idviaggio']))
            return $_REQUEST['idviaggio'];
        elseif (isset($_REQUEST['id']))
            return $_REQUEST['id'];
        else
            return false;
    }


    public function getNomeLuogo()
    {
        if (isset($_REQUEST['nome']))
            return $_REQUEST['nome'];
        elseif (isset($_REQUEST['nomeluogo']))
            return $_REQUEST['nomeluogo'];
        else
            return false;
    }

    public function getNomeUtente()         /////FORSE NON SERVE
    {
        if (isset($_REQUEST['username']))
            return $_REQUEST['username'];
        else
            return false;
    }


    public function getNomeCitta()
    {
        if (isset($_REQUEST['nomecitta']))
            return $_REQUEST['nomecitta'];
        elseif (isset($_REQUEST['nome']))
            return $_REQUEST['nome'];
        else
            return false;
    }


    /**
     * Restituisce l'array contenente i dati di registrazione
     *
     * @return array();
     */
    public function getDatiCitta()
    {
        $dati_citta=array('datainizio','datafine','nome','stato','tipoalloggio','costoalloggio','valuta', 'voto');
        debug("questo è quello che ricevo dal TPL");
        debug($dati_citta);
        $dati=array();
        foreach ($dati_citta as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        //questo mi scrive l'username senno me manca
        //$session= USingleton::getInstance('USession');
        //$dati['utenteusername']= $session->leggi_valore('username');/////NON DOVREBBE SERVIRE
        return $dati;
    }


    public function getIdCommento()
    {
        if (isset($_REQUEST['idcommento']))
            return $_REQUEST['idcommento'];
        else
            return false;
    }


               //metodi set:



    public function setLayout($layout)
    {
        $this->_layout=$layout;
    }


               //altri metodi:



    public function processaTemplate()
    {
        return $this->fetch('viaggio_'.$this->_layout.'.tpl');
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