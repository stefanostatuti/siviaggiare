<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.37
 * To change this template use File | Settings | File Templates.
 */

class VHome extends View
{

    private $_layout='default';
    private $_contenuto_principale;
    private $_contenuto_laterale_destro;
    private $_contenuto_laterale_sinistro_basso;
    private $_contenuto_laterale_sinistro_alto;


           //metodi pubblic:


    public function getController()
    {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }

    public function getTask()
    {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }


    /**
     * Assegna il contenuto al template e lo manda in output
     */
    public function mostraPagina()
    {
        $this->assign('contenuto_principale',$this->_contenuto_principale);
        $this->assign('contenuti_menu_destro1',$this->_contenuto_laterale_destro);
        $this->assign('contenuti_menu_sinistro1',$this->_contenuto_laterale_sinistro_alto);
        $this->assign('contenuti_menu_sinistro2',$this->_contenuto_laterale_sinistro_basso);
        $this->display('home_'.$this->_layout.'.tpl');
    }


    public function impostaDati($key,$valore)
    {
        $this->assign($key,$valore);
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     */
    public function impostaContenuto($contenuto)
    {
        $this->_contenuto_principale=$contenuto;
    }


    public function impostaPaginaOspite()
    {
        $this->assign('titolo','YesYouTravel - Home');
        $this->aggiungiModuloLogin();
        $this->aggiungiModuloAboutRegistrazione();
        $this->aggiungiModuloRicerca();
    }


    public function aggiungiModuloLogin()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('login');
        $modulo_login=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_destro.=$modulo_login;

    }


    public function aggiungiModuloAboutRegistrazione()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('about');
        $modulo_about=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_sinistro_alto.=$modulo_about;
    }


    /**
     * Imposta la pagina per gli utenti registrati/autenticati
     */
    public function impostaPaginaAutenticato()
    {
        $session=USingleton::getInstance('USession');
        if($session->leggi_valore('admin')=='Amministratore') //se è un admin
        {
            $this->impostaPaginaAdmin(); //metto il tpl admin
        }
        else{
            $this->assign('titolo','YesYouTravel - Home Loggato');
            $this->aggiungiModuloAutenticato();
            $this->aggiungiModuloRicerca();
            $this->aggiungiModuloProfilo();

        }
    }

    public function impostaPaginaAdmin()
    {
        //$session=USingleton::getInstance('USession');
        $this->assign('titolo','YesYouTravel - Home Admin');
        $this->aggiungiModuloAdmin();
    }



    public function aggiungiModuloAutenticato()
    {
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('autenticato');
        $VRegistrazione->impostaDati('username',$username);
        $modulo_logout=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_destro.=$modulo_logout;
    }

    public function aggiungiModuloAdmin()
    {
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('admin_autenticato'); //carica il TPL
        $VRegistrazione->impostaDati('username',$username);
        $modulo_logout=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_destro.=$modulo_logout;
    }


    public function aggiungiModuloProfilo()
    {
        $session=USingleton::getInstance('USession');//contenuto laterale sx
        $username=$session->leggi_valore('username');
        $nome=$session->leggi_valore('nome_cognome');
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('profilo');
        $VRegistrazione->impostaDati('username',$username);
        $modulo_logout=$VRegistrazione->processaTemplate();
        $this->_contenuto_laterale_sinistro_alto.=$modulo_logout;
    }


    public function aggiungiModuloRicerca()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('menu_ricerca_laterale');
        $FCitta= new FCitta;
        $citta=$FCitta->loadRicercaFeedbackLimite(5);
        $VRicerca->impostaDati('cittafeedback',$citta);
        $FLuogo= new FCitta;
        $luogo=$FLuogo->loadRicercaFeedbackLimite(5);
        $modulo_ricerca=$VRicerca->processaTemplate();
        $this->_contenuto_laterale_sinistro_basso.=$modulo_ricerca;

    }

    public function processaTemplate($layout)
    {
        return $this->fetch($layout);
    }
}
?>