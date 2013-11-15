<?php


class CAdmin
{

    /**
     * Smista le richieste ai vari controller
     *
     * @return mixed
     */
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


            //invio di segnalazioni da parte di utenti
            case 'invia_segnalazione_viaggio':
                return $this->InviaSegnalazioneViaggio();
            case 'invia_segnalazione_citta':
                return $this->InviaSegnalazioneCitta();
            case 'invia_segnalazione_luogo':
                return $this->InviaSegnalazioneLuogo();
            case 'invia_segnalazione_commento':
                return $this->InviaSegnalazioneCommento();



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
                return $this->ModificaUtente();
            case 'salva_modifica_utente':
                return $this->SalvaModificaUtente();

            case 'promuovi_utente':
                return $this->PromuoviUtente();
            case 'degrada_utente':
                return $this->DegradaUtente();
            case 'manda_avvertimento':
                return $this->MandaAvvertimento();
        }
    }


    /**
     * Permette ad un utente di inviare una segnalazione di un Viaggio
     *
     */
    public function InviaSegnalazioneViaggio()
    {
        $VAdmin=USingleton::getInstance("VAdmin");
        $nomeutente=$VAdmin->getNomeUtente();
        $idviaggio=$VAdmin->getIdViaggio();
        $testosegnalazione= $VAdmin->getTestoSegnalazione();
        $Viaggio= new FViaggio();
        $viaggio= $Viaggio->loadViaggio($idviaggio);
        $autoreviaggio=$viaggio->utenteusername;
        $Segnalazione = new ESegnalazione();
        $Segnalazione->idviaggio=$idviaggio;
        $Segnalazione->autore=$nomeutente;
        $Segnalazione->segnalato=$autoreviaggio;
        $Segnalazione->motivo=$testosegnalazione;
        $FSegnalazione= new FSegnalazione();
        $FSegnalazione->store($Segnalazione);
    }


    /**
     * Permette ad un utente di inviare una segnalazione di una Città
     *
     */
    public function InviaSegnalazioneCitta()
    {
        $VAdmin=USingleton::getInstance("VAdmin");
        $nomeutente=$VAdmin->getNomeUtente();
        $idviaggio=$VAdmin->getIdViaggio();
        $nomecitta=$VAdmin->getNomeCitta();
        $testosegnalazione= $VAdmin->getTestoSegnalazione();
        $Viaggio= new FViaggio();
        $viaggio= $Viaggio->loadViaggio($idviaggio);
        $autoreviaggio=$viaggio->utenteusername;
        $Segnalazione = new ESegnalazione();
        $Segnalazione->idviaggio=$idviaggio;
        $Segnalazione->autore=$nomeutente;
        $Segnalazione->segnalato=$autoreviaggio;
        $Segnalazione->citta=$nomecitta;
        $Segnalazione->motivo=$testosegnalazione;
        $FSegnalazione= new FSegnalazione();
        $FSegnalazione->store($Segnalazione);
    }


    /**
     * Permette ad un utente di inviare una segnalazione di un Luogo
     *
     */
    public function InviaSegnalazioneLuogo()
    {
        $VAdmin=USingleton::getInstance("VAdmin");
        $nomeutente=$VAdmin->getNomeUtente();
        $idviaggio=$VAdmin->getIdViaggio();
        $nomecitta=$VAdmin->getNomeCitta();
        $nomeluogo=$VAdmin->getNomeLuogo();
        $testosegnalazione= $VAdmin->getTestoSegnalazione();
        $Viaggio= new FViaggio();
        $viaggio= $Viaggio->loadViaggio($idviaggio);
        $Segnalazione = new ESegnalazione();
        $autoreviaggio=$viaggio->utenteusername;
        $FSegnalazione= new FSegnalazione();
        $Segnalazione->idviaggio=$idviaggio;
        $Segnalazione->autore=$nomeutente;
        $Segnalazione->segnalato=$autoreviaggio;
        $Segnalazione->citta=$nomecitta;
        $Segnalazione->luogo=$nomeluogo;
        $Segnalazione->motivo=$testosegnalazione;
        $FSegnalazione->store($Segnalazione);
    }

    /**
     * Permette ad un utente di inviare una segnalazione di un Commento
     *
     */
    public function InviaSegnalazioneCommento()
    {
        $VAdmin=USingleton::getInstance("VAdmin");
        $nomeutente=$VAdmin->getNomeUtente();
        $autorecommento=$VAdmin->getAutoreCommento();
        $idcommento=$VAdmin->getIdCommento();
        $testosegnalazione= $VAdmin->getTestoSegnalazione();
        $Segnalazione = new ESegnalazione();
        $FSegnalazione= new FSegnalazione();
        $Segnalazione->autore=$nomeutente;
        $Segnalazione->segnalato=$autorecommento;
        $Segnalazione->idcommento=$idcommento;
        $Segnalazione->motivo=$testosegnalazione;
        $FSegnalazione->store($Segnalazione);
    }


    //VISUALIZZAZIONE TABLE


    /**
     * Permette ad un utente di classe Admin di visualizzare una lista delle segnalazioni
     * sottoforma di table
     *
     * @return string
     */

    public function VisualizzaSegnalazioniTable()
    {
        $EAdmin = new EAdmin();
        $lista_Segnalazioni=$EAdmin->getElencoSegnalazioni();
        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('elenco_segnalazioni');
        $VAdmin->impostaDati('results',$lista_Segnalazioni);
        return $VAdmin->processaTemplate();
    }


    /**
     * Permette ad un utente di classe Admin di visualizzare una lista di tutti gli utenti
     * sottoforma di table
     *
     * @return string
     */
    public function VisualizzaTuttiUtenti()
    {
        $FUtente = new FUtente();
        $Utenti = $FUtente->CaricaTutto();
        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('elenco_utenti');
        $VAdmin->impostaDati('utente',$Utenti);
        return $VAdmin->processaTemplate();
    }


    //VISUALIZZAZIONE IN DETTAGLIO


    /**
     * Permette ad un utente di classe Admin di visualizzare una Segnalazione
     *
     * @return string
     */
    public function VisualizzaSegnalazione()
    {
        $VAdmin=USingleton::getInstance('VAdmin');
        $FSegnalazione= new FSegnalazione();
        $segnalazione=$FSegnalazione->loadSegnalazione($VAdmin->getIdSegnalazione());
        $VAdmin->setLayout('dettagli_segnalazione');
        $VAdmin->impostaDati('segnalazione',$segnalazione);
        return $VAdmin->processaTemplate();
    }

    /**
     * Permette ad un utente di classe Admin di visualizzare una segnalazione
     * di un viaggo su cui sono presenti pulsanti di amministrazione avanzata
     *
     * @return string
     */
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


    /**
     * Permette ad un utente di classe Admin di visualizzare una segnalazione
     * di una citta su cui sono presenti pulsanti di amministrazione avanzata
     *
     * @return string
     */
    public function VisualizzaSegnalazioneCittaConPermessi()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCitta=new FCitta();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeCitta());
        $citta=$FCitta->loadCitta($key);
        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('dettagli_citta');
        $VAdmin->impostaDati('citta',$citta);
        return $VAdmin->processaTemplate();
    }


    /**
     * Permette ad un utente di classe Admin di visualizzare una segnalazione
     * di un luogo su cui sono presenti pulsanti di amministrazione avanzata
     *
     * @return string
     */
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

    /**
     * Permette ad un utente di classe Admin di visualizzare una segnalazione
     * di un commentto su cui sono presenti pulsanti di amministrazione avanzata
     *
     * @return string
     */
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


    //MODIFICHE


    /**
     * Permette ad un utente di classe Admin di visualizzare un template avanzato in cui
     * è possibile modificare gli attributi di un utente
     *
     * @return string
     */
   public function ModificaUtente(){

       $VAdmin=USingleton::getInstance('VAdmin');
       $FUtente=new FUtente();
       $user = $VAdmin->getNomeUtente();
       $utente= $FUtente->loadUtente($user);
       $VAdmin->setLayout('modifica_utente');
       $VAdmin->impostaDati('utente',$utente);
       echo $VAdmin->processaTemplate();
   }


    /**
     * Permette ad un utente di classe Admin di Aggiornare gli attributi
     * di un utente modificati manualmente attraverso il template generato dal metodo ModificaUtente().
     *
     * @return string
     */
    public function SalvaModificaUtente(){
        $VAdmin=USingleton::getInstance('VAdmin');
        $dati_utente= $VAdmin->getDatiModificati();
        $utente=new EUtente();
        $FUtente=new FUtente();
        $keys=array_keys($dati_utente);
        $i=0;
        foreach ($dati_utente as $dato)
        {
                $utente->$keys[$i]=$dato;
                $i++;
        }
        $FUtente->update($utente);
        echo $this->ProfiloUtente();
    }


    /**
     * Permette ad un utente di classe Admin di cambiare lo stato di un utente
     * promuovendolo in Amministratore
     *
     * @return string || integer
     */
   public function PromuoviUtente()
   {
       $VAdmin = new VAdmin();
       $nomeutente=$VAdmin->getNomeUtente();
       $FUtente=new FUtente();
       $utente=$FUtente->loadUtente($nomeutente);
       if ($utente!= NULL || $utente!=false)
       {
           $EAdmin = new EAdmin();
           $esito= $EAdmin->PromuoviUtente($utente);
           if($esito==0)
           {
            $VAdmin= new VAdmin();
            $VAdmin->setLayout('dettagli_utente_promosso_degradato');
            $VAdmin->impostaDati('nomeutente',$nomeutente);
            return $VAdmin->processaTemplate();
           }

       }
       else
       {
           return 1;
       }
   }


    /**
     * Permette ad un utente di classe Admin di cambiare lo stato di un utente(avanzato)
     * degradandolo
     *
     * @return string || integer
     */
    public function DegradaUtente()
    {
        $VAdmin = new VAdmin();
        $nomeutente=$VAdmin->getNomeUtente();
        $FAdmin=new FAdmin();
        $newutente=$FAdmin->loadUtente($nomeutente);
        if ($newutente!= NULL || $newutente!=false)
        {
            $EAdmin = new EAdmin();
            $esito= $EAdmin->TogliPermessiAmministratore($newutente);
            if ($esito==0)
            {
                $VAdmin= new VAdmin();
                $VAdmin->setLayout('dettagli_utente_promosso_degradato');
                $VAdmin->impostaDati('nomeutente',$nomeutente);
                return $VAdmin->processaTemplate();
            }
        }
        else
        {
            //debug("ERRORE: Utente NON TROVATO!!!!");
            return 1;
        }
    }


    /**
     * Permette ad un utente di classe Admin di visualizzare un profilo di un utente
     * su cui sono presenti pulsanti di amministrazione avanzata
     *
     * @return string
     */
    public function ProfiloUtente(){
        $VViaggio=USingleton::getInstance('VViaggio');
        $FUtente = new FUtente();
        $Utente = $FUtente->load($VViaggio->getNomeUtente());

        $VAdmin=USingleton::getInstance('VAdmin');
        $VAdmin->setLayout('dettagli_utente');
        $VAdmin->impostaDati('utente',$Utente);
        return $VAdmin->processaTemplate();
    }


    /**
     * Permette ad un utente di classe Admin di mandare un avvertimento ad un utente
     *
     * @return string
     */
   public function MandaAvvertimento()
   {
       $VAdmin = new VAdmin();
       $nomeutente=$VAdmin->getNomeUtente();
       $FUtente=new FUtente();
       $utente=$FUtente->loadUtente($nomeutente);

       if ($utente!= NULL || $utente!= false)
       {
        $successo = $utente->riceviAvvertimento();
        if ($successo==true)
        {
            $email=$this->emailAvvertimento($utente);
            var_dump($email);
            if($email)
                {
                    //debug("Mail di Avvertimento Inviata con Successo!!!");
                }
            else
                {
                    $this->_errore='impossibile inoltrare email';
                }
        //end mail
        }
        elseif($successo==false)
        {
               $this->_errore='Si è verificato un errore nel mandare l\'avvertimento. Nessuna mail è stata inviata';
        }
      }
      else
      {
           //debug("ERRORE: Utente NON TROVATO!!!!");
      }

      return 0;

   }//ok


    //ELIMINAZIONI


    /**
     * Permette ad un utente di classe Admin di eliminare una segnalazione
     *
     */
    public function EliminaSegnalazione()
    {
        $VAdmin = new VAdmin();
        $id=$VAdmin->getIdSegnalazione();
        $FSegnalazione=new FSegnalazione();
        $segnalazione=$FSegnalazione->loadSegnalazione($id);
        if ($segnalazione!= NULL || $segnalazione!= false)
        {
            $ris= $FSegnalazione->delete($segnalazione);
        }
    }


    /**
     * Permette ad un utente di classe Admin di eliminare un utente
     * Questo implica che dal DB sia eliminato ricorsivamente ogni
     * riferimento a quel determinato utente
     */
    public function EliminaUtente()
    {
        $VAdmin = new VAdmin();
        $nomeutente=$VAdmin->getNomeUtente();
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
                    $lista_citta=$viaggio->getElencoCitta();
                    foreach ($lista_citta as $citta)
                    {
                        $FCitta=new FCitta();
                        $key["idviaggio"]=(int) $citta->idviaggio;
                        $key["nome"]=$citta->nome;
                        $citta=$FCitta->loadCitta($key);
                        if ($citta!= NULL || $citta!= false)
                        {
                            $lista_luoghi=$citta->getElencoLuoghi();
                            $FLuogo=new FLuogo();
                            foreach ($lista_luoghi as $luogo)
                            {
                                $elenco_commenti=$luogo->getElencoCommenti();
                                foreach ($elenco_commenti as $commento)
                                {
                                    $FCommento= new FCommento();
                                    $FCommento->delete($commento);
                                }
                                $FLuogo->delete($luogo);
                            }
                            $FCitta->delete($citta);
                        }
                    }
                    $FViaggio->delete($viaggio);
                    }
                }
            $ris= $FUtente->delete($utente);
        }
    }//ok


    /**
     * Permette ad un utente di classe Admin di eliminare un viaggio
     * Questo implica che dal DB sia eliminato ricorsivamente ogni
     * riferimento a quel determinato viaggio
     */
    public function EliminaViaggio()
    {
        $VAdmin = new VAdmin();
        $id=$VAdmin->getIdViaggio();
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->loadViaggio($id);
        //end
        if ($viaggio!= NULL || $viaggio!= false)
        {
            $lista_citta=$viaggio->getElencoCitta();
            foreach ($lista_citta as $citta)
            {
                $FCitta=new FCitta();
                $key["idviaggio"]=(int) $citta->idviaggio;
                $key["nome"]=$citta->nome;
                $citta=$FCitta->loadCitta($key);
                if ($citta!= NULL || $citta!= false)
                {
                    $lista_luoghi=$citta->getElencoLuoghi();
                    $FLuogo=new FLuogo();
                    foreach ($lista_luoghi as $luogo)  //da rivedere
                    {
                        $elenco_commenti=$luogo->getElencoCommenti();
                        foreach ($elenco_commenti as $commento)
                        {
                            $FCommento= new FCommento();
                            $FCommento->delete($commento);
                        }
                        $FLuogo->delete($luogo);
                    }                                 //end da rivedere
                $FCitta->delete($citta);
                }
            }
            $FViaggio->delete($viaggio);
        }
    }


    /**
     * Permette ad un utente di classe Admin di eliminare una città
     * Questo implica che dal DB sia eliminato ricorsivamente ogni
     * riferimento a quella determinata citta
     */
    public function EliminaCitta()
    {
        $VAdmin = new VAdmin();
        $idviaggio=$VAdmin->getIdViaggio();
        $nomecitta=$VAdmin->getNomeCitta();
        $FCitta=new FCitta();
        $key['idviaggio']=$idviaggio;
        $key['nome']=$nomecitta;
        $citta=$FCitta->loadCitta($key);
        if ($citta!= NULL || $citta!= false)
        {
            $elenco_luoghi=$citta->getElencoLuoghi();
            $FLuogo=new FLuogo();
            $FCommento= new FCommento();
            foreach ($elenco_luoghi as $luogo)
            {
                $elenco_commenti=$luogo->getElencoCommenti();
                foreach ($elenco_commenti as $commento)
                {
                    $FCommento->delete($commento);
                }
                $FLuogo->delete($luogo);
            }
            $FCitta->delete($citta);
        }
    }


    /**
     * Permette ad un utente di classe Admin di eliminare un luogo
     * Questo implica che dal DB sia eliminato ricorsivamente ogni
     * riferimento a quel determinato luogo
     */
    public function EliminaLuogo()
    {
        $VAdmin = new VAdmin();
        $idviaggio=$VAdmin->getIdViaggio();
        $nomecitta=$VAdmin->getNomeCitta();
        $nomeluogo=$VAdmin->getNomeLuogo();
        $FLuogo=new FLuogo();
        $key['idviaggio']=$idviaggio;
        $key['nomecitta']=$nomecitta;
        $key['nome']=$nomeluogo;
        $luogo=$FLuogo->loadLuogo($key);

        if ($luogo!= NULL || $luogo!=false){
            $elenco_commenti=$luogo->getElencoCommenti();
            $FCommento=new FCommento();
            foreach ($elenco_commenti as $commento)
            {
                $FCommento->delete($commento);
            }
            $FLuogo->delete($luogo);
        }
    }


    /**
     * Permette ad un utente di classe Admin di eliminare un commento
     * Questo implica che dal DB sia eliminato ricorsivamente ogni
     * riferimento a quel determinato commento
     */
    public function EliminaCommento()
    {

        $VAdmin = new VAdmin();
        $id=$VAdmin->getIdCommento();
        $FCommento=new FCommento();
        $commento=$FCommento->loadCommento($id);
        if ($commento!= NULL ||$commento!= false)
        {
            $FCommento->delete($commento);
        }
    }


    /**
     * Permette ad un utente di classe Admin di mandare una mail di avvertimento ad un utente
     *
     * @param EUtente
     * @return boolean
     */
    public function emailAvvertimento(EUtente $utente)
    {
        global $config;
        $view=USingleton::getInstance('VAdmin');
        $view->setLayout('email_avvertimento');
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->mail,$utente->nome.' '.$utente->cognome,'Avvertimento Ricevuto YesYouTravel',$corpo_email);
    }
}
?>