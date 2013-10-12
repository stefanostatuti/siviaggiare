<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.47
 * To change this template use File | Settings | File Templates.
 */


// DA FINIRE

class CAdmin
{


    public function smista()
    {
        $view=USingleton::getInstance('VRegistrazione');
        switch ($view->getTask())
        {
            case 'segnalazioni':
                return $this->VisualizzaSegnalazioniTable();

            case 'dettaglio_segnalazione':
                return $this->VisualizzaSegnalazione();
            case 'gestione_utenti':
                return $this->VisualizzaTuttiUtenti();

            case 'dettaglio_segnalazione_viaggio';
                return $this->VisualizzaSegnalazioneViaggioConPermessi();
            case 'dettaglio_segnalazione_citta';
                return $this->VisualizzaSegnalazioneCittaConPermessi();
            case 'dettaglio_segnalazione_luogo';
                return $this->VisualizzaSegnalazioneLuogoConPermessi();
            case 'dettaglio_segnalazione_commento';
                return $this->VisualizzaSegnalazioneCommentoConPermessi();
            case 'dettaglio_utente':
                return $this->ProfiloUtente();

            //eliminazioni
            case 'elimina_utente':
                return $this->EliminaUtente();

            //modifiche
            case 'modifica_utente':
                return $this->ModificaUtente();
            case 'promuovi_utente':
                return $this->PromuoviUtente();
            case 'mandaAvvertimento':
                return $this->MandaAvvertimento();
        }
    }


    //VISUALIZZAZIONE TABLE
    public function VisualizzaSegnalazioniTable()
    {
        //questa versiona ELIMINA I CLONI
        //$session=USingleton::getInstance('USession');
        //$admin=$session->leggi_valore('username');
        $EAdmin = new EAdmin();
        $lista_Segnalazioni=$EAdmin->getElencoSegnalazioni(); //qua recupero TUTTE le segnalazioni del DB
        //debug("\n lista_Segnalazioni: ".count($lista_Segnalazioni));
        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('elenco_segnalazioni');
        $VAdmin->impostaDati('results',$lista_Segnalazioni);
        return $VAdmin->processaTemplate();
    }

    public function VisualizzaTuttiUtenti(){
        //$EAdmin = new EAdmin();
        $FUtente = new FUtente();
        $Utenti = $FUtente->CaricaTutto();
        //debug("\n lista_Segnalazioni: ".count($lista_Segnalazioni));
        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('elenco_utenti');
        $VAdmin->impostaDati('utente',$Utenti);
        return $VAdmin->processaTemplate();
    } // questa deve essere convertita in table mi sa :(

    //VISUALIZZAZIONE IN DETTAGLIO
    public function VisualizzaSegnalazione()
    {
        $VAdmin=USingleton::getInstance('VAdmin');
        //$FAdmin=new FAdmin();
        $FSegnalazione= new FSegnalazione();
        //var_dump("----->".$VAdmin->getIdSegnalazione()); //ok
        $segnalazione=$FSegnalazione->loadSegnalazione($VAdmin->getIdSegnalazione());
        //$segnalazione=$FSegnalazione->loadRicerca( "idsegnalazione",$VAdmin->getIdSegnalazione()); ok ma non è un oggetto da passare al tpl
        //var_dump($segnalazione);
        $VAdmin->setLayout('dettagli_segnalazione'); //<---- // tpl creato ma da modificare
        $VAdmin->impostaDati('segnalazione',$segnalazione);
        //debug($segnalazione);
        return $VAdmin->processaTemplate();
    }

    public function VisualizzaSegnalazioneViaggioConPermessi()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->load($VViaggio->getIdViaggio());

        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('dettagli_viaggio');
        $VAdmin->impostaDati('viaggio',$viaggio);
        return $VAdmin->processaTemplate();
    }

    public function VisualizzaSegnalazioneCittaConPermessi()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCitta=new FCitta();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeCitta());//chiave (id viaggio,nome della citta)
        //debug($key);
        $citta=$FCitta->loadCitta($key);

        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('dettagli_citta');
        $VAdmin->impostaDati('citta',$citta);
        return $VAdmin->processaTemplate();
    }

    public function VisualizzaSegnalazioneLuogoConPermessi()
    {   $VViaggio=USingleton::getInstance('VViaggio');
        $FLuogo=new FLuogo();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeLuogo(),'nomecitta'=>$VViaggio->getNomeCitta());
        $luogo=$FLuogo->loadLuogo($key);

        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('dettagli_luogo');
        $VAdmin->impostaDati('luogo',$luogo);
        return $VAdmin->processaTemplate();
    }

    public function VisualizzaSegnalazioneCommentoConPermessi()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCommento=new FCommento();
        $commento=$FCommento->loadCommento($VViaggio->getIdCommento());

        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('dettagli_commento');
        $VAdmin->impostaDati('commento',$commento);
        return $VAdmin->processaTemplate();
    }

    public function ProfiloUtente(){
        $VViaggio=USingleton::getInstance('VViaggio');
        $FUtente = new FUtente();
        $Utente = $FUtente->load($VViaggio->getNomeUtente());

        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('dettagli_utente');
        $VAdmin->impostaDati('utente',$Utente);
        return $VAdmin->processaTemplate();
    }

    //MODIFICHE
   /*public function PromuoviUtente(){
        //carico un metodo di EAdmin
        debug("ci entro in promuovi utente?");
        $VAdmin= USingleton::getInstance('VAdmin');
        $EAdmin = new EAdmin();
        $esito= $EAdmin->PromuoviUtente(V);
        var_dump("var_dump utente: ".$Utente);
        debug("debug utente: ".$Utente);
        $utentedaeliminare=$FUtente->load($Utente);//prendo l'oggetto dal db
        $VAdmin=USingleton::getInstance('VAdmin');
        $Cancellato = $FUtente->delete($utentedaeliminare);//e lo elimino
        $VAdmin->setLayout('dettagli_utente_promosso');//da fare il tp
        $VAdmin->impostaDati('cancellato',$Cancellato);
        return $VAdmin->processaTemplate();}*///non FINITO

   public function MandaAvvertimento(){
       debug("entro in MandaAvvertimento");
       //$FAdmin=USingleton::getInstance('FAdmin');
       $VViaggio=USingleton::getInstance('VViaggio');
       //$EUtente=USingleton::getInstance('EUtente');
       $FUtente=USingleton::getInstance('FUtente');
       //$utente=$EUtente->load($VViaggio->getNomeUtente());
       $utente=$FUtente->load($VViaggio->getNomeUtente());
       $utente->avvertimenti++;
       var_dump($utente->avvertimenti);

       //mando una mail da sistemare
       /*try {
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
       catch{
           debug("mail non inviata");
            }
        //end mail
*/
      return 1;

   }//non finito

    //ELIMINAZIONI
    /*non funziona perche tramite il pulsante non so come far passare il nome utente*/
    public function EliminaUtente(){
        debug("ci entro?");
        $VViaggio=USingleton::getInstance('VViaggio');//credo che qua mi istanzi una nuova istanza e cosi non ha il nome utente
        $FUtente = new FUtente();
        $Utente = $FUtente->load($VViaggio->getNomeUtente());//qua recupero l'username MA NON LO FA!!!
        var_dump("var_dump utente: ".$Utente);
        debug("debug utente: ".$Utente);
        $utentedaeliminare=$FUtente->load($Utente);//prendo l'oggetto dal db
        $VAdmin=USingleton::getInstance('VAdmin');
        $Cancellato = $FUtente->delete($utentedaeliminare);//e lo elimino
        $VAdmin->setLayout('dettagli_utente_eliminato');
        $VAdmin->impostaDati('cancellato',$Cancellato);
        return $VAdmin->processaTemplate();
    }
}
?>