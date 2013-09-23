<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.45
 * To change this template use File | Settings | File Templates.
 */

class CRegistrazione
{

    //sono i campi che arrivano con il post
    private $_username = null;
    private $_password = null;
    private $_admin = null;
    private $_errore = '';
    //end


    public function smista()
    {
        //$registrato=$this->getUtenteRegistrato();
        //debug("ci entro qui?");
        $view=USingleton::getInstance('VRegistrazione');
        //var_dump("->".$view->getTask());
        switch ($view->getTask())
        {
            case 'recupera_password':
                return $this->recuperaPassword();
            case 'registra':
                return $this->impostaPaginaRegistrazione();
            case 'salva':
                return $this->creaUtente();
            case 'attivazione':
                return $this->attivazione();
            case 'verifica_dati':
                return $this->verificaRinvioPassword();
            default:
                $VHome=USingleton::getInstance('VHome');
                return $VHome->mostraESEMPIOCSS();
        }
    }


    /**
     * Crea un utente sul database controllando che non esista già
     *
     * @return mixed
     */
    public function creaUtente()
    {
        $view=USingleton::getInstance('VRegistrazione');
        $dati_registrazione=$view->getDatiRegistrazione();
        $utente=new EUtente();
        $FUtente=new FUtente();
        $confronto = $FUtente->load($dati_registrazione['username']);
        $dati_registrazione['confronto']=$confronto;
        $valida=USingleton::getInstance('Vvalidazione');
        //$dati_validazione=$valida->validacampi($dati_registrazione); //variabile non usata
        if(!$valida->getErrors())
        {
            unset($dati_registrazione['password_1']);
            unset($dati_registrazione['confronto']);//serve solo per la validazione
            $keys=array_keys($dati_registrazione);
            $i=0;
            foreach ($dati_registrazione as $dato)
            {
                $utente->$keys[$i]=$dato;
                $i++;
            }
            $utente->generaCodiceAttivazione();
            $FUtente->store($utente);
            $email = $this->emailAttivazione($utente);
            if($email)
            {
                $view->setLayout('conferma');
                return $view->processaTemplate();
            }
            else
            {
                $view->setLayout('modulo');
                $dati=$valida->getErrors();
                //var_dump($dati);
                $view->impostaDati('messaggi' , $dati);
                $datiutente=$valida->getdatipersonali();
                $view->impostaDati('persona', $datiutente);
                $this->_errore='email non inviata';
                $view->impostaErrore($this->_errore);
                $this->_errore='';
                $return = $view->processaTemplate();
                $view->impostaErrore('');
                return $return;
            }

            $view->setLayout('conferma');
            return $view->processaTemplate();
        }else
        {
            $view->setLayout('modulo');
            $dati=$valida->getErrors();
            //var_dump($dati);
            $view->impostaDati('messaggi' , $dati);
            $datiutente=$valida->getdatipersonali();
            $view->impostaDati('persona', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $return = $view->processaTemplate();
            $view->impostaErrore('');
            return $return;
        }
    }


    public function impostaPaginaRegistrazione()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('modulo');
        return $VRegistrazione->processaTemplate();
    }


    /**
     * Controlla se l'utente è registrato ed autenticato
     *
     * @return boolean
     */
    public function getUtenteRegistrato()
    {   debug("entro in getUtenteRegistrato");
        $autenticato=false;
        $session=USingleton::getInstance('USession');
        $VRegistrazione= USingleton::getInstance('VRegistrazione');
        $task=$VRegistrazione->getTask();
        //var_dump("task: ".$task);
        //$controller=$VRegistrazione->getController(); //variabile non usata
        $this->_username=$VRegistrazione->getUsername();
        $this->_password=$VRegistrazione->getPassword();
        if ($session->leggi_valore('username')!=false)
        {
            $autenticato=true;
        }

        elseif ($task=='autentica' && $controller='registrazione')
        {
            $autenticato=$this->autentica($this->_username, $this->_password);
        }

        if ($task=='esci' && $controller='registrazione')
        {//verifico se gia ci sono passato e mi è rimasto il controller controllando se c'è l'username
            $session=USingleton::getInstance('USession');
            if($session->leggi_valore('username'))
            {
            //logout
            debug("ci entro?");
            $this->logout();
            $autenticato=false;
            }
            else if($session->leggi_valore('username')==false) //quindi sono state cancellate
            {
                ; //non faccio nulla
            }
        //$VHome=USingleton::getInstance('VHome'); //variabile non usata

        }
        $VRegistrazione->impostaErrore($this->_errore);
        $this->_errore='';
        return $autenticato;
    }


    /**
     * Controlla se l'utente è Admin ed autenticato
     *
     * @return boolean
     */
    public function getAdmin()
    {
        $autenticato=0; //metto di default 0
        $session=USingleton::getInstance('USession');
        $VRegistrazione= USingleton::getInstance('VRegistrazione');
        $task=$VRegistrazione->getTask();
        //$controller=$VRegistrazione->getController(); //variabile non usata
        //$this->_username=$VRegistrazione->getUsername();
        //$this->_password=$VRegistrazione->getPassword();
        $this->_admin=$VRegistrazione->getAdmin();
        if ($session->leggi_valore('username')!=false)
        {   //qua controllo se è admin
            if($session->leggi_valore('admin')!= false){
                $autenticato=1;
            }
            else{
            $autenticato=0;
            }
        }

/*
 * FUNZIONA MA RIMANE
 * inoltre mi carica il tpl amministratore SOLO se faccio aggiorna*/

         elseif ($task=='autentica' && $controller='registrazione')
              {
                    $autenticato=$this->autentica($this->_username, $this->_password);
              }

              if ($task=='esci' && $controller='registrazione')
              {
                    //logout
                    $this->logout();
                    $autenticato=false;
                    //$VHome=USingleton::getInstance('VHome'); //variabile non usata
              }
        $VRegistrazione->impostaErrore($this->_errore);
        $this->_errore='';
        return $autenticato;
    }

    /**
     * Controlla se una coppia username e password corrispondono ad un utente registrato ed in tal caso impostano le variabili di sessione relative all'autenticazione
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function autentica($username, $password)
    {
        //vedo se è un amministratore
        debug("controllo se admin");
        $FAdmin=new FAdmin();
        $utente=$FAdmin->load($username);
        if ($utente!=false)
        {
            if ($utente->getAccountAmministratore()==true)
            {
             //account amministratore
                if ($username==$utente->username && $password==$utente->password)
                {
                    if ($utente->stato=='admin')
                    {
                    $session=USingleton::getInstance('USession');
                    $session->imposta_valore('admin', 'Amministratore');
                    $session->imposta_valore('username',$username);
                    //$session->imposta_valore('nome_cognome',$utente->nome.' '.$utente->cognome);
                    return true;
                    }
                }
                else{
                    $this->_errore='Username e/o password errati'; //OK
                    return false;
                }
            }
            else if ($utente->getAccountAmministratore()==false)//se non è un amministratore
            {
                Debug("utente esistente ma NON è amministratore");
            }
        }
        //fine test

        //non è amministatore vedo se è un utente comune
        //debug("NON e' un admin, controllo se è un utente");
        /*
        in teoria sono inutili visto che ho fatto la query sopra
        //$FUtente=new FUtente();
        //$utente=$FUtente->load($username);
        */
        if ($utente!=false)
        {
            if ($utente->getAccountAttivo())
            {
                //account attivo
                if ($username==$utente->username && $password==$utente->password)
                {
                    $session=USingleton::getInstance('USession');
                    $session->imposta_valore('username',$username);
                    $session->imposta_valore('nome_cognome',$utente->nome.' '.$utente->cognome);
                    return true;
                } else
                {
                    $this->_errore='Password errata';
                    //username password errati

                }
            } else
            {
                $this->_errore='L\'account non &egrave; attivo';
                //account non attivo
            }
        } else
        {
            $this->_errore='Username e/o password errati';
            //account non esiste
        }
        return false;
    }



    /**
     * Effettua il logout
     */
    public function logout()
    {
        debug("Sto in logout");
        $session=USingleton::getInstance('USession');
        if($session->leggi_valore('username'))
        {
            $session->cancella_valore('username');
            $session->cancella_valore('nome_cognome');
            $session->cancella_valore('admin');
            $session->chiudi();
        }
        else
        {
          debug ("sessione gia distrutta");
        }
    }


    public function recuperaPassword()
    {
        //debug("recpass");
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('recupero_password');
        return $VRegistrazione->processaTemplate();
    }


    public function verificaRinvioPassword()
    {
        $view=USingleton::getInstance('VRegistrazione');
        $mail=$view->getEmail();
        $username=$view->getUsername();
        $FUtente=new FUtente();
        $utente=$FUtente->load($username);
        if($utente!=false)
        {
            if($utente->mail==$mail)
            {
                $email=$this->emailRecuperoPassword($utente);
                //aggiungere validazione inoltro mail
                if($email)
                {
                    $view->setLayout('conferma_mail_recupero_password');
                    return $view->processaTemplate();
                }else
                {
                    $this->_errore='impossibile inoltrare email';
                }
            }
            else $this->_errore='Email errata';
        }
        else $this->_errore='Username non esistente';
        $view->impostaErrore($this->_errore);
        $this->_errore='';
        $view->setLayout('recupero_password');
        $result=$view->processaTemplate();
        $view->impostaErrore('');
        return $result;
    }



    public function emailRecuperoPassword(EUtente $utente)
    {
        global $config;
        $view=USingleton::getInstance('VRegistrazione');
        $view->setLayout('email_recupero_password');
        $view->impostaDati('username',$utente->username);
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('password',$utente->password);
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        //$view->impostaDati('url',$config['url_bookstore']);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->mail,$utente->nome.' '.$utente->cognome,'Recupero Password YesYouTravel',$corpo_email);
    }


    /**
     * Attiva un utente che inserisce un codice di attivazione valido oppure clicca sul link di autenticazione nell'email
     *
     * @return string
     */
    public function attivazione() //questa parte, quando la precedente esegue il tpl email_att. e nel tpl c'e il controller e il task autentica
    {
        $view = USingleton::getInstance('VRegistrazione');
        $dati_attivazione=$view->getDatiAttivazione();//getdatiattiv. è in vregistra.
        $FUtente=new FUtente();
        $utente=$FUtente->load($dati_attivazione['username']);
        if ($dati_attivazione!=false)
        {
            if ($utente->getCodiceAttivazione()==$dati_attivazione['codice'])
            {
                $utente->stato='attivo';
                $FUtente->update($utente);//funzione del file fdatabase
                $view->setLayout('attivato');
                $view->impostaDati('messaggio' ,'ok sei attivato');

            } else
            {
                //$view->impostaErrore('Il codice di attivazione &egrave; errato');
                $view->setLayout('attivato');
                $view->impostaDati('messaggio','errore attivazione');
            }
        }

        return $view->processaTemplate();
    }


    /**
     * Invia un email contenente il codice di attivazione per un utente appena registrato
     *
     * @global array $config
     * @param EUtente $utente
     * @return boolean
     */
    public function emailAttivazione(EUtente $utente)
    {
        global $config;//il $config e relativo alle directory di smarty:es smarty templates_c
        //var_dump($config['url_siviaggiare']);
        $view=USingleton::getInstance('VRegistrazione');
        $view->setLayout('email_attivazione');//setlayaout fa parte del file vregistrazione
        $view->impostaDati('username',$utente->username);//impostadati serve per impostare i template da vregistrazione
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('codice_attivazione',$utente->getCodiceAttivazione());//getcodiceattiva. deriva dal file Eutente
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        $view->impostaDati('url',$config['url_siviaggiare']);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->mail,$utente->nome.' '.$utente->cognome,'Attivazione account YesYoutravel',$corpo_email);
    }

}
?>
