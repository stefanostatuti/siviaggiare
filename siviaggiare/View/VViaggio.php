<?php

class VViaggio extends View
{

    /**
     * @var $_layout  Variabile dove dove si impostano i i tipi di layout
     */
    private $_layout='default';



    //metodi get:


    /**
     * restituisce su un array i dati del viaggio acquisiti dal template
     * @author Riccardo
     * @return array
     */
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


    /**
     * restituisce su un array i dati del luogo acquisiti dal template
     * @author Riccardo
     * @return array
     */
    public function getDatiLuogo()
    {
        $dati_viaggio=array('nome','sitoweb','percorso','costobiglietto', 'valuta', 'guida','coda','durata','commentolibero');
        $dati=array();
        foreach ($dati_viaggio as $dato)
        {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        if(isset($_FILES["immagini"]['name']))
        {
            $session=USingleton::getInstance('USession');
            $user=$session->leggi_valore('username');
            $upload_dir = "templates/main/template/images/foto_luogo"; // cartella in cui il file sarà salvato
            $file_name = str_replace(" ","",$_FILES["immagini"]['name']);
            $file_name=$user.$file_name;
            if(@is_uploaded_file($_FILES["immagini"]["tmp_name"]))
            {
                @move_uploaded_file(str_replace(" ","",$_FILES["immagini"]["tmp_name"]), "$upload_dir/$file_name");
                $dati['immagini']=$file_name;
            }
        }

        return $dati;
    }


    /**
     * se è settato restituisce il task su una variabile
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
     * se è settato restituisce il controller su una variabile
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
     * se è settato restituisce l'id del viaggio su una variabile
     *
     * @return mixed
     */
    public function getIdViaggio()
    {
        if (isset($_REQUEST['idviaggio']))
            return $_REQUEST['idviaggio'];
        elseif (isset($_REQUEST['id']))
            return $_REQUEST['id'];
        else
            return false;
    }


    /**
     * se è settato restituisce il nome del luogo su una variabile
     * @author Riccardo
     * @return mixed
     */
    public function getNomeLuogo()
    {
        if (isset($_REQUEST['nome']))
            return $_REQUEST['nome'];
        elseif (isset($_REQUEST['nomeluogo']))
            return $_REQUEST['nomeluogo'];
        else
            return false;
    }


    /**
     * se è settato restituisce il nome dell'utente su una variabile
     * @author Riccardo
     * @return mixed
     */
    public function getNomeUtente()         /////FORSE NON SERVE
    {
        if (isset($_REQUEST['username']))
            return $_REQUEST['username'];
        else
            return false;
    }


    /**
     * se è settato restituisce il nome della citta su una variabile
     * @author Riccardo
     * @return mixed
     */
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
     * se è settato restituisce il costo dell'alloggio su una variabile
     * @author Riccardo
     * @return mixed
     */
    public function getCostoAlloggio()
    {
        if (isset($_REQUEST['costoalloggio']))
            return  $costo = $_REQUEST['costoalloggio'];

    }


    /**
     * se è settato restituisce il costo del biglietto su una variabile
     * @author Riccardo
     * @return mixed
     */
    public function getCostoBiglietto()
    {
        if (isset($_REQUEST['costobiglietto']))
            return  $costo = $_REQUEST['costobiglietto'];
    }


    /**
     * restituisci su un array i dati della citta acquisiti dal template
     * @author Riccardo
     * @return array
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
        return $dati;
    }


    /**
     * se è settato restituisce l'id del commento su una variabile
     *
     * @return mixed
     */
    public function getIdCommento()
    {
        if (isset($_REQUEST['idcommento']))
            return $_REQUEST['idcommento'];
        else
            return false;
    }


    //METODI SET:


    /**
     * imposta il layout
     * @param string $layout
     *
     * @return string
     */
    public function setLayout($layout)
    {
        $this->_layout=$layout;
    }


    //ALTRI METODI:


    /**
     * processa il template secondo il layout precedentemente selezionato
     *
     * @return string
     */
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
    public function impostaDati($key,$valore)
    { //chiave , valore
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

}
?>