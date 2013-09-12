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
        $dati_viaggio=array('username','datainizio','datafine','mezzotrasporto','costotrasporto','budget');
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
        $dati_viaggio=array('idviaggio','nome','nomecitta','sitoweb','percorso','costobiglietto','guida','coda','durata','commentolibero');
        $dati=array();
        $session= USingleton::getInstance('USession');
        $dati['idviaggio']= $session->leggi_valore('idviaggio');
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
        $dati_citta=array('username','datainizio','datafine','nome','stato','tipoalloggio','costo','voto'); //da verificare
        debug("questo è quello che ricevo dal TPL");
        debug($dati_citta);
        $dati=array();
        foreach ($dati_citta as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        //questo mi scrive l'username senno me manca
        $session= USingleton::getInstance('USession');
        //debug("questo è l'username: ");
        //debug($session->leggi_valore('username'));
        $dati['utenteusername']= $session->leggi_valore('username');   //da verificare se è utenteusername
        //end
        //debug("questo è quello che ho pronto per scrivere sul DB");
        //debug($dati);
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
     * Restituisce l'array contenente i dati di registrazione
     *
     * @return array();
     */


    /**
     * Imposta l'eventuale errore nel template
     *
     * @param string $errore
     */
    public function impostaErrore($errore){
        $this->assign('errore',$errore);
    }



    /*public function compilaTemplateViaggio (EViaggio $viaggio)//prendo un oggetto di tipo viaggio
    {
    //debug("scrivo l'array ricevuto");
    //debug($viaggio);
    //debug("ok!");

    //scrivo il template
        //impostaDati('titolo',$array['titolo']);
        $this->impostaDati('username',$viaggio->utenteusername);
        $this->impostaDati('datainizio',$viaggio->datainizio);
        //debug("questo è la data del viaggio".$viaggio->datainizio);
        $this->impostaDati('datafine',$viaggio->datafine);
        $this->impostaDati('mezzotrasporto',$viaggio->mezzotrasporto);
        $this->impostaDati('costotrasporto',$viaggio->costotrasporto);
        $this->impostaDati('budget',$viaggio->budget);
        //compilato
        $this->show('ricerca_dettagli_viaggio.tpl');
        return $this; //ritorna il template
    }

    public function compilaTemplateLuogo (ELuogo $luogo)
    {
        $this->impostaDati('id',$luogo->idviaggio);
        $this->impostaDati('nome',$luogo->nome);
        $this->impostaDati('citta',$luogo->nomecitta);
        $this->impostaDati('sitoweb',$luogo->sitoweb);
        $this->impostaDati('percorso',$luogo->percorso);
        $this->impostaDati('costobiglietto',$luogo->costobiglietto);
        $this->impostaDati('guida',$luogo->guida);
        $this->impostaDati('coda',$luogo->coda);
        $this->impostaDati('durata',$luogo->durata);
        $this->impostaDati('commento',$luogo->commentolibero);
        $this->show('viaggio_dettagli_luogo.tpl');
    }

    /*public function provaTemplateTableLuogo ($array)
    {
        $this->impostaDati('id',$luogo->idviaggio);
        $this->impostaDati('nome',$luogo->nome);
        $this->impostaDati('citta',$luogo->nomecitta);
    }*/
}
?>