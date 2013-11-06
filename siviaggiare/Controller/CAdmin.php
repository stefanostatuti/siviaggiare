<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.47
 * To change this template use File | Settings | File Templates.
 */


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
            case 'elimina_segnalazione':
                return $this->EliminaSegnalazione();
            case 'elimina_utente':
                return $this->EliminaUtente();
            case 'elimina_viaggio':
                return $this->EliminaViaggio();
            case 'elimina_citta':
                return $this->EliminaCitta();
            case 'elimina_luogo':
                return $this->EliminaLuogo();
            case 'elimina_commento':
                return $this->EliminaCommento();

            //modifiche
            case 'modifica_utente':
                return $this->ModificaUtente(); //NON SCRITTO!!!!
            case 'promuovi_utente':
                return $this->PromuoviUtente();
            case 'degrada_utente':
                return $this->DegradaUtente();
            case 'manda_avvertimento':
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
    }//OK

    public function VisualizzaTuttiUtenti(){
        //$EAdmin = new EAdmin();
        $FUtente = new FUtente();
        $Utenti = $FUtente->CaricaTutto();
        //debug("\n lista_Segnalazioni: ".count($lista_Segnalazioni));
        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('elenco_utenti');
        $VAdmin->impostaDati('utente',$Utenti);
        return $VAdmin->processaTemplate();
    } //FORSE questa deve essere rinominata in table(VisualizzaTuttiUtentiTable ???)

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
        $VAdmin->setLayout('dettagli_segnalazione');
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
        var_dump($luogo);
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
//var_dump($commento);

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
    } //MAI RICHIAMATO POICHE' LO DOVREBBERO AVER FATTO CHECCO E RICCARDO

    //MODIFICHE
   public function PromuoviUtente(){
        //carico un metodo di EAdmin
        debug("ci entro in promuovi utente?");
       $VAdmin = new $VAdmin();
       $nomeutente=$VAdmin->getNomeUtente();
       //$nomeutente=$_GET["nomeutente"];
       debug("nome utente = ");
       var_dump($nomeutente);
       debug("provo a promuoverlo");

       $FUtente=new FUtente();
       $utente=$FUtente->loadUtente($nomeutente);
       if ($utente!= NULL || $utente!=false)
       {
           debug("promuovo:");
           $EAdmin = new EAdmin();
           $esito= $EAdmin->PromuoviUtente($utente);
           var_dump("var_dump esito: ".$esito);
           debug("debug utente: ".$esito);
           if ($esito!=0){
                debug("ERRORE nell'aggiornamento!!!!!!!!!!");
           }
           elseif ($esito==0){
            debug("OK!");
            $VAdmin= new VAdmin();
            $VAdmin->setLayout('dettagli_utente_promosso_degradato');
            $VAdmin->impostaDati('nomeutente',$nomeutente);
            return $VAdmin->processaTemplate();
           }

       }
       else
       {
           debug("ERRORE: Utente NON TROVATO!!!!");
           return 1;
       }
       //qua dovrei mandare una mail per avvertirlo
   }//OK

   public function DegradaUtente(){
        //carico un metodo di EAdmin
        //debug("ci entro in degrada utente?");
       $VAdmin = new $VAdmin();
       $nomeutente=$VAdmin->getNomeUtente();
        //$nomeutente=$_GET["nomeutente"];
        debug("nome utente = ");
        var_dump($nomeutente);
        debug("provo a degradarlo");

        $FAdmin=new FAdmin();
        $newutente=$FAdmin->loadUtente($nomeutente);
        if ($newutente!= NULL || $newutente!=false)
        {
            debug("Degrado:");
            $EAdmin = new EAdmin();
            $esito= $EAdmin->TogliPermessiAmministratore($newutente);
            var_dump("var_dump esito: ".$esito);
            debug("debug utente: ".$esito);
            if ($esito!=0){
                debug("ERRORE nell'aggiornamento!!!!!!!!!!");
            }
            elseif ($esito==0){
                debug("OK!");
                $VAdmin= new VAdmin();
                $VAdmin->setLayout('dettagli_utente_promosso_degradato');
                $VAdmin->impostaDati('nomeutente',$nomeutente);
                return $VAdmin->processaTemplate();
            }
        }
        else
        {
            debug("ERRORE: Utente NON TROVATO!!!!");
            return 1;
        }
        //qua dovrei mandare una mail per avvertirlo
    }//OK

   public function MandaAvvertimento()
   {
       $VAdmin = new $VAdmin();
       $nomeutente=$VAdmin->getNomeUtente();
       //$nomeutente=$_GET["nomeutente"];
       debug("nome utente = ");
       var_dump($nomeutente);
       debug("Mando Avvertimento!");

       $FUtente=new FUtente();
       $utente=$FUtente->loadUtente($nomeutente);

       if ($utente!= NULL || $utente!= false)
       {
        debug("entro in MandaAvvertimento");
        $successo = $utente->riceviAvvertimento();
        if ($successo==true)
        {
        //qua Mando la mail-avvertimento
            $email=$this->emailAvvertimento($utente);

            if($email)
                {
                    debug("Mail di Avvertimento Inviata con Successo!!!");
                }
            else
                {
                    $this->_errore='impossibile inoltrare email'; //da verificare a cosa serve
                }
        //end mail
        }
        elseif($successo==false)
        {
               debug("Si è verificato un errore nel mandare l'avvertimento. Nessuna mail è stata inviata");
        }
      }
      else
      {
           debug("ERRORE: Utente NON TROVATO!!!!");
      }

      return 0;

   }//Finito manca da verificare se invia la mail

    //ELIMINAZIONI
    public function EliminaSegnalazione(){

        $VAdmin = new $VAdmin();
        $id=$VAdmin->getIdSegnalazione();
        //$id=$_GET["idsegnalazione"];
        //debug("idsegnalazione = "+$id);
        ("Elimino la Segnalazione!\n\n");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FSegnalazione=new FSegnalazione();
        $segnalazione=$FSegnalazione->loadSegnalazione($id);
        if ($segnalazione!= NULL || $segnalazione!=0){
            //tento di cancellarla
            $ris= $FSegnalazione->delete($segnalazione);
            debug("Segnalazione ELIMINATA CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    } //Finito

    public function EliminaUtente(){

        $VAdmin = new $VAdmin();
        $nomeutente=$VAdmin->getNomeUtente();

        //$nomeutente=$_GET["nomeutente"];
        //debug("nome utente = ");
        //var_dump($nomeutente);
        debug("Elimino utente!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FUtente=new FUtente();
        $utente=$FUtente->loadUtente($nomeutente);

        if ($utente!= NULL || $utente!= false)
        {

            $lista_viaggi = $utente->getElencoViaggi();
            foreach($lista_viaggi as $viaggio)
            {
                $FViaggio=new FViaggio();
                $viaggio=$FViaggio->loadViaggio($viaggio->id);
                if ($viaggio!= NULL || $viaggio!= false)
                {
                    //var_dump($viaggio);
                    $lista_citta=$viaggio->getElencoCitta();//tiene la lista delle citta
                    foreach ($lista_citta as $citta)
                    {
                        $FCitta=new FCitta();
                        $key["idviaggio"]=(int) $citta->idviaggio; //obbligatorio il casting poiche IDViaggio torna Stringa
                        $key["nome"]=$citta->nome;
                        $citta=$FCitta->loadCitta($key);
                        if ($citta!= NULL || $citta!= false)
                        {
                            //cancello tutti i luoghi appartenenti alla citta
                            $lista_luoghi=$citta->getElencoLuoghi();//tiene la lista del luoghi
                            var_dump($lista_luoghi);
                            $FLuogo=new FLuogo();
                            foreach ($elenco_luoghi as $luogo)
                            {
                                $elenco_commenti=$luogo->getElencoCommenti();
                                foreach ($elenco_commenti as $commento)
                                {
                                    $FCommento= new FCommento();
                                    $FCommento->delete($commento);
                                    debug("\nCommento ELIMINATO CORRETTAMENTE!");
                                    debug($ris);
                                }
                                $FLuogo->delete($luogo);
                                debug("\nLuogo ELIMINATO CORRETTAMENTE!");
                            }
                            //tento di cancellare la citta
                            $FCitta->delete($citta);
                            debug("Citta ELIMINATA CORRETTAMENTE!");
                        }
                    }
                    //tento di cancellare il viaggio
                    $FViaggio->delete($viaggio);
                    debug("Citta ELIMINATA CORRETTAMENTE!");
                    }
                }
            //tento di cancellare l'utente
            $ris= $FUtente->delete($utente);
            debug("Utente ELIMINATO CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    }//FINTO ma manca la parte di eliminazione dei commenti//DA controllare se funziona

    public function EliminaViaggio(){
        $VAdmin = new $VAdmin();
        $id=$VAdmin->getIdViaggio();
        //$id=$_GET["idviaggio"];
        //debug("idviaggio = "+$id);
        //debug("Elimino il viaggio!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->loadViaggio($id);
        //end
        if ($viaggio!= NULL || $viaggio!= false)
        {
            //var_dump($viaggio);
            $lista_citta=$viaggio->getElencoCitta();//tiene la lista delle citta
            var_dump($lista_citta);
            foreach ($lista_citta as $citta)
            {
                $FCitta=new FCitta();

                $key["idviaggio"]=(int) $citta->idviaggio; //obbligatorio il casting poiche IDViaggio torna Stringa
                $key["nome"]=$citta->nome;
                $citta=$FCitta->loadCitta($key);
                if ($citta!= NULL || $citta!= false)
                {
                    //cancello tutti i luoghi appartenenti alla citta
                    $lista_luoghi=$citta->getElencoLuoghi();//tiene la lista del luoghi
                    var_dump($lista_luoghi);
                    $FLuogo=new FLuogo();
                    $FCommento= new FCommento();
                    foreach ($lista_luoghi as $luogo)
                    {
                        $elenco_commenti=$luogo->getElencoCommenti();
                        foreach ($elenco_commenti as $commento)
                        {
                            $FCommento->delete($commento);
                            debug("\nCommento ELIMINATO CORRETTAMENTE!");
                            //debug($ris);
                        }
                        $FLuogo->delete($luogo);
                        debug("\nLuogo ELIMINATO CORRETTAMENTE!");
                    }
                //tento di cancellare la citta
                $FCitta->delete($citta);
                debug("Citta ELIMINATA CORRETTAMENTE!");
                }
            }
            //tento di cancellare il viaggio
            $FViaggio->delete($viaggio);
            debug("VIAGGIO ELIMINATO CORRETTAMENTE!");

        }
        else
        {
             Debug("NON CI SONO RISULTATI!!!!");
        }
    }//DA controllare se funziona

    public function EliminaCitta()
    {
        $VAdmin = new $VAdmin();
        $idviaggio=$VAdmin->getIdViaggio();
        $nomecitta=$VAdmin->getNomeCitta();
        //$idviaggio=$_GET["idviaggio"];
        //$nomecitta=$_GET["nomecitta"];
        debug("Elimino la citta!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FCitta=new FCitta();

//Creo l'array da mandare a loadCitta($key)
        $key['idviaggio']=$idviaggio;
        $key['nome']=$nomecitta;
//end
        $citta=$FCitta->loadCitta($key);

        if ($citta!= NULL || $citta!= false)
        {
            //cancello tutti i luoghi appartenenti alla citta
            $elenco_luoghi=$citta->getElencoLuoghi();//tiene la lista del luoghi
            var_dump($elenco_luoghi);
            $FLuogo=new FLuogo();
            $FCommento= new FCommento();
            foreach ($elenco_luoghi as $luogo)
            {
                $elenco_commenti=$luogo->getElencoCommenti();
                foreach ($elenco_commenti as $commento)
                {
                    $FCommento->delete($commento);
                    debug("\nCommento ELIMINATO CORRETTAMENTE!");
                }
                $FLuogo->delete($luogo);
                debug("\nLuogo ELIMINATO CORRETTAMENTE!");
            }
            //tento di cancellare la citta
            $FCitta->delete($citta);
            debug("Citta ELIMINATA CORRETTAMENTE!");
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    } //finito

    public function EliminaLuogo()
    {
        $VAdmin = new $VAdmin();

        $idviaggio=$VAdmin->getIdViaggio();
        $nomecitta=$VAdmin->getNomeCitta();
        $nomeluogo=$Vadmin->getNomeLuogo();
        //$idviaggio=$_GET["idviaggio"];
        //$nomecitta=$_GET["nomecitta"];
        //$nomeluogo=$_GET["nomeluogo"];
        debug("Elimino luogo!");
        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FLuogo=new FLuogo();

//Creo l'array da mandare a loadLuogo($key)
        $key['idviaggio']=$idviaggio;
        $key['nomecitta']=$nomecitta;
        $key['nome']=$nomeluogo;
//end
        $luogo=$FLuogo->loadLuogo($key);

        if ($luogo!= NULL || $luogo!=false){
            $elenco_commenti=$luogo->getElencoCommenti();
            $FCommento=new FCommento();
            foreach ($elenco_commenti as $commento)
            {
                $FCommento->delete($commento);
                debug("\nCommento ELIMINATO CORRETTAMENTE!");
            }
            debug("\n cancellati tutti i commenti di questo luogo");
            //tento di cancellare il Luogo
            $FLuogo->delete($luogo);
            debug("Luogo ELIMINATO CORRETTAMENTE!");
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    }//finito

    public function EliminaCommento(){

        $VAdmin = new $VAdmin();
        $id=$VAdmin->getIdCommento();
        //$id=$_GET["idcommento"];
        //debug("idcommento = "+$id);
        debug("Elimino il Commento!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FCommento=new FCommento();
        $commento=$FCommento->loadCommento($id);
        //end
        if ($commento!= NULL ||$commento!= false)
        {
        //tento di cancellarlo
            $FCommento->delete($commento);
            debug("Commento ELIMINATO CORRETTAMENTE!");
            //var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    }//Finito

    public function emailAvvertimento(EUtente $utente)
    {
        global $config;
        $view=USingleton::getInstance('VAdmin');
        $view->setLayout('email_avvertimento');
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        //$view->impostaDati('url',$config['url_bookstore']);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->mail,$utente->nome.' '.$utente->cognome,'Avvertimento Ricevuto YesYouTravel',$corpo_email);
    }
}
?>