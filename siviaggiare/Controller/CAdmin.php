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
                return $this->ModificaUtente();
            case 'promuovi_utente':
                return $this->PromuoviUtente();
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

   public function MandaAvvertimento() //manca la parte dell'invio della mail
   {

       $nomeutente=$_GET["nomeutente"];
       debug("nome utente = ");
       var_dump($nomeutente);
       debug("Mando Avvertimento!");

       $FUtente=new FUtente();
       $utente=$FUtente->loadUtente($nomeutente);
       if ($utente!= NULL || $utente!=0)
       {
        debug("entro in MandaAvvertimento");
        $utente->riceviAvvertimento();
       }
       else
       {
           debug("ERRORE: Utente NON TROVATO!!!!");
       }
           //qua dovrei mandare una mail
       return 0;

   }

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
        if ($utente!= NULL || $utente!=0){
            //tento di cancellarlo
            $ris= $FUtente->deleteUtente($nomeutente);
            debug("Utente ELIMINATO CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }

    }//finito

    public function EliminaViaggio(){
        $id=$_GET["idviaggio"];
        debug("idviaggio = "+$id);
        debug("Elimino il viaggio!");

        //recupero l'oggetto dal DB usando l'indice ottenuto
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->loadViaggio($id);
        //end
        if ($viaggio!= NULL || $viaggio!=0){
            //tento di cancellarlo
            $ris= $FViaggio->deleteViaggio($id);
            debug("Viaggio ELIMINATO CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    }//finito

    public function EliminaCitta(){ //la stringa che arriva(BENE) viene convertita in 0 boh! -->soluzione per le stringhe usare var_dump
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
            //tento di cancellarlo
            $ris= $FCitta->deleteCitta($key);
            debug("Citta ELIMINATA CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }

    }//DA controllare se funziona

    public function EliminaLuogo()//da fare
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
            //tento di cancellarlo
            $ris= $FLuogo->deleteLuogo($key);
            debug("Luogo ELIMINATO CORRETTAMENTE!");
            var_dump($ris);
        }
        else
        {
            Debug("NON CI SONO RISULTATI!!!!");
        }
    }


    public function EliminaCommento(){ //con AJAX FUNZIONA COMPLETATA
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


}
?>