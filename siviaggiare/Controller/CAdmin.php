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
    } //MAI RICHIAMATO POICHE' LO DOVREBBERO AVER FATTO CHECCO E RICCARDO

    //MODIFICHE
   public function PromuoviUtente(){
        //carico un metodo di EAdmin
        debug("ci entro in promuovi utente?");

       $nomeutente=$_GET["nomeutente"];
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
        debug("ci entro in degrada utente?");

        $nomeutente=$_GET["nomeutente"];
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

       $nomeutente=$_GET["nomeutente"];
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
        $id=$_GET["idsegnalazione"];
        debug("idsegnalazione = "+$id);
        ("Elimino la Segnalazione!\n\n");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FSegnalazione=new FSegnalazione();
        $segnalazione=$FSegnalazione->loadSegnalazione($id);
        if ($segnalazione!= NULL || $segnalazione!=0){
            //tento di cancellarla
            $ris= $FSegnalazione->deleteSegnalazione($id);
            debug("Segnalazione ELIMINATA CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    } //Finito

    public function EliminaUtente(){
        $nomeutente=$_GET["nomeutente"];
        debug("nome utente = ");
        var_dump($nomeutente);
        debug("Elimino utente!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FUtente=new FUtente();
        $utente=$FUtente->loadUtente($nomeutente);

        if ($utente!= NULL || $utente!= false)
        {
            $lista_viaggi = $utente->getElencoViaggi();
            if (count($lista_viaggi)!=0)
            {
                foreach($lista_viaggi as $viaggio)
                {
                    $id=$viaggio['id'];
                    debug("idviaggio = "+$id);
                    debug("Elimino il viaggio!");

                    //recupero l'oggetto dal DB usando l'indice ottenuto
                    $FViaggio=new FViaggio();
                    $viaggio=$FViaggio->loadViaggio($id);
                    //end
                    if ($viaggio!= NULL || $viaggio!= false)
                    {

                        $lista_citta = $viaggio->getElencoCitta();
                        if (count($lista_citta)!=0)
                        {
                            foreach($lista_citta as $citta)
                            {
                                //debug($_GET); //arriva la stringa giusta
                                //debug(is_string($_GET["nomecitta"])); //torna TRUE quindi è una stringa
                                $idviaggio=$_GET["idviaggio"];
                                debug("idviaggio = "+$idviaggio); //stampa l'id Giusto
                                $nomecitta=$citta["nomecitta"]; //prendo il nome da citta[i]
                                var_dump($nomecitta);
                                //debug("nomecitta = "+$nomecitta);//mi stampa 0 invece che la stringa
                                debug("Elimino la citta!");

                                //recupero l'oggetto dal DB usando l'indice ottenuto
                                $FCitta=new FCitta();

                                //Creo l'array da mandare a loadCitta($key)
                                $key=array('idviaggio','nomecitta');
                                $key['idviaggio']=$idviaggio;
                                $key['nome']=$nomecitta;
                                //end
                                $citta=$FCitta->loadCitta($key);

                                if ($citta!= NULL || $citta!= false){

                                    //cancello tutti i luoghi appartenenti alla citta
                                    var_dump($citta);
                                    $lista_luoghi=$citta->getElencoLuoghi();
                                    var_dump($lista_luoghi);

                                    if (count($lista_luoghi)!=0)
                                    {
                                        //Cancello ogni luogo e cancello ogni commento relativo a quel luogo
                                        $i=0;//solo per debug
                                        foreach($lista_luoghi as $luogo)
                                        {
                                            debug("passaggio ".$i."\n");
                                            var_dump($luogo);
                                            //per ogni luogo cerco tutti i commenti
                                            $FCommento = new FCommento();
                                            $lista_commenti=$FCommento->loadRicerca();//manca la funzione per cercare tutti i commenti di un luogo
                                            if (count($lista_commenti)!=0)
                                            {
                                                debug("DA FINIRE: elimino tutti i commenti");
                                            }
                                            else//end cancellazione commenti
                                            {
                                                debug("ATTENZIONE: NON CI SONO COMMENTI PER QUESTO LUOGO");
                                            }

                                            //qui elimino il luogo
                                            //recupero l'oggetto dal DB usando l'indice ottenuto
                                            $FLuogo=new FLuogo();
                                            //Creo l'array da mandare a loadLuogo($key)
                                            $key=array('idviaggio','nomecitta','nome');
                                            $key['idviaggio']=$idviaggio;
                                            $key['nomecitta']=$nomecitta;
                                            //il nome del luogo lo reperisco dall'oggeto che trovo in lista_luoghi di $i;
                                            $key['nome']=$luogo['nome']; //da verificare se passa il parametro giusto
                                            debug($key['nome']);
                                            //end
                                            $luogo=$FLuogo->loadLuogo($key);

                                            if ($luogo!= NULL || $luogo!=0)
                                            {
                                                //tento di cancellare il Luogo
                                                $ris= $FLuogo->deleteLuogo($key);
                                                debug("Luogo ELIMINATO CORRETTAMENTE!");
                                                var_dump($ris);
                                            }
                                            else
                                            {
                                                Debug("NON CI SONO RISULTATI!!!!");
                                            }
                                        }
                                    }//end ricerca luoghi
                                    else
                                    {
                                        debug("ATTENZIONE: NON CI SONO LUOGHI INSERITI PER QUESTA CITTA");
                                    }

                                    //tento di cancellare la citta
                                    $ris= $FCitta->deleteCitta($key);
                                    debug("Citta ELIMINATA CORRETTAMENTE!");
                                    var_dump($ris);
                                }//end ricerca luoghi
                                else
                                {
                                    Debug("NON CI SONO RISULTATI!!!!");
                                }
                            }//end cancellazione Citta
                        }//end ricerca citta

                        //tento di cancellare il viaggio
                        $ris= $FViaggio->deleteViaggio($id);
                        debug("Viaggio ELIMINATO CORRETTAMENTE!");
                        var_dump($ris);

                    }//end cancellazione viaggio
                    else
                    {
                        Debug("NON CI SONO RISULTATI!!!!");
                    }

                }//End eliminazione della lista viaggi
            }//end ricerca viaggi

            //tento di cancellare l'utente
            $ris= $FUtente->deleteUtente($nomeutente);
            debug("Utente ELIMINATO CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }

    }//FINTO ma manca la parte di eliminazione dei commenti//DA controllare se funziona

    public function EliminaViaggio(){
        $id=$_GET["idviaggio"];
        debug("idviaggio = "+$id);
        debug("Elimino il viaggio!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->loadViaggio($id);
        //end
        if ($viaggio!= NULL || $viaggio!= false)
        {

            $lista_citta = $viaggio->getElencoCitta();
            if (count($lista_citta)!=0)
            {
                foreach($lista_citta as $citta)
                {
                //debug($_GET); //arriva la stringa giusta
                //debug(is_string($_GET["nomecitta"])); //torna TRUE quindi è una stringa
                $idviaggio=$_GET["idviaggio"];
                debug("idviaggio = "+$idviaggio); //stampa l'id Giusto
                $nomecitta=$citta["nomecitta"]; //prendo il nome da citta[i]
                var_dump($nomecitta);
                //debug("nomecitta = "+$nomecitta);//mi stampa 0 invece che la stringa
                debug("Elimino la citta!");

                //recupero l'oggetto dal DB usando l'indice ottenuto
                $FCitta=new FCitta();

//Creo l'array da mandare a loadCitta($key)
                $key=array('idviaggio','nomecitta');
                $key['idviaggio']=$idviaggio;
                $key['nome']=$nomecitta;
//end
                $citta=$FCitta->loadCitta($key);

                if ($citta!= NULL || $citta!= false){

                    //cancello tutti i luoghi appartenenti alla citta
                    var_dump($citta);
                    $lista_luoghi=$citta->getElencoLuoghi();
                    var_dump($lista_luoghi);

                    if (count($lista_luoghi)!=0)
                    {
                        //Cancello ogni luogo e cancello ogni commento relativo a quel luogo
                        $i=0;//solo per debug
                        foreach($lista_luoghi as $luogo)
                        {
                            debug("passaggio ".$i."\n");
                            var_dump($luogo);
                            //per ogni luogo cerco tutti i commenti
                            $FCommento = new FCommento();
                            $lista_commenti=$FCommento->loadRicerca();//manca la funzione per cercare tutti i commenti di un luogo
                            if (count($lista_commenti)!=0)
                            {
                                debug("DA FINIRE: elimino tutti i commenti");
                            }
                            else//end cancellazione commenti
                            {
                                debug("ATTENZIONE: NON CI SONO COMMENTI PER QUESTO LUOGO");
                            }

                            //qui elimino il luogo
                            //recupero l'oggetto dal DB usando l'indice ottenuto
                            $FLuogo=new FLuogo();
//Creo l'array da mandare a loadLuogo($key)
                            $key=array('idviaggio','nomecitta','nome');
                            $key['idviaggio']=$idviaggio;
                            $key['nomecitta']=$nomecitta;
                            //il nome del luogo lo reperisco dall'oggeto che trovo in lista_luoghi di $i;
                            $key['nome']=$luogo['nome']; //da verificare se passa il parametro giusto
                            debug($key['nome']);
//end
                            $luogo=$FLuogo->loadLuogo($key);

                            if ($luogo!= NULL || $luogo!=0)
                            {
                                //tento di cancellare il Luogo
                                $ris= $FLuogo->deleteLuogo($key);
                                debug("Luogo ELIMINATO CORRETTAMENTE!");
                                var_dump($ris);
                            }
                            else
                            {
                                Debug("NON CI SONO RISULTATI!!!!");
                            }
                        }
                    }
                    else
                    {
                        debug("ATTENZIONE: NON CI SONO LUOGHI INSERITI PER QUESTA CITTA");
                    }

                    //tento di cancellare la citta
                    $ris= $FCitta->deleteCitta($key);
                    debug("Citta ELIMINATA CORRETTAMENTE!");
                    var_dump($ris);
                }//end eliminazione citta
                else
                {
                    Debug("NON CI SONO RISULTATI!!!!");
                }
           }
       }//end ricerca citta

       //tento di cancellare il viaggio
       $ris= $FViaggio->deleteViaggio($id);
       debug("Viaggio ELIMINATO CORRETTAMENTE!");
       var_dump($ris);
       }//end cancellazione viaggio
       else
       {
            Debug("NON CI SONO RISULTATI!!!!");
       }
    }//FINTO ma manca la parte di eliminazione dei commenti//DA controllare se funziona

    public function EliminaCitta()
    {
        //debug($_GET); //arriva la stringa giusta
        //debug(is_string($_GET["nomecitta"])); //torna TRUE quindi è una stringa
        $idviaggio=$_GET["idviaggio"];
        debug("idviaggio = "+$idviaggio); //stampa l'id Giusto
        $nomecitta=$_GET["nomecitta"];
        var_dump($nomecitta);
        //debug("nomecitta = "+$nomecitta);//mi stampa 0 invece che la stringa
        debug("Elimino la citta!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FCitta=new FCitta();

//Creo l'array da mandare a loadCitta($key)
        $key=array('idviaggio','nomecitta');
        $key['idviaggio']=$idviaggio;
        $key['nome']=$nomecitta;
//end
        $citta=$FCitta->loadCitta($key);

        if ($citta!= NULL || $citta!=0){

            //cancello tutti i luoghi appartenenti alla citta
            var_dump($citta);
            $lista_luoghi=$citta->getElencoLuoghi();
            var_dump($lista_luoghi);

            if (count($lista_luoghi)!=0)
            {
                //Cancello ogni luogo e cancello ogni commento relativo a quel luogo
                $i=0;//solo per debug
                foreach($lista_luoghi as $luogo)
                {
                    debug("passaggio ".$i."\n");
                    var_dump($luogo);
                    //per ogni luogo cerco tutti i commenti
                    $FCommento = new FCommento();
                    $lista_commenti=$FCommento->loadRicerca();//manca la funzione per cercare tutti i commenti di un luogo
                    if (count($lista_commenti)!=0)
                    {
                        debug("DA FINIRE: elimino tutti i commenti");
                    }
                    else//end cancellazione commenti
                    {
                        debug("ATTENZIONE: NON CI SONO COMMENTI PER QUESTO LUOGO");
                    }

                    //qui elimino il luogo
                    //recupero l'oggetto dal DB usando l'indice ottenuto
                    $FLuogo=new FLuogo();
//Creo l'array da mandare a loadLuogo($key)
                    $key=array('idviaggio','nomecitta','nome');
                    $key['idviaggio']=$idviaggio;
                    $key['nomecitta']=$nomecitta;
                    //il nome del luogo lo reperisco dall'oggeto che trovo in lista_luoghi di $i;
                    $key['nome']=$luogo['nome']; //da verificare se passa il parametro giusto
                    debug($key['nome']);
//end
                    $luogo=$FLuogo->loadLuogo($key);

                    if ($luogo!= NULL || $luogo!=0)
                    {
                        //tento di cancellare il Luogo
                        $ris= $FLuogo->deleteLuogo($key);
                        debug("Luogo ELIMINATO CORRETTAMENTE!");
                        var_dump($ris);
                    }
                    else
                    {
                        Debug("NON CI SONO RISULTATI!!!!");
                    }
                }
            }
            else
            {
                debug("ATTENZIONE: NON CI SONO LUOGHI INSERITI PER QUESTA CITTA");
            }

            //tento di cancellare la citta
            $ris= $FCitta->deleteCitta($key);
            debug("Citta ELIMINATA CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    }//FINTO ma manca la parte di eliminazione dei commenti //DA controllare se funziona

    public function EliminaLuogo()
    {
        //debug($_GET); //arriva la stringa giusta
        //debug(is_string($_GET["nomecitta"])); //torna TRUE quindi è una stringa
        $idviaggio=$_GET["idviaggio"];
        debug("idviaggio = "+$idviaggio); //stampa l'id Giusto
        $nomecitta=$_GET["nomecitta"];
        var_dump($nomecitta);
        $nomeluogo=$_GET["nomeluogo"];
        var_dump($nomeluogo);
        debug("Elimino luogo!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FLuogo=new FLuogo();
//Creo l'array da mandare a loadLuogo($key)
        $key=array('idviaggio','nomecitta','nome');
        $key['idviaggio']=$idviaggio;
        $key['nomecitta']=$nomecitta;
        $key['nome']=$nomeluogo;
//end
        $luogo=$FLuogo->loadLuogo($key);

        if ($luogo!= NULL || $luogo!=0){

            //cancello tutti i commenti appartenenti al luogo
            var_dump($luogo);
            $numerocommenti=count($luogo->getElencoCommenti());
            var_dump($numerocommenti);
            if ($numerocommenti!=0){
                for ($i=0; $i<=$numerocommenti;$i++){
                    debug("passaggio ".$i."\n");
                    debug("DA FARE L'eliminazione");
                }
            }
            else
            {
                debug("ATTENZIONE: NON CI SONO COMMENTI PER QUESTO LUOGO");
            }//end cancellazione commenti

            //tento di cancellare il Luogo
            $ris= $FLuogo->deleteLuogo($key);
            debug("Luogo ELIMINATO CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    }//FINTO ma manca la parte di eliminazione dei commenti //DA controllare se funziona

    public function EliminaCommento(){
        $id=$_GET["idcommento"];
        debug("idcommento = "+$id);
        debug("Elimino il Commento!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FCommento=new FCommento();
        $commento=$FCommento->loadCommento($id);
        //end
        if ($commento!= NULL ||$commento!=0){
        //tento di cancellarlo
        $ris= $FCommento->deleteCommento($id);
            debug("Commento ELIMINATO CORRETTAMENTE!");
            var_dump($ris);
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