<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.47
 * To change this template use File | Settings | File Templates.
 */

class CViaggio
{



    public function smista()
    {
        $view=USingleton::getInstance('VRegistrazione');
        switch ($view->getTask())
        {
            case 'inserimento_luogo':
                return $this->impostaPaginaCompilazioneLuogo();
            case 'inserimento_viaggio':
                return $this->impostaPaginaCompilazioneViaggio();
            case 'inserimento_citta':
                return $this->impostaPaginaCompilazioneCitta();

            //salvataggi
            case 'salva_viaggio':
                return $this->salvaViaggio();
            case 'salva_luogo':
                return $this->salvaLuogo();
            case 'salva_citta':
                return $this->salvaCitta();

            //caricamenti
            case 'visualizza_viaggi_inseriti':
                return $this->visualizzaViaggiTable();
            case 'visualizza_viaggio':
                return $this->VisualizzaViaggio();
            case 'visualizza_citta_inserite':
                return $this->visualizzaCittaTable();
            case 'visualizza_citta':
                return $this->visualizzaCitta();
            case 'visualizza_luoghi_inseriti':
                return $this->visualizzaLuoghiTable();
            case 'visualizza_luogo':
                return $this->VisualizzaLuogo();
            case 'visualizza_commenti_inseriti':
                return $this->VisualizzaCommentiTable();
            case 'visualizza_commento':
                return $this->VisualizzaCommento();

            //controlli
            case 'verifica_alloggio':
                return $this->ControllaCostoAlloggio();
            case 'verifica_datafinecitta':
                return $this->ControllaDataFine();
            case 'verifica_datainiziocitta':
                return $this->ControllaDataInizio();
            case 'verifica_costobiglietto':
                return $this->ControllaCostoBiglietto();
        }
    }


    //COMPILAZIONI
    public function impostaPaginaCompilazioneViaggio()
    {
            $VViaggio=USingleton::getInstance('VViaggio');
            $session=USingleton::getInstance('USession');
            if($session->leggi_valore('viaggio') == false)
            {
                $VViaggio->setLayout('inserimento_viaggio');
                $VViaggio->impostaDati('controller','aggiunta_viaggio');
                $VViaggio->impostaDati('task','salva_viaggio');
                $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
                return $VViaggio->processaTemplate();
            }else
            {
                $VViaggio->impostaDati('errore','per inserire un nuovo viaggio completare inserimento citta viaggio precedente');
                return $this->impostaPaginaCompilazioneCitta();
            }
    }

    public function impostaPaginaCompilazioneCitta()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $session=USingleton::getInstance('USession');
        $VViaggio->setLayout('inserimento_citta');
        $VViaggio->impostaDati('controller','aggiunta_viaggio');
        $VViaggio->impostaDati('task','salva_citta');
        $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
        $Fviaggio= new FViaggio();
        $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
        $VViaggio->impostaDati('idviaggio',$viaggio->id);
        return $VViaggio->processaTemplate();
    }

    public function impostaPaginaCompilazioneLuogo()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $session=USingleton::getInstance('USession');
        $session->cancella_valore('luogo');
        $VViaggio->setLayout('inserimento_luogo');
        $VViaggio->impostaDati('controller','aggiunta_viaggio');
        $VViaggio->impostaDati('task','salva_luogo');
        $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
        $Fviaggio= new FViaggio();
        $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
        $VViaggio->impostaDati('idviaggio',$viaggio->id);
        return $VViaggio->processaTemplate();
    }


    //salvataggi
    public function salvaViaggio()
    {
        $view=USingleton::getInstance('VViaggio');
        $FViaggio=new FViaggio();
        $session=USingleton::getInstance('USession');
        $view->impostaDati('autore',$session->leggi_valore('username') );
        $dati_viaggio=$view->getDatiViaggio();
        $viaggio=new EViaggio();
        $FViaggio=new FViaggio();
        //viaggio non esistente (non esiste gia nel DB quindi lo scrivo)
        $keys=array_keys($dati_viaggio);
        $i=0;
        $validaviaggio=USingleton::getInstance('Vvalidaviaggio');
        $validaviaggio->validacampi($dati_viaggio);
        $dati_viaggio['datainizio'] = $this->FormattaDataSQL($dati_viaggio['datainizio']);
        $dati_viaggio['datafine'] = $this->FormattaDataSQL($dati_viaggio['datafine']);
        if(!$validaviaggio->getErrors())
        {
            foreach ($dati_viaggio as $dato)
            {
                $viaggio->$keys[$i]=$dato;
                $i++;
            }
            if($session->leggi_valore('viaggio') == false)
            {
                $db=$FViaggio->store($viaggio);
                if($db != false || $db != null)
                {
                    $session->imposta_valore('viaggio', $viaggio);
                    return $this->impostaPaginaCompilazioneCitta();
                }else
                {
                    $view->setLayout('inserimento_viaggio');
                    $this->_errore="Impossibile salvare, contattare l'amministratore!";
                    $view->impostaErrore($this->_errore);
                    $this->_errore='';
                    return $view->processaTemplate();
                }
            }else
            {
                return $this->impostaPaginaCompilazioneCitta();
            }
        }else
        {
            $view->setLayout('inserimento_viaggio');
            $dati=$validaviaggio->getErrors();
            $view->impostaDati('messaggi' , $dati);
            $session=USingleton::getInstance('USession');
            $view->impostaDati('controller','aggiunta_viaggio');
            $view->impostaDati('task','salva_viaggio');
            $view->impostaDati('autore',$session->leggi_valore('username') );
            $datiutente=$validaviaggio->getdatipersonali();
            $view->impostaDati('viaggio', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            return $view->processaTemplate();
        }

    }

    public function salvaCitta()
    {
        $view=USingleton::getInstance('VViaggio');
        $Fviaggio= new FViaggio();
        $dati_citta=$view->getDatiCitta();
        $session=USingleton::getInstance('USession');
        $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
        $dati_citta['idviaggio']=$viaggio->id;
        $aux['varie']=$session->leggi_valore('viaggio');
        $aux['dati']=$dati_citta;
        $validacitta=USingleton::getInstance('Vvalidacitta');
        $validacitta->validacampi($aux);
        $dati_citta['datainizio'] = $this->FormattaDataSQL($dati_citta['datainizio']);
        $dati_citta['datafine'] = $this->FormattaDataSQL($dati_citta['datafine']);
        if(!$validacitta->getErrors())
        {
            $citta=new ECitta();
            $FCitta=new FCitta();
            $keys=array_keys($dati_citta);
            $i=0;
            foreach ($dati_citta as $dato)
            {
                $citta->$keys[$i]=$dato;
                $i++;
            }
            $session->imposta_valore('cittavisitata',$citta->nome);
            $citta->nome = $this->FormattaApostrofoSQL($citta->nome);
            $citta->stato = $this->FormattaApostrofoSQL($citta->stato);
            $citta->tipoalloggio = $this->FormattaApostrofoSQL($citta->tipoalloggio);
            if($session->leggi_valore('citta') == false)
            {
                $db=$FCitta->store($citta);
                if($db != false || $db != null)
                {
                    $session->cancella_valore('viaggio');
                    $session->imposta_valore('citta', $citta);
                    return $this->impostaPaginaCompilazioneLuogo();
                }else
                {
                    $view->setLayout('inserimento_citta');
                    $this->_errore="Impossibile salvare, contattare l'amministratore!";
                    $view->impostaErrore($this->_errore);
                    $this->_errore='';
                    return $view->processaTemplate();
                }
            }else
            {
                return $this->impostaPaginaCompilazioneLuogo();
            }
        }else
        {
            $view->setLayout('inserimento_citta');
            $dati=$validacitta->getErrors();
            $view->impostaDati('messaggi' , $dati);
            $session=USingleton::getInstance('USession');
            $view->impostaDati('controller','aggiunta_viaggio');
            $view->impostaDati('task','salva_citta');
            $view->impostaDati('autore',$session->leggi_valore('username') );
            $view->impostaDati('idviaggio',$session->leggi_valore('idviaggio') );
            $datiutente=$validacitta->getdatipersonali();
            $view->impostaDati('citta', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $view->processaTemplate();
    }


    public function salvaLuogo()
    {
        $view=USingleton::getInstance('VViaggio');
        $Fviaggio= new FViaggio();
        $dati_luogo=$view->getDatiLuogo();
        $session= USingleton::getInstance('USession');
        $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
        $budget = $Fviaggio->loadViaggio($viaggio->id)->budget;
        $dati_luogo['idviaggio']=$viaggio->id;
        $dati_luogo['budget'] = $budget;
        $luogo=new ELuogo();
        $FLuogo=new FLuogo();
        $keys=array_keys($dati_luogo);
        $validaluogo=USingleton::getInstance('Vvalidaluogo');
        $validaluogo->validacampi($dati_luogo);
        if(!$validaluogo->getErrors())
        {   $i=0;
            foreach ($dati_luogo as $dato)
            {
                $luogo->$keys[$i]=$dato;
                $i++;
            }
            unset($luogo->budget);
            $luogo->nomecitta= $session->leggi_valore('cittavisitata');
            $luogo->nome = $this->FormattaApostrofoSQL($luogo->nome);
            $luogo->percorso = $this->FormattaApostrofoSQL($luogo->percorso);
            $luogo->commentolibero = $this->FormattaApostrofoSQL($luogo->commentolibero);
            $luogo->nomecitta = $this->FormattaApostrofoSQL($luogo->nomecitta);
            if($session->leggi_valore('luogo') == false)
            {
                $db=$FLuogo->store($luogo);
                if($db != false || $db != null)
                {
                    $session->cancella_valore('citta');
                    $session->imposta_valore('luogo', $luogo);
                    $view->setLayout('conferma_inserimento_luogo');
                    return $view->processaTemplate();
                }else
                {
                    $view->setLayout('inserimento_luogo');
                    $this->_errore="Impossibile salvare, contattare l'amministratore!";
                    $view->impostaErrore($this->_errore);
                    $this->_errore='';
                    return $view->processaTemplate();
                }
            }else
            {
                $view->setLayout('conferma_inserimento_luogo');
                return $view->processaTemplate();
            }
        }else
        {
            $view->setLayout('inserimento_luogo');
            $dati=$validaluogo->getErrors();
            $view->impostaDati('messaggi' , $dati);
            $view->impostaDati('controller','aggiunta_viaggio');
            $view->impostaDati('task','salva_luogo');
            $session=USingleton::getInstance('USession');
            $view->impostaDati('autore',$session->leggi_valore('username'));
            $view->impostaDati('idviaggio',$dati_luogo['idviaggio']);
            $datiutente=$validaluogo->getdatipersonali();
            $view->impostaDati('luogo', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $view->processaTemplate();
    }


    public function salvaCommento()
    {
        $view=USingleton::getInstance('VViaggio');
        $dati_luogo=$view->getDatiLuogo();
        $luogo=new ELuogo();
        $FLuogo=new FLuogo();
        $keys=array_keys($dati_luogo);
        $i=0;
        foreach ($dati_luogo as $dato)
        {
            $luogo->$keys[$i]=$dato;
            $i++;
        }
        $FLuogo->store($luogo);
        return $view->show('conferma_inserimento_luogo.tpl'); //verifica
    }//da sistemare


    //VISUALIZZAZIONI TABLE
    public function visualizzaViaggiTable()
    {   //questa versiona ELIMINA I CLONI
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi(); //qua recupero i viaggi dell'utente
        $VViaggio=USingleton::getInstance('VViaggio');
        $VViaggio->setLayout('elenco_viaggi');
        $VViaggio->impostaDati('results',$lista_viaggi);
        return $VViaggio->processaTemplate();
    }


    public function visualizzaCittaTable()
    {   //questa versiona ELIMINA I CLONI
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_citta');
        if($view->getIdViaggio()==false)
        {
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi(); //qua recupero i viaggi dell'utente
        $cont=0; //memorizza le posizioni dei PDI inseriti in luoghi risultato
        $citta_risultato=array();//è quello che poi mandero in stampa al TPL
        foreach($lista_viaggi as $viaggio)
        {
            $lista_citta=$viaggio->getElencoCitta(); //qua recupero le citta del viaggi
            foreach($lista_citta as $citta)
            {
                $verifica=in_array($citta,$citta_risultato);//verifica se un elemento è presente in un array
                if ($verifica==true)//quindi è presente
                {
                    //debug("è presente quindi non lo aggiungo");
                }
                else if($verifica==false)  //quindi non è presente
                {
                    $citta_risultato[$cont]=$citta; //metto in pos $cont il luogo testato
                    $cont++; //sposto cont
                }
            }
        }
        }
        else
        {
            $FViaggio= new FViaggio();
            $EViaggio= $FViaggio->loadViaggio($view->getIdViaggio());
            $citta_risultato=$EViaggio->getElencoCitta();
            $view->impostaDati('idviaggio',$view->getIdViaggio());
        }
        $view->impostaDati('results',$citta_risultato);
        return $view->processaTemplate();

    }


    public function visualizzaLuoghiTable()
    {   //questa versiona ELIMINA I CLONI
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_luoghi');
        if($view->getIdViaggio()==false || $view->getNomeCitta()==false)
        {
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi(); //qua recupero i viaggi dell'utente
        $cont=0; //memorizza le posizioni dei PDI inseriti in luoghi risultato
        $luoghi_risultato=array();//è quello che poi mandero in stampa al TPL

        foreach($lista_viaggi as $viaggio)
        {
            $lista_citta=$viaggio->getElencoCitta(); //qua recupero le citta del viaggio
            foreach($lista_citta as $citta)
            {
                $lista_luoghi= $citta->getElencoLuoghi(); //qua recupero le citta di un singolo viaggio
                if ($lista_luoghi !=  false) { //quindi ci sono elementi

                    foreach($lista_luoghi as $luogo)
                    {

                        $verifica=in_array($luogo,$luoghi_risultato);//verifica se un elemento è presente in un array

                        if ($verifica==true)//quindi è presente
                        {
                            //debug("è presente quindi non lo aggiungo");
                        }

                        else if($verifica==false)  //quindi non è presente
                        {
                            $luoghi_risultato[$cont]=$luogo; //metto in pos $cont il luogo testato
                            $cont++; //sposto cont
                        }
                    }
                }
            }
        }
        }
        else
        {
            $key['idviaggio']=$view->getIdViaggio();
            $key['nome']=$view->getNomeCitta();
            $FCitta= new FCitta();
            $ECitta= $FCitta->loadCitta($key);
            $luoghi_risultato=$ECitta->getElencoLuoghi();
            $view->impostaDati('idviaggio',$view->getIdViaggio());
            $view->impostaDati('nomecitta',$view->getNomeCitta());
        }
        //mando in stampa tutto

        $view->impostaDati('results',$luoghi_risultato);
        return $view->processaTemplate();
    }

    public function visualizzaCommentiTable()       ///LASCIATO COSI MA SECONDO ME NON SERVE DA $cont=0 FINO A CHIUSURA IF
    {                                               ///BASTA PASSARE $listaCommenti AL TPL.....GIA PROVATO!!!
        $view=USingleton::getInstance('VViaggio');
        if($view->getIdViaggio()==false && $view->getNomeCitta()==false && $view->getNomeLuogo()==false)
        {
            $session=USingleton::getInstance('USession');
            $user=$session->leggi_valore('username');
            $FCommento = new FCommento();
            $listaCommenti = $FCommento->loadRicerca('autore',$session->leggi_valore('username'));
            $cont=0; //memorizza le posizioni dei commenti inseriti in luoghi risultato
            $commenti_risultato=array();//è quello che poi mandero in stampa al TPL
            if ($listaCommenti !=  false)
            {
                foreach($listaCommenti as $commento)
                {
                    $commenti_risultato[$cont]=$commento; //metto in pos $cont il commento testato
                    $cont++; //sposto cont
                }
            }
        }
        else
        {
            $key['idviaggio']=$view->getIdViaggio();
            $key['nomecitta']=$view->getNomeCitta();
            $key['nome']=$view->getNomeLuogo();
            $FLuogo= new FLuogo();
            $ELuogo= $FLuogo->loadLuogo($key);
            $commenti_risultato=$ELuogo->getElencoCommenti();
            $view->impostaDati('idviaggio',$view->getIdViaggio());
            $view->impostaDati('nomecitta',$view->getNomeCitta());
            $view->impostaDati('nomeluogo',$view->getNomeLuogo());
        }
        $view->setLayout('elenco_commenti');
        $view->impostaDati('results',$commenti_risultato);
        return $view->ProcessaTemplate();
    }


    //VISUALIZZAZIONE IN DETTAGLIO

    public function VisualizzaViaggio()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->load($VViaggio->getIdViaggio());
        $VViaggio->setLayout('dettagli_viaggio');
        $VViaggio->impostaDati('viaggio',$viaggio);
        return $VViaggio->processaTemplate();
    }

    public function visualizzaCitta()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCitta=new FCitta();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$this->FormattaApostrofoSQL($VViaggio->getNomeCitta()));
        $citta=$FCitta->loadCitta($key);
        $citta->nome = $this->FormattaApostrofofromSQL($citta->nome);
        $citta->stato = $this->FormattaApostrofofromSQL($citta->stato);
        $citta->tipoalloggio = $this->FormattaApostrofofromSQL($citta->tipoalloggio);
        $VViaggio->setLayout('dettagli_citta');
        $VViaggio->impostaDati('citta',$citta);
        return $VViaggio->processaTemplate();
    }

    public function VisualizzaLuogo()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FLuogo=new FLuogo();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$this->FormattaApostrofoSQL($VViaggio->getNomeLuogo()),'nomecitta'=>$this->FormattaApostrofoSQL($VViaggio->getNomeCitta()));
        $luogo=$FLuogo->loadLuogo($key);
        $VViaggio->setLayout('dettagli_luogo');
        $VViaggio->impostaDati('luogo',$luogo);
        return $VViaggio->processaTemplate();
    }

    public function VisualizzaCommento()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCommento=new FCommento();
        $idcommento=$VViaggio->getIDCommento();
        $commento=$FCommento->loadCommento($idcommento);//qua copio in commento il risultato della query
        $VViaggio->setLayout('dettagli_commento');
        $VViaggio->impostaDati('commento',$commento);
        return $VViaggio->processaTemplate();
    }


    //controlli validazioni ajax da veder!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    public function ControllaCostoAlloggio()
    {
        $costo = $_POST['costoalloggio'];
        $session=USingleton::getInstance('USession');
        $FViaggio=new FViaggio();
        $alloggio=$FViaggio->loadViaggio($session->leggi_valore('viaggio')->getID());
        $aux=$alloggio->budget;
        if($aux != null)//per precauzione aggiunto controllo su esistenza campo
        {
            if($costo > $aux)
            {
                echo"false";
            }else
            {
                echo"true";
            }
        }
    }


    public function ControllaDataFine()
    {
        $datafine = $_POST['datafine'];
        //deve partire controlla giorno mese anno

    }


    public function ControllaDataInizio()
    {
        $datainizio = $_POST['datainizio'];
        //deve partire controlla giorno mese anno

    }


    public function ControllaCostoBiglietto()
    {
        $costobiglietto = $_POST['costobiglietto'];
        $session=USingleton::getInstance('USession');
        $FViaggio=new FViaggio();
        $alloggio=$FViaggio->loadViaggio($session->leggi_valore('viaggio')->getID());
        $aux=$alloggio->budget;
        if($aux != null)//per precauzione aggiunto controllo su esistenza campo
        {
            if($costobiglietto > $aux)
            {
                echo"false";
            }else
            {
                echo"true";
            }
        }
    }


    public function FormattaDataSQL($dato)
    {
        $aux= explode('/',$dato);
        return $result = $aux[2]."-".$aux[0]."-".$aux[1];
    }


    public function VerificaAnnoIn($annoin1,$annoin)
    {
        if($annoin1 <= $annoin )
        {
            $result='true';//non ci sono errori
        }else
        {
            $result='false';//ci sono errori
        }
        return $result;
    }


    public function VerificaAnnoFin($annofin1, $annofin)
    {
        if( $annofin1 >= $annofin )
        {
            $result='true';//non ci sono errori
        }else
        {
            $result='false';//ci sono errori
        }
        return $result;
    }


    public function VerificaMeseIniziale($mesein1, $mesein, $annoin, $annofin)
    {
        if( $annoin == $annofin )
        {//stesso anno per inizio e fine viaggio,visita citta
            if($mesein1 <= $mesein )
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }else
        {//anni diversi
            if(($mesein >= $mesein1 || $mesein <= $mesefin1) && ($mesefin <= $mesefin1 || $mesefin >= $mesein1  ))
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }
        return $result;
    }


    public function VerificaMeseFinale($mesefin1, $mesefin, $annoin, $annofin)
    {
        if( $annoin == $annofin )
        {//stesso anno per inizio e fine viaggio,visita citta
            if($mesefin1 >= $mesefin )
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }else
        {//anni diversi???????!!!!!!!!!!!!
            if(($mesein >= $mesein1 || $mesein <= $mesefin1) && ($mesefin <= $mesefin1 || $mesefin >= $mesein1 ))
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }
        return $result;
    }


    public function VerificaGiornoIn($giornoin1, $giornoin, $mesein, $mesefin)
    {
        if( $mesein == $mesefin )
        {//stesso mese per inizio e fine viaggio,visita citta
            if($giornoin1 <= $giornoin )
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }else
        {//mesi diversi
            if(($mesein >= $mesein1 || $mesein <= $mesefin1) && ($mesefin <= $mesefin1 || $mesefin >= $mesein1 ))
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }
        return $result;
    }


    public function VerificaGiornoFin($giornofin1, $giornofin, $mesein, $mesefin)
    {
        if( $mesein == $mesefin )
        {//stesso mese per inizio e fine viaggio,visita citta
            if( $giornofin1 >= $giornofin)
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }else
        {//mesi diversi?????????????!!!!!!!!!!!!!!!
            if(($mesein >= $mesein1 || $mesein <= $mesefin1) && ($mesefin <= $mesefin1 || $mesefin >= $mesein1 ))
            {
                $result='true';//non ci sono errori
            }else
            {
                $result='false';//ci sono errori
            }
        }
        return $result;
    }


    public function FormattaApostrofoSQL($dato)
    {
        if(stripos($dato,"'")!=false)
        {
            $result=str_replace("'","''",$dato);
            return $result;
        }
        else
        {
            return $dato;
        }
    }


    public function FormattaApostrofofromSQL($dato)
    {
        if(stripos($dato,"''")!=false)
        {
            $result=str_replace("''","'",$dato);
            return $result;
        }
        else
        {
            return $dato;
        }
    }
}
?>