<?php

class VHome extends View
{

    private $_layout='default';
    private $_contenuto_principale;
    private $_contenuto_laterale_destro;
    private $_contenuto_laterale_sinistro_basso;
    private $_contenuto_laterale_sinistro_alto;


    //METODI PUBLIC:


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
     * Assegna il contenuto al template e lo manda in output
     * @return mixed
     */
    public function mostraPagina()
    {
        $this->assign('contenuto_principale',$this->_contenuto_principale);
        $this->assign('contenuti_menu_destro1',$this->_contenuto_laterale_destro);
        $this->assign('contenuti_menu_sinistro1',$this->_contenuto_laterale_sinistro_alto);
        $this->assign('contenuti_menu_sinistro2',$this->_contenuto_laterale_sinistro_basso);
        $this->display('home_'.$this->_layout.'.tpl');
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
     * imposta il contenuto principale alla variabile privata della classe
     * @return mixed
     */
    public function impostaContenuto($contenuto)
    {
        $this->_contenuto_principale=$contenuto;
    }


    /**
     * imposta il template pre l'utente non loggato
     * @return mixed
     */
    public function impostaPaginaOspite()
    {
        $this->assign('titolo','YesYouTravel - Home');
        $this->aggiungiModuloRicerca();
        $this->aggiungiModuloLogin();
        $this->aggiungiModuloAboutRegistrazione();
    }


    /**
     * aggiunge il modulo del login al template
     * @return mixed
     *
     */
    public function aggiungiModuloLogin()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('login');
        $modulo_login=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_sinistro_alto.=$modulo_login;

    }


    /**
     * aggiunge il modulo banner per favorire la registrazione di un utente al template
     * @return mixed
     *
     */
    public function aggiungiModuloAboutRegistrazione()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('about');
        $modulo_about=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_sinistro_basso.=$modulo_about;
    }


    /**
     * Imposta la pagina per gli utenti registrati/autenticati
     * @return mixed
     */
    public function impostaPaginaAutenticato()
    {
        $session=USingleton::getInstance('USession');
        if($session->leggi_valore('admin')=='Amministratore')
        {
            $this->impostaPaginaAdmin();
        }
        else
        {
            $this->assign('titolo','YesYouTravel - Home Loggato');
            $this->aggiungiModuloAutenticato();
            $this->aggiungiModuloRicerca();
            $this->aggiungiModuloProfilo();

        }
    }


    public function impostaPaginaAdmin()
    {
        $this->assign('titolo','YesYouTravel - Home Admin');
        $this->aggiungiModuloAdmin();
    }


    /**
     * aggiunge il modulo al template per indicare all'utente che è autenticato
     * @return mixed
     *
     */
    public function aggiungiModuloAutenticato()
    {
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('autenticato');
        $VRegistrazione->impostaDati('username',$username);
        $modulo_logout=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_sinistro_basso.=$modulo_logout;
    }


    public function aggiungiModuloAdmin()
    {
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('admin_autenticato');
        $VRegistrazione->impostaDati('username',$username);
        $modulo_logout=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_sinistro_alto.=$modulo_logout;
    }


    /**
     * aggiunge il modulo del profilo al template
     *  @author Riccardo
     * @return mixed
     *
     */
    public function aggiungiModuloProfilo()
    {
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $Futente=USingleton::getInstance('FUtente');
        $dati_utente=$Futente->load($username);
        $utente['foto']=$dati_utente->foto;
        $VRegistrazione->setLayout('profilo');
        $VRegistrazione->impostaDati('username',$username);
        $VRegistrazione->impostaDati('foto',$utente['foto']);
        $modulo_logout=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_sinistro_alto.=$modulo_logout;
    }


    /**
     * aggiunge il modulo della ricerca al template
     *  @author Francesco
     * @return mixed
     *
     */
    public function aggiungiModuloRicerca()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('menu_ricerca_laterale');
        $FCitta= new FCitta;
        $citta=$FCitta->loadRicercaFeedbackLimite(5);
        $VRicerca->impostaDati('cittafeedback',$citta);
        $citta=$FCitta->loadLastCitta(5);
        $VRicerca->impostaDati('ultimecitta',$citta);
        $FLuogo= new FLuogo;
        $luogo=$FLuogo->loadRicercaFeedbackLimite(5);
        $VRicerca->impostaDati('luogofeedback',$luogo);
        $luogo=$FLuogo->loadLastLuoghi(5);
        $VRicerca->impostaDati('ultimiluoghi',$luogo);
        $modulo_ricerca=$VRicerca->processaTemplate();
        $this->_contenuto_laterale_destro.=$modulo_ricerca;

    }


    /**
     * processa il template secondo il layout precedentemente selezionato
     *
     * @return string
     */
    public function processaTemplate($layout)
    {
        return $this->fetch($layout);
    }
}
?>