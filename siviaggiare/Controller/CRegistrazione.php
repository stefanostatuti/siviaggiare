<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.45
 * To change this template use File | Settings | File Templates.
 */

class CRegistrazione {
    //sono i campi che arrivano con il post
    private $_username = null;
    private $_password = null;
    private $_errore = '';
    //end
    public function smista() {
        //$registrato=$this->getUtenteRegistrato();
        $view=USingleton::getInstance('VRegistrazione');
        switch ($view->getTask()) {
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
    public function creaUtente() {
        $view=USingleton::getInstance('VRegistrazione');
        $dati_registrazione=$view->getDatiRegistrazione();
        $utente=new EUtente();
        $FUtente=new FUtente();
        $confronto = $FUtente->load($dati_registrazione['username']);
        $dati_registrazione['confronto']=$confronto;
        $valida=USingleton::getInstance('Vvalidazione');
        $dati_validazione=$valida->validacampi($dati_registrazione);
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
    public function getUtenteRegistrato() {
        $autenticato=false;
        $session=USingleton::getInstance('USession');
        $VRegistrazione= USingleton::getInstance('VRegistrazione');
        $task=$VRegistrazione->getTask();
        $controller=$VRegistrazione->getController();
        $this->_username=$VRegistrazione->getUsername();
        $this->_password=$VRegistrazione->getPassword();
        if ($session->leggi_valore('username')!=false)
            $autenticato=true;
        elseif ($task=='autentica' && $controller='registrazione') {
            $autenticato=$this->autentica($this->_username, $this->_password);
        }
        if ($task=='esci' && $controller='registrazione') {
            //logout
            $this->logout();
            $autenticato=false;
            $VHome=USingleton::getInstance('VHome');
        }
        $VRegistrazione->impostaErrore($this->_errore);
        $this->_errore='';
        return $autenticato;
    }

    /**
     * Controlla se una coppia username e password corrispondono ad un utente regirtrato ed in tal caso impostano le variabili di sessione relative all'autenticazione
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function autentica($username, $password) {
        $FUtente=new FUtente();
        $utente=$FUtente->load($username);
        if ($utente!=false) {
            if ($utente->getAccountAttivo()) {
                //account attivo
                if ($username==$utente->username && $password==$utente->password) {
                    //debug("Sto nell'IF");
                    $session=USingleton::getInstance('USession');
                    $session->imposta_valore('username',$username);
                    $session->imposta_valore('nome_cognome',$utente->nome.' '.$utente->cognome);
                    return true;
                } else
                {
                    $this->_errore='Password errata';
                    //username password errati
                }
            } else {
                $this->_errore='L\'account non &egrave; attivo';
                //account non attivo
            }
        } else {
            $this->_errore='Username e/o password errati';
            //account non esiste
        }
        return false;
    }

    /**
     * EfFettua il logout
     */
    public function logout() {
        //debug("Sto in logout");
        $session=USingleton::getInstance('USession');
        //unset($_POST);
        //var_dump($_REQUEST);
        $session->cancella_valore('username');
        $session->cancella_valore('nome_cognome');
        $session->chiudi();
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
                $this->emailRecuperoPassword($utente);
                $view->setLayout('conferma_mail_recupero_password');
                return $view->processaTemplate();
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

    public function emailRecuperoPassword(EUtente $utente) {
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
                $view->impostaDati('ok sei attivato');

            } else
            {
                //$view->impostaErrore('Il codice di attivazione &egrave; errato');
                $view->setLayout('attivato');
                $view->impostaDati('errore attivazione');
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
        global $config;//il $config e relativo alle directory di smarty:es smarty template_c
        $view=USingleton::getInstance('VRegistrazione');
        $view->setLayout('email_attivazione');//setlayaout fa parte del file vregistrazione
        $view->impostaDati('username',$utente->username);//impostadati serve per impostare i template da vregistrazione
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('codice_attivazione',$utente->getCodiceAttivazione());//getcodiceattiva. deriva dal file Eutente
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        $view->impostaDati('url',$config['url_yesyoutravel']);
        $corpo_email=$view->processaTemplate();//da provare!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->mail,$utente->nome.' '.$utente->cognome,'Attivazione account YesYoutravel',$corpo_email);
    }
}
?>
