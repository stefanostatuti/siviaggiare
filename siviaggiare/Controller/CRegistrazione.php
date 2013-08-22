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
            case 'autentica':
                return $this->verificaLogin();
            case 'verifica_dati':
                return $this->verificaRinvioPassword();
            /*default:
                return $this->getUtenteRegistrato();*/
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
        $registrato=false;
        if ($confronto==false) {
            //utente non esiste
            if($dati_registrazione['password_1']==$dati_registrazione['password']) {
                unset($dati_registrazione['password_1']);
                $keys=array_keys($dati_registrazione);
                $i=0;
                foreach ($dati_registrazione as $dato) {
                    $utente->$keys[$i]=$dato;
                    $i++;
                }
                $utente->generaCodiceAttivazione();
                $FUtente->store($utente);
                //$this->emailAttivazione($utente);
                $registrato=true;
            } else {
                return $view->show('errore_password.tpl');
            }
        } else {
            //utente esistente
            return $view->show('username_utilizzato.tpl');
        }
        /*if (!$registrato) {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('modulo');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        } else {*/
            return $view->show('conferma_registrazione.tpl');
        }

    public function impostaPaginaRegistrazione()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->show('registrazione_esempio.tpl');
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
        if ($session->leggi_valore('username')!=false) {
            $autenticato=true;
            //$VRegistrazione->impostaDati('nome',$session->leggi_valore('username'));
            //$VRegistrazione->show('Gia_Autenticato.tpl');
            //autenticato
        } elseif ($task=='autentica' && $controller='registrazione') {
            //controlla autenticazione
            //debug("controllo pwd");
            $autenticato=$this->autentica($this->_username, $this->_password);
            var_dump($autenticato);
            if ($autenticato==true){
                $VRegistrazione->show('Benvenuto.tpl');
           }
        }
        if ($task=='esci' && $controller='registrazione') {
            //logout
            $this->logout();
            $autenticato=false;
            $VHome=USingleton::getInstance('VHome');
            $VHome->mostraPaginaIniziale();
        }
        //$VRegistrazione->impostaErrore($this->_errore);
        //$this->_errore='';
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
        //var_dump($utente);
        if ($utente!=false) {
            //if ($utente->getAccountAttivo()) {
                //account attivo
                if ($username==$utente->username && $password==$utente->password) {
                    //debug("Sto nell'IF");
                    $session=USingleton::getInstance('USession');
                    $session->imposta_valore('username',$username);
                    $session->imposta_valore('nome_cognome',$utente->nome.' '.$utente->cognome);
                    return true;
                } else {
                    $this->_errore='Username o password errati';
                    //username password errati
                }
            //} else {
                //$this->_errore='L\'account non &egrave; attivo';
                //account non attivo
           // }
        } else {
            $this->_errore='L\'account non esiste';
            //account non esiste
        }
        return false;
    }

    /**
     * EfFettua il logout
     */
    public function logout() {
        debug("Sto in logout");
        $session=USingleton::getInstance('USession');
        //unset($_POST);
        //var_dump($_REQUEST);
        $session->cancella_valore('username');
        $session->cancella_valore('nome_cognome');
        $session->chiudi();
        //$VHome=USingleton::getInstance('VHome');
        //$VHome->mostraPaginaIniziale();
    }

    public function verificaLogin()
    {
        $view=USingleton::getInstance('VRegistrazione');
        $password=$view->getPassword();
        $username=$view->getUsername();
        $FUtente=new FUtente();
        $utente=$FUtente->load($username);
        if($utente!=false)
        {
            if($utente->password==$password)
            {
                $this->impostaPaginaLogout();
            }
            else $view->show('login_errore_password.tpl');
        }
        else $view->show('login_errore_username.tpl');
    }

    public function impostaPaginaLogout()
    {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $session=USingleton::getInstance('USession');
        $VRegistrazione->impostaDati('nome',$session->leggi_valore('username'));
        $VRegistrazione->show('Gia_Autenticato.tpl');
    }

    public function recuperaPassword()
    {
        //debug("recpass");
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->show('recupera_password.tpl');
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
                //inviaMail()----------------------Da Fare (Riccardo)
                $view->show('Invio_mail.tpl');
            }
            else $view->show('Recupero_password_Mail_errata.tpl');
        }
        else $view->show('Recupero_password_Username_non_trovato.tpl');
    }

}
?>
