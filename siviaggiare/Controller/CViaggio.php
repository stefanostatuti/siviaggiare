<?php
/**
 * @access public
 * @package Controller
 */
class CViaggio
{

    /**
     * Smista le richieste ai vari metodi
     * @author Riccardo
     * @return mixed
     */
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
            case 'verifica_costobiglietto':
                return $this->ControllaCostoBiglietto();
        }
    }


    //COMPILAZIONI


    /**
     * imposta la pagina di compilazione viaggio
     *
     * @return string
     */
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


    /**
     * imposta la pagina di compilazione citta
     *
     * @return string
     */
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


    /**
     * imposta la pagina di compilazione luogo
     *
     * @return string
     */
    public function impostaPaginaCompilazioneLuogo()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $session=USingleton::getInstance('USession');
        $session->cancella_valore('luogo');
        $VViaggio->setLayout('inserimento_luogo');
        $VViaggio->impostaDati('controller','aggiunta_viaggio');
        $VViaggio->impostaDati('task','salva_luogo');
        $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
        $VViaggio->impostaDati('inserimento_foto', '<label for="foto">Seleziona una foto: </label> <input id="immagine_luogo" type="file" name="immagini" id="immagine" />');
        $Fviaggio= new FViaggio();
        $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
        $VViaggio->impostaDati('idviaggio',$viaggio->id);
        return $VViaggio->processaTemplate();
    }


    //SALVATAGGI


    /**
     * Salva un viaggio
     * @author Riccardo
     * @return string
     */
    public function salvaViaggio()
    {
        $view=USingleton::getInstance('VViaggio');
        $session=USingleton::getInstance('USession');
        $view->impostaDati('autore',$session->leggi_valore('username') );
        $dati_viaggio=$view->getDatiViaggio();
        $viaggio=new EViaggio();
        $FViaggio=new FViaggio();
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


    /**
     * Salva una citta
     * @author Riccardo
     * @return string
     */
    public function salvaCitta()
    {
        $session=USingleton::getInstance('USession');
        if($session->leggi_valore('citta') == false)
        {
            $view=USingleton::getInstance('VViaggio');
            $Fviaggio= new FViaggio();
            $dati_citta=$view->getDatiCitta();
            $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
            $dati_citta['idviaggio']=$viaggio->id;
            $aux['varie']=$viaggio;
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
                $view->setLayout('inserimento_citta');
                $dati=$validacitta->getErrors();
                $view->impostaDati('messaggi' , $dati);
                $session=USingleton::getInstance('USession');
                $view->impostaDati('controller','aggiunta_viaggio');
                $view->impostaDati('task','salva_citta');
                $view->impostaDati('autore',$session->leggi_valore('username') );
                $datiutente=$validacitta->getdatipersonali();
                $view->impostaDati('citta', $datiutente);
                $this->_errore='DATI ERRATI';
                $view->impostaErrore($this->_errore);
                $this->_errore='';
            }
        }else
        {
            return $this->impostaPaginaCompilazioneLuogo();
        }
        return $view->processaTemplate();
    }


    /**
     * Salva un luogo
     * @author Riccardo
     * @return string
     */
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
            $view->impostaDati('inserimento_foto', '<label for="foto">Seleziona una foto: </label> <input type="file" name="immagini" id="immagine" />');
            $session=USingleton::getInstance('USession');
            $view->impostaDati('autore',$session->leggi_valore('username'));
            $datiutente=$validaluogo->getdatipersonali();
            $view->impostaDati('luogo', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $view->processaTemplate();
    }


    /**
     * salva un commento
     *
     * @return string
     */
    public function salvaCommento()         ///NON DOVREBBE SERVIRE PERKE INSERIMENTI SOLO CON AJAX() DA CRicerca
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
        return $view->show('conferma_inserimento_luogo.tpl');
    }


    //VISUALIZZAZIONI TABLE


    /**
     * visualizza l'elenco di tutti i viaggi inseriti dall utente
     *
     * @return string
     */
    public function visualizzaViaggiTable()
    {
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi();
        $VViaggio=USingleton::getInstance('VViaggio');
        $VViaggio->setLayout('elenco_viaggi');
        $VViaggio->impostaDati('results',$lista_viaggi);
        return $VViaggio->processaTemplate();
    }


    /**
     * visualizza l'elenco di tutte le citta inserite dall utente
     *
     * @return string
     */
    public function visualizzaCittaTable()
    {
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_citta');
        if($view->getIdViaggio()==false)
        {
            $session=USingleton::getInstance('USession');
            $user=$session->leggi_valore('username');
            $FUtente=new FUtente();
            $EUtente=$FUtente->load($user);
            $lista_viaggi=$EUtente->getElencoViaggi();
            $cont=0;
            $citta_risultato=array();
            foreach($lista_viaggi as $viaggio)
            {
                $lista_citta=$viaggio->getElencoCitta();
                foreach($lista_citta as $citta)
                {
                    $verifica=in_array($citta,$citta_risultato);
                    if ($verifica==false)
                    {
                        $citta_risultato[$cont]=$citta;
                        $cont++;
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


    /**
     * visualizza l'elenco di tutti i luoghi inseriti dall utente
     *
     * @return string
     */
    public function visualizzaLuoghiTable()
    {
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_luoghi');
        if($view->getIdViaggio()==false || $view->getNomeCitta()==false)
        {
            $session=USingleton::getInstance('USession');
            $user=$session->leggi_valore('username');
            $FUtente=new FUtente();
            $EUtente=$FUtente->load($user);
            $lista_viaggi=$EUtente->getElencoViaggi();
            $cont=0;
            $luoghi_risultato=array();
            foreach($lista_viaggi as $viaggio)
            {
                $lista_citta=$viaggio->getElencoCitta();
                foreach($lista_citta as $citta)
                {
                    $lista_luoghi= $citta->getElencoLuoghi();
                    if ($lista_luoghi !=  false)
                    {
                        foreach($lista_luoghi as $luogo)
                        {

                            $verifica=in_array($luogo,$luoghi_risultato);
                            if($verifica==false)
                            {
                                $luoghi_risultato[$cont]=$luogo;
                                $cont++;
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
        $view->impostaDati('results',$luoghi_risultato);
        return $view->processaTemplate();
    }


    /**
     * visualizza l'elenco di tutti i commenti inseriti dall utente
     *
     * @return string
     */
    public function visualizzaCommentiTable()       ///LASCIATO COSI MA SECONDO ME NON SERVE DA $cont=0 FINO A CHIUSURA IF
    {                                               ///BASTA PASSARE $listaCommenti AL TPL.....GIA PROVATO!!!
        $view=USingleton::getInstance('VViaggio');
        if($view->getIdViaggio()==false && $view->getNomeCitta()==false && $view->getNomeLuogo()==false)
        {
            $session=USingleton::getInstance('USession');
            $FCommento = new FCommento();
            $listaCommenti = $FCommento->loadRicerca('autore',$session->leggi_valore('username'));
            $cont=0;
            $commenti_risultato=array();
            if ($listaCommenti !=  false)
            {
                foreach($listaCommenti as $commento)
                {
                    $commenti_risultato[$cont]=$commento;
                    $cont++;
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


    /**
     * visualizza in dettaglio un viaggio inserito dall utente
     *
     * @return string
     */
    public function VisualizzaViaggio()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->load($VViaggio->getIdViaggio());
        $VViaggio->setLayout('dettagli_viaggio');
        $VViaggio->impostaDati('viaggio',$viaggio);
        return $VViaggio->processaTemplate();
    }


    /**
     * visualizza in dettaglio una citta inserita dall utente
     *
     * @return string
     */
    public function visualizzaCitta()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCitta=new FCitta();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeCitta());
        $citta=$FCitta->loadCitta($key);
        $VViaggio->setLayout('dettagli_citta');
        $VViaggio->impostaDati('citta',$citta);
        return $VViaggio->processaTemplate();
    }


    /**
     * visualizza in dettaglio un luogo inserito dall utente
     *
     * @return string
     */
    public function VisualizzaLuogo()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FLuogo=new FLuogo();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeLuogo(),'nomecitta'=>$VViaggio->getNomeCitta());
        $luogo=$FLuogo->loadLuogo($key);
        $VViaggio->setLayout('dettagli_luogo');
        $VViaggio->impostaDati('luogo',$luogo);
        $VViaggio->impostaDati('immagine_luogo',"<img width='300' alt='' src=templates/main/template/images/foto_luogo/".$luogo->immagini.">");
        return $VViaggio->processaTemplate();
    }


    /**
     * visualizza in dettaglio un commento inserito dall utente
     *
     * @return string
     */
    public function VisualizzaCommento()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCommento=new FCommento();
        $idcommento=$VViaggio->getIDCommento();
        $commento=$FCommento->loadCommento($idcommento);
        $VViaggio->setLayout('dettagli_commento');
        $VViaggio->impostaDati('commento',$commento);
        return $VViaggio->processaTemplate();
    }


    //CONTROLLI VALIDAZIONE AJAX


    /**
     * fa il controllo sul costo dell'alloggio
     * @author Riccardo
     * @return string
     */
    public function ControllaCostoAlloggio()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $costo=$VViaggio->getCostoAlloggio();
        $VViaggio=USingleton::getInstance('VViaggio');
        $FViaggio=new FViaggio();
        $alloggio=$FViaggio->loadViaggio($VViaggio->getIdViaggio());
        $aux=$alloggio->budget;
        if($aux != null)
        {
            if($costo > $aux)
            {
                echo json_encode(false);
            }else
            {
                echo json_encode(true);
            }
        }
    }


    /**
     * fa il controllo sul costo del biglietto
     * @author Riccardo
     * @return string
     */
    public function ControllaCostoBiglietto()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $costobiglietto = $VViaggio->getCostoBiglietto();
        $VViaggio=USingleton::getInstance('VViaggio');
        $FViaggio=new FViaggio();
        $alloggio=$FViaggio->loadViaggio($VViaggio->getIdViaggio());
        $aux=$alloggio->budget;
        if($aux != null)//per precauzione aggiunto controllo su esistenza campo
        {
            if($costobiglietto > $aux)
            {
                echo json_encode(false);
            }else
            {
                echo json_encode(true);
            }
        }
    }


    /**
     * formatta la data acquisita dal template per poterla correttamente salvare su db
     * @author Riccardo
     * @return string
     */
    public function FormattaDataSQL($dato)
    {
        $aux= explode('/',$dato);
        return $result = $aux[2]."-".$aux[0]."-".$aux[1];
    }

}
?>