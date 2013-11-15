<?php
/**
 * @access public
 * @package Controller
 */
class CModifica
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
            //modifica
            case 'modifica_viaggio': 
                return $this->ModificaViaggio();   
            case 'modifica_citta': 
                return $this->ModificaCitta();   
            case 'modifica_luogo': 
                return $this->ModificaLuogo();           
            case 'update_viaggio':
                return $this->UpdateViaggio();    
            case 'update_citta': 
                return $this->UpdateCitta();  
            case 'update_luogo': 
                return $this->UpdateLuogo();  
                
            //elimina
            case 'elimina_viaggio': 
                return $this->Elimina_viaggio();   
            case 'elimina_citta': 
                return $this->Elimina_citta();   
            case 'elimina_luogo': 
                return $this->Elimina_luogo();              
        }
    }


    //COMPILAZIONI


    /**
     * Imposta la pagina di compilazione del viaggio
     * @author Riccardo
     * @return string
     */
    public function impostaPaginaCompilazioneViaggio()
    {
            $VModifica=USingleton::getInstance('VModifica');
            $session=USingleton::getInstance('USession');
            $VModifica->setLayout('inserimento_viaggio');
            $VModifica->impostaDati('autore',$session->leggi_valore('username'));
            return $VModifica->processaTemplate();
    }


    /**
     * Imposta la pagina di compilazione della citta
     * @author Riccardo
     * @return string
     */
    public function impostaPaginaCompilazioneCitta()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession');
        $VModifica->setLayout('inserimento_citta');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        return $VModifica->processaTemplate();
  
    }


    /**
     * Imposta la pagina di compilazione del luogo
     * @author Riccardo
     * @return string
     */
    public function impostaPaginaCompilazioneLuogo()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession');
        $VModifica->setLayout('inserimento_luogo');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        return $VModifica->processaTemplate();
    }


    //SALVATAGGI


    /**
     * salva un viaggio modificato
     * @author Riccardo
     * @return string
     */
    public function UpdateViaggio()
    {   
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession');
        $ID= $session->leggi_valore('idviaggiomod');
        $VModifica->impostaDati('autore',$session->leggi_valore('username') );
        $VModifica=USingleton::getInstance('VModifica');
        $dati_viaggio=$VModifica->getDatiViaggio();
        $viaggio=new EViaggio();
        $FViaggio=new FViaggio();
        $keys=array_keys($dati_viaggio);
        $i=0;
        $validaviaggio=USingleton::getInstance('Vvalidaviaggio');
        $validaviaggio->validacampi($dati_viaggio);
        $dati_viaggio['datainizio'] = $this->FormattaDataSQL($dati_viaggio['datainizio']);              ////DA TOGLIERE FORMATTASQL!!!!!!
        $dati_viaggio['datafine'] = $this->FormattaDataSQL($dati_viaggio['datafine']);
        if(!$validaviaggio->getErrors())
        {   
            foreach ($dati_viaggio as $dato)
            {
                $viaggio->$keys[$i]=$dato;
                $i++;
            }
            $viaggio->id=$ID;
            $db=$FViaggio->update($viaggio);
            if($db == true)
            {
                $VModifica->impostaDati('risultato','Viaggio modificato!');
                $VModifica->setLayout('conferma_modifica');
            }else
            {
                $VModifica->impostaDati('risultato',"impossibile salvare le modifiche, contattare l' amministratore!");
                $VModifica->setLayout('conferma_modifica');
            }    
            $session->cancella_valore('idviaggiomod');
        }else
        {
            $VModifica->setLayout('inserimento_viaggio');
            $dati=$validaviaggio->getErrors();
            $VModifica->impostaDati('messaggi' , $dati);
            $session=USingleton::getInstance('USession');
            $VModifica->impostaDati('controller','modifica');
            $VModifica->impostaDati('task','update_viaggio');
            $VModifica->impostaDati('autore',$session->leggi_valore('username') );
            $datiutente=$validaviaggio->getdatipersonali();
            $VModifica->impostaDati('viaggio', $datiutente);
            $this->_errore='DATI ERRATI';
            $VModifica->impostaErrore($this->_errore);
            $this->_errore=''; 
        }
      return $VModifica->processaTemplate();
    }


    /**
     * salva una citta modificata
     * @author Riccardo
     * @return string
     */
    public function UpdateCitta()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $Fviaggio= new FViaggio();
        $dati_citta=$VModifica->getDatiCitta();
        $session=USingleton::getInstance('USession');
        $dataviaggio=$Fviaggio->loadViaggio($dati_citta['idviaggio']);
        $session->imposta_valore('dativiaggio', $dataviaggio);
        $aux['varie']=$session->leggi_valore('dativiaggio');
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
            $db=$FCitta->update($citta);
            $session->cancella_valore('dativiaggio');
            if($db == true)
            {
                $VModifica->impostaDati('risultato','Citt&agrave; modificata!');
                $VModifica->setLayout('conferma_modifica');
            }else
            {
                $VModifica->impostaDati('risultato',"impossibile salvare le modifiche, contattare l' amministratore!");
                $VModifica->setLayout('conferma_modifica');
            }    
        }else
        {
            $VModifica->setLayout('inserimento_citta');
            $dati=$validacitta->getErrors();
            $VModifica->impostaDati('messaggi' , $dati);
            $session=USingleton::getInstance('USession');
            $VModifica->impostaDati('controller','modifica');
            $VModifica->impostaDati('task','update_citta');
            $VModifica->impostaDati('autore',$session->leggi_valore('username') );
            $datiutente=$validacitta->getdatipersonali();
            $VModifica->impostaDati('citta', $datiutente);
            $this->_errore='DATI ERRATI';
            $VModifica->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $VModifica->processaTemplate();
    }


    /**
     * salva un luogo modificato
     * @author Riccardo
     * @return string
     */
    public function UpdateLuogo()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $Fviaggio= new FViaggio();
        $dati_luogo=$VModifica->getDatiLuogo();
        $session= USingleton::getInstance('USession');
        $dataviaggio=$Fviaggio->loadViaggio($dati_luogo['idviaggio']);
        $session->imposta_valore('dativiaggio', $dataviaggio);
        $aux=$session->leggi_valore('dativiaggio');
        $dati_luogo['budget']=$aux->budget;
        $dati_luogo['idviaggio']=$aux->id;
        $dati_luogo['nomecitta']=$VModifica->getNomeCitta();
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
            if($luogo->immagini != null)
            {
                $temp['idviaggio']=$aux->id;
                $temp['nomecitta']=$VModifica->getNomeCitta();
                $temp['nome']=$luogo->nome;
                $immagine=$FLuogo->loadLuogo($temp);
                if($immagine->immagini != null)
                {
                    $file = "templates/main/template/images/foto_luogo/".$immagine->immagini;
                    if (!unlink($file))
                    {
                        $this->_errore="impossibile eliminare $file";
                        $VModifica->impostaErrore($this->_errore);
                        $this->_errore='';
                    }
                    else
                    {
                        $this->_errore="$file eliminato";
                        $VModifica->impostaErrore($this->_errore);
                        $this->_errore='';
                    }
                }
            }else
            {
                $temp['idviaggio']=$aux->id;
                $temp['nomecitta']=$VModifica->getNomeCitta();
                $temp['nome']=$luogo->nome;
                $immagine=$FLuogo->loadLuogo($temp);
                $luogo->immagini=$immagine->immagini;
            }
            unset($luogo->budget);
            $db=$FLuogo->update($luogo);
            $session->cancella_valore('dativiaggio');
            if($db == true)
            {
                $VModifica->impostaDati('risultato','Luogo modificato!');
                $VModifica->setLayout('conferma_modifica');
            }else
            {
                $VModifica->impostaDati('risultato',"impossibile salvare le modifiche, contattare l' amministratore!");
                $VModifica->setLayout('conferma_modifica');
            }

        }else
        {
            $VModifica->setLayout('inserimento_luogo');
            $dati=$validaluogo->getErrors();
            $VModifica->impostaDati('messaggi' , $dati);
            $VModifica->impostaDati('autore',$session->leggi_valore('username'));
            $VModifica->setLayout('inserimento_luogo');
            $VModifica->impostaDati('controller','modifica');
            $VModifica->impostaDati('task','update_luogo');
            $VModifica->impostaDati('inserimento_foto', '<label for="foto">Seleziona una foto: </label> <input type="file" name="immagini" id="immagine" />');
            $datiutente=$validaluogo->getdatipersonali();
            $VModifica->impostaDati('luogo', $datiutente);
            $this->_errore='DATI ERRATI';
            $VModifica->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $VModifica->processaTemplate();
    }
    
    
    //CONTROLLI VALIDAZIONE AJAX


    /**
     * fa il controllo sul costo dell'alloggio
     * @author Riccardo
     * @return string
     */
    public function ControllaCostoAlloggio()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $costo=$VModifica->getCostoAlloggio();
        $session=USingleton::getInstance('USession');
        $FViaggio=new FViaggio();
        $alloggio=$FViaggio->loadViaggio($session->leggi_valore('viaggio')->getID());
        $aux=$alloggio->budget;
        if($aux != null)
        {
           if($costo > $aux)
           {
              echo false;
           }else
           {
              echo true;
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
        $VModifica=USingleton::getInstance('VModifica');
        $costobiglietto = $VModifica->getCostoBiglietto();
        $session=USingleton::getInstance('USession');
        $FViaggio=new FViaggio();
        $alloggio=$FViaggio->loadViaggio($session->leggi_valore('viaggio')->getID());
        $aux=$alloggio->budget;
        if($aux != null)
        {
           if($costobiglietto > $aux)
           {
              echo false;
           }else
           {
              echo true;
           }
        }   
    }  
    
    
    //MODIFICHE


    /**
     * carica i dati sulla pagina di compilazione del viaggio per accogliere la richiesta di modifica del medesimo
     * @author Riccardo
     * @return string
     */
    public function ModificaViaggio()
    {   
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession'); 
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->loadViaggio($VModifica->getIdViaggio());
        $id=(int)$viaggio->id;
        //passo dati a sessione
        $session->imposta_valore('idviaggiomod',$id);
        $arraydata['datainizio']=$this->FormattaDatafromSQL($viaggio->datainizio);
        $arraydata['datafine']=$this->FormattaDatafromSQL($viaggio->datafine);
        $arraydata['mezzotrasporto']=$viaggio->mezzotrasporto;
        $arraydata['costotrasporto']=$viaggio->costotrasporto;
        $arraydata['valutatrasporto']=$viaggio->valutatrasporto;
        $arraydata['valutabudget']=$viaggio->valutabudget;
        $arraydata['budget']=$viaggio->budget;
        $VModifica->setLayout('inserimento_viaggio');
        $VModifica->impostaDati('controller','modifica');
        $VModifica->impostaDati('task','update_viaggio');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        $VModifica->impostaDati('viaggio', $arraydata);
        $this->_errore='Modifica in corso';
        $VModifica->impostaErrore($this->_errore);
        $this->_errore='';
        return $VModifica->processaTemplate();
    }


    /**
     * carica i dati sulla pagina di compilazione della citta per accogliere la richiesta di modifica della medesima
     * @author Riccardo
     * @return string
     */
    public function ModificaCitta()
    {
        $VModifica=USingleton::getInstance('VModifica'); 
        $session=USingleton::getInstance('USession');
        $FCitta=new FCitta();
        $dati['idviaggio']= (int)$VModifica->getIdViaggio();
        $dati['nome']= $VModifica->getNomeCitta();
        $citta=$FCitta->loadCitta($dati);
        $arraydata['datainizio']=$this->FormattaDatafromSQL($citta->datainizio);
        $arraydata['datafine']=$this->FormattaDatafromSQL($citta->datafine); 
        $arraydata['citta']=$citta->nome;
        $arraydata['stato']=$citta->stato;
        $arraydata['tipoalloggio']=$citta->tipoalloggio;
        $arraydata['costoalloggio']=$citta->costoalloggio;
        $arraydata['valuta']=$citta->valuta;
        $arraydata['voto']=$citta->voto;
        $VModifica->setLayout('inserimento_citta');
        $VModifica->impostaDati('controller','modifica');
        $VModifica->impostaDati('task','update_citta');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        $VModifica->impostaDati('idviaggio',$dati['idviaggio'] );
        $VModifica->impostaDati('citta', $arraydata);
        $VModifica->impostaDati('readonly', 'readonly');
        $this->_errore='Modifica in corso';
        $VModifica->impostaErrore($this->_errore);
        $this->_errore='';
        return $VModifica->processaTemplate();
    }


    /**
     * carica i dati sulla pagina di compilazione del luogo per accogliere la richiesta di modifica del medesimo
     * @author Riccardo
     * @return string
     */
    public function ModificaLuogo()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession');
        $FLuogo=new FLuogo();
        $dati['idviaggio']= $VModifica->getIdViaggio();
        $dati['nome']= $VModifica->getNomeLuogo();
        $dati['nomecitta']= $VModifica->getNomeCitta();
        $luogo=$FLuogo->loadLuogo($dati);
        $arraydata['luogo']=$luogo->nome;
        $arraydata['sitoweb']=$luogo->sitoweb;;
        $arraydata['percorso']=$luogo->percorso;
        $arraydata['costobiglietto']=$luogo->costobiglietto;
        $arraydata['guidaturistica']=$luogo->guida;
        $arraydata['coda']=$luogo->coda;
        $arraydata['duratavisita']=$luogo->durata;
        $arraydata['valuta']=$luogo->valuta;
        $arraydata['commento']=$luogo->commentolibero;
        $VModifica->setLayout('inserimento_luogo');
        $VModifica->impostaDati('controller','modifica');
        $VModifica->impostaDati('task','update_luogo');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        $VModifica->impostaDati('idviaggio',$dati['idviaggio'] );
        $VModifica->impostaDati('nomecitta',$dati['nomecitta'] );
        $VModifica->impostaDati('inserimento_foto', '<label for="foto">Seleziona una foto: </label> <input id="immagine_luogo" type="file" name="immagini" id="immagine" />');
        $VModifica->impostaDati('luogo', $arraydata);
        $VModifica->impostaDati('readonly', 'readonly');
        $this->_errore='Modifica in corso';
        $VModifica->impostaErrore($this->_errore);
        $this->_errore='';
        return $VModifica->processaTemplate();
    }


    /**
     * formatta la data acquisita dal template per poterla correttamente salvare su db
     * @param string $dato
     * @author Riccardo
     * @return string
     */
    public function FormattaDataSQL($dato)
    {
        $aux= explode('/',$dato);
        return $result = $aux[2]."-".$aux[0]."-".$aux[1];
    }


    /**
     * formatta la data caricata dal db per poterla correttamente visualizzare su template
     * @param string $dato
     * @author Riccardo
     * @return string
     */
    public function FormattaDatafromSQL($dato)
    {   
        $aux= explode('-',$dato);
        return $result = $aux[1]."/".$aux[2]."/".$aux[0];
    }


    //ELIMINAZIONI


    /**
     * provvede all'eliminazione di un viaggio e a tutte le citta,luoghi,commenti relativi
     * @author Riccardo
     * @return string
     */
    public function Elimina_viaggio()
    {
        $view=USingleton::getInstance('VModifica');
        $id=$view->getIdViaggio();
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->loadViaggio($id);
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
                    $FCommento= new FCommento();
                    foreach ($lista_luoghi as $luogo)
                    {
                        $elenco_commenti=$luogo->getElencoCommenti();
                        foreach ($elenco_commenti as $commento)
                        {
                            $FCommento->delete($commento);
                        }
                        if($luogo->immagini != "")
                        {
                            $file = "templates/main/template/images/foto_luogo/".$luogo->immagini;
                            unlink($file);
                            $FLuogo->delete($luogo);
                        }
                    }
                    $FCitta->delete($citta);
                }
            }
            $FViaggio->delete($viaggio);
        }
        $viaggio=USingleton::getInstance('CViaggio');
        return $viaggio->visualizzaViaggiTable();
    }


    /**
     * provvede all'eliminazione di una citta e a tutti i luoghi e commenti relativi
     * @author Riccardo
     * @return string
     */
    public function Elimina_citta()
    {
        $view=USingleton::getInstance('VModifica');
        $id=$view->getIdViaggio();
        $nomecitta=$view->getNomeCitta();
        $FCitta=new FCitta();
        $key['idviaggio']=(int) $id;
        $key['nome']=$nomecitta;
        $citta=$FCitta->loadCitta($key);
        if ($citta!= NULL || $citta!= false)
        {
            $elenco_luoghi=$citta->getElencoLuoghi();//tiene la lista del luoghi
            $FLuogo=new FLuogo();
            $FCommento= new FCommento();
            foreach ($elenco_luoghi as $luogo)
            {
                $elenco_commenti=$luogo->getElencoCommenti();
                foreach ($elenco_commenti as $commento)
                {
                    $FCommento->delete($commento);
                }
                if($luogo->immagini != "")
                {
                    $file = "templates/main/template/images/foto_luogo/".$luogo->immagini;
                    unlink($file);
                    $FLuogo->delete($luogo);
                }
            }
            $FCitta->delete($citta);
        }
        $viaggio=USingleton::getInstance('CViaggio');
        return $viaggio->visualizzaCittaTable();
    }


    /**
     * provvede all'eliminazione di un luogo e a tutti i commenti relativi
     * @author Riccardo
     * @return string
     */
    public function Elimina_luogo()
    {
        $view=USingleton::getInstance('VModifica');
        $id=$view->getIdViaggio();
        $nomecitta=$view->getNomeCitta();
        $nomeluogo=$view->getNomeLuogo();
        $FLuogo=new FLuogo();
        $key['idviaggio']=(int) $id;
        $key['nomecitta']=$nomecitta;
        $key['nome']=$nomeluogo;
        $luogo=$FLuogo->loadLuogo($key);
        if ($luogo!= NULL || $luogo!=false)
        {
            $elenco_commenti=$luogo->getElencoCommenti();
            $FCommento=new FCommento();
            foreach ($elenco_commenti as $commento)
            {
                $FCommento->delete($commento);
            }
            if($luogo->immagini != "")
            {
                $file = "templates/main/template/images/foto_luogo/".$luogo->immagini;
                unlink($file);
                $FLuogo->delete($luogo);
            }
        }
        //cancellare nomecitta
        $viaggio=USingleton::getInstance('CViaggio');
        return $viaggio->visualizzaLuoghiTable();
    }
}
?>