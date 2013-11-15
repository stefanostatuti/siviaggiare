<?php

class VProfilo extends View
{

    private $_layout='default';


    /**
     * Imposta i dati nel template identificati da una chiave ed il relativo valore
     * @author Riccardo
     * @param string $key
     * @param mixed $valore
     * @return mixed
     */
    public function impostaDati($key,$valore)
    {
        $this->assign($key,$valore);
    }


    /**
     * Restituisce il task
     * @author Riccardo
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
     * @author Riccardo
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
     * Restituisce l'utente
     * @author Riccardo
     * @return mixed
     */
    public function getUtente()
    {
        if (isset($_REQUEST['utente']))
            return $_REQUEST['utente'];
        else
            return false;
    }


    /**
     * Restituisce il valore della label
     * @author Riccardo
     * @return mixed
     */
    public function getCampo()
    {
        if (isset($_REQUEST['campo']))
            return $_REQUEST['campo'];
        else
            return false;
    }


    /**
     * Restituisce restituisce il nome della foto della galleria
     * @author Riccardo
     * @return mixed
     */
    public function getFotoGalleria()
    {
        if(isset($_FILES["foto"]['name']))
        {
            $session=USingleton::getInstance('USession');
            $user=$session->leggi_valore('username');
            $upload_dir = "templates/main/template/images/galleria"; // cartella in cui il file sarà salvato
            $file_name = str_replace(" ","",$_FILES["foto"]["name"]);
            $file_name=$user.$file_name;
            if(@is_uploaded_file($_FILES["foto"]["tmp_name"]))
            {
                @move_uploaded_file(str_replace(" ","",$_FILES["foto"]["tmp_name"]), "$upload_dir/$file_name");
                return $file_name;
            }else
            {
                return false;
            }
        }
    }


    /**
     * Restituisce la foto del profilo
     * @author Riccardo
     * @return mixed
     */
    public function getFotoProfilo()
    {
        if(isset($_FILES["foto_profilo"]['name']))
        {
            $session=USingleton::getInstance('USession');
            $user=$session->leggi_valore('username');
            $upload_dir = "templates/main/template/images/foto_profilo"; // cartella in cui il file sarà salvato
            $file_name = str_replace(" ","",$_FILES["foto_profilo"]["name"]);
            $file_name=$user.$file_name;
            if(@is_uploaded_file($_FILES["foto_profilo"]["tmp_name"]))
            {
                @move_uploaded_file(str_replace(" ","",$_FILES["foto_profilo"]["tmp_name"]), "$upload_dir/$file_name");
                return $file_name;
            }else
            {
                return false;
            }
        }
    }


    /**
     * Restituisce un controllo per la ricerco
     * @return mixed
     */
    public function getNumeroPagina()
    {
        if (isset($_REQUEST['pagina']))
            return $_REQUEST['pagina'];
        else
            return false;
    }


    /**
     * Restituisce il tipo di label
     * @author Riccardo
     * @return mixed
     */
    public function getLabel()
    {
        if (isset($_REQUEST['label']))
            return $_REQUEST['label'];
        else
            return false;
    }


    /**
     * Processa i dati nel template
     * @author Riccardo
     * @return mixed
     */
    public function processaTemplate()
    {
        $contenuto=$this->fetch('registrazione_'.$this->_layout.'.tpl');
        return $contenuto;
    }


    /**
     * Imposta il tipo di layout da caricare
     * @author Riccardo
     * @return mixed
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


}
?>