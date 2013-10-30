<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.45
 * To change this template use File | Settings | File Templates.
 */

class CProfilo
{

    private $_errore = '';
    


    public function smista()
    {
        $view=USingleton::getInstance('VProfilo');
        switch ($view->getTask())
        {  
            case 'modifica':
                return $this->ImpostaPaginaProfilo();   
            case 'messaggi':
                return $this->CaricaMessaggi();       
            case 'visualizza':
                return $this->VisualizzaInfo();
            case 'galleria':
                return $this->VisualizzaGalleria();    
        }
    }
    
    
    public function VisualizzaInfo()
    {
         $view=USingleton::getInstance('VProfilo');
         $session=USingleton::getInstance('USession');
         $view->setLayout('profilo_dettagli');
         //fare query passare valori 
         $Futente=USingleton::getInstance('FUtente');
         $username=$session->leggi_valore('username');
         $dati_utente=$Futente->load($username);
         //trasformo oggetto in array
         $utente['nome']=$dati_utente->nome;
         $utente['cognome']=$dati_utente->cognome;
         $utente['residenza']=$dati_utente->residenza;
         $utente['nazione']=$dati_utente->nazione;
         $utente['datanascita']=$dati_utente->datanascita;
         $utente['mail']=$dati_utente->mail;
         $utente['telefono']=$dati_utente->telefono;
         $utente['lavoro']=$dati_utente->lavoro;
         $utente['sesso']=$dati_utente->sesso;
         $view->impostaDati('profilo',$utente);
         $view->impostaDati('scope','readonly');
         return $view->processaTemplate();
    }
    
    
    public function CaricaMessaggi()
    {
         $view=USingleton::getInstance('VProfilo');
         $session=USingleton::getInstance('USession');
         $view->setLayout('profilo_messaggi');
         //fare query passare valori 
         $Futente=USingleton::getInstance('FUtente');
         $username=$session->leggi_valore('username');
         $dati_utente=$Futente->load($username);
         //trasformo oggetto in array
         $utente=$dati_utente->messaggi;
         //trasformare testo del messaggio in tanti messaggi con l'explode
         $view->impostaDati('messaggi',$utente);
         return $view->processaTemplate();
    }
    
    
    public function VisualizzaGalleria()
    {
         $view=USingleton::getInstance('VProfilo');
         $session=USingleton::getInstance('USession');
         $view->setLayout('profilo_galleria');
         //fare query passare valori 
         $Futente=USingleton::getInstance('FUtente');
         $username=$session->leggi_valore('username');
         $dati_utente=$Futente->load($username);
         //trasformo oggetto in array
         $utente=$dati_utente->foto;//non è ancora abilitato il campo image in sql
         //trasformare testo del messaggio in tanti messaggi con l'explode
         $view->impostaDati('foto',$utente);
         return $view->processaTemplate();
    }

}
?>   