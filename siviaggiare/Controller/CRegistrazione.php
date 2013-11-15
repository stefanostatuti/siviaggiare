<?php
/**
 * @access public
 * @package Controller
 */
class CRegistrazione
{

    /**
     * @var $_username Variabile usata per fare controllo sull'esistenza dell'user
     */
    private $_username = null;
    /**
     * @var $_password Variabile usata per fare controllo sulla password inserita
     */
    private $_password = null;
    /**
     * @var $_admin Variabile usata per fare controllo sul tipo di user
     */
    private $_admin = null;
    /**
     * @var $_errore Variabile usata per la visualizzazione dei messaggi d'errore
     */
    private $_errore = '';


    /**
    * Smista le richieste ai vari metodi
    *
    * @return mixed
    */
    public function smista()
    {
        $view=USingleton::getInstance('VRegistrazione');
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
            case 'verifica_registrazione':
                return $this->ProcessaAjaxUser();
            default:
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->impostaPaginaRicerca();
        }
    }


    /**
    * Crea un utente sul database controllando che non esista già
    *
    * @return string
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
        $valida->validacampi($dati_registrazione);
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
            $utente=$FUtente->load($dati_registrazione['username']);
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


    /**
     * Imposta la pagina con form registrazione
     *
     * @return string
     */
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
    {
        $autenticato=false;
        $session=USingleton::getInstance('USession');
        $VRegistrazione= USingleton::getInstance('VRegistrazione');
        $task=$VRegistrazione->getTask();
        $controller=$VRegistrazione->getController();
        $this->_username=$VRegistrazione->getUsername();
        $this->_password=$VRegistrazione->getPassword();
        if ($session->leggi_valore('username')!=false)
        {
            $autenticato=true;
        }
        elseif ($task=='autentica' && $controller='registrazione')
        {
            $autenticato=$this->autentica($this->_username, $this->_password);
            //$VRegistrazione->unsetControllerTask();
        }
        if ($task=='esci' && $controller='registrazione')
        {
            $session=USingleton::getInstance('USession');
            if($session->leggi_valore('username'))
            {
            //logout
                $this->logout();
                $autenticato=false;
            }
            //$VRegistrazione->unsetControllerTask();
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
                else
                {
                    $this->_errore='Username e/o password errati';
                    return false;
                }
            }
        }
        $FUtente=new FUtente();
        $utente=$FUtente->load($username);
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
                }
            } else
            {
                $this->_errore='L\'account non &egrave; attivo';
            }
        } else
        {
            $this->_errore='Username e/o password errati';
        }
        return false;
    }


    /**
     * Effettua il logout
     */
    public function logout()
    {
        $session=USingleton::getInstance('USession');
        if($session->leggi_valore('username'))
        {
            $session->cancella_valore('username');
            $session->cancella_valore('nome_cognome');
            $session->cancella_valore('admin');
            $session->chiudi();
        }
    }


    /**
     * Imposta il layout per il recupero della password
     * @return string
     */
    public function recuperaPassword()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('recupero_password');
        return $VRegistrazione->processaTemplate();
    }


    /**
     * Verifica le credenziali per il rinvio della password tramite mail
     * @return string
     */
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


    /**
     * Invia la mail per il recupero della password
     * @global array $config
     */
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
    public function attivazione()
    {
        $view = USingleton::getInstance('VRegistrazione');
        $dati_attivazione=$view->getDatiAttivazione();
        $FUtente=new FUtente();
        $utente=$FUtente->load($dati_attivazione['username']);
        if ($dati_attivazione!=false)
        {
            if ($utente->getCodiceAttivazione()==$dati_attivazione['codice'])
            {
                $utente->stato='attivo';
                $FUtente->update($utente);
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
        global $config;
        $view=USingleton::getInstance('VRegistrazione');
        $view->setLayout('email_attivazione');
        $view->impostaDati('username',$utente->username);
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('codice_attivazione',$utente->getCodiceAttivazione());
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        $view->impostaDati('url',$config['url_siviaggiare']);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->mail,$utente->nome.' '.$utente->cognome,'Attivazione account YesYoutravel',$corpo_email);
    }


    /**
     * codifica i dati per processare la chiamata ajax su richiesta del controllo dell'esistenza di un user in db
     * @author Riccardo
     * @return string
     */
    public function ProcessaAjaxUser()
    {
        if(! $this->verificausername())
        {
            echo json_encode(true);
        }else
        {
            echo json_encode(false);
        }
    }


    /**
     * esegue il controllo dell'esistenza di un user in db
     * @author Riccardo
     * @return boolean
     */
    public function verificausername()
    {
        $View=USingleton::getInstance('VRegistrazione');
        $username = $View->getUsername();
        $FUtente=USingleton::getInstance('FUtente');
        $confronto = $FUtente->load($username);
        if($confronto !=null)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }

    }

}
?>