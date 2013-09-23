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
    private $_contenuto_laterale_sinistro;



           //metodi pubblic:


    public function getController()
    {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }


    /*public function mostraPaginaIniziale()
    {
        //$this->assign('right_content',$this->_side_content);
        //$this->assign('tasti_laterali',$this->_side_button);
        $this->display('home_default.tpl');
    }*/


    /**
     * Assegna il contenuto al template e lo manda in output
     */
    public function mostraPagina()
    {
        $this->assign('contenuto_principale',$this->_contenuto_principale);
        $this->assign('contenuti_menu_destro1',$this->_contenuto_laterale_destro);
        $this->assign('contenuti_menu_sinistro1',$this->_contenuto_laterale_sinistro);
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
        //$this->assign('content_title','Benvenuto ospite');
        //$this->assign('contenuto_principale',$this->_contenuto_principale);
        //$this->assign('menu',$this->_main_button);
        $this->aggiungiModuloLogin();
        $this->aggiungiModuloAboutRegistrazione();
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
        $this->_contenuto_laterale_sinistro.=$modulo_about;
    }


    /**
     * Imposta la pagina per gli utenti registrati/autenticati
     */
    public function impostaPaginaAutenticato()
    {
        //$session=USingleton::getInstance('USession'); //variabile non usata
        $this->assign('titolo','YesYouTravel - Home Loggato');
        $this->aggiungiModuloAutenticato();
    }

    public function impostaPaginaAdmin()
    {
        //$session=USingleton::getInstance('USession');
        $this->assign('titolo','YesYouTravel - Home Admin'); //forse si sovrascrive con quella dell'utente
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


    /*QUESTO METODO ANDRA TOLTO PERCHE CI ANDRA IL MODULO PER LA RICERCA (IN ALTRA CLASSE)*/
    public function mostraESEMPIOCSS()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('ESEMPIOCSS');
        return $modulo_esempioCSS=$VRegistrazione->processaTemplate();
    }
}
?>