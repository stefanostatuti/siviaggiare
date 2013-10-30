<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.47
 * To change this template use File | Settings | File Templates.
 */
class CModifica
{

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
    public function impostaPaginaCompilazioneViaggio()
    {
            $VModifica=USingleton::getInstance('VModifica');
            $session=USingleton::getInstance('USession');
            $VModifica->setLayout('inserimento_viaggio');
            $VModifica->impostaDati('autore',$session->leggi_valore('username'));
            return $VModifica->processaTemplate();
    }


    public function impostaPaginaCompilazioneCitta()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession');
        //$session->cancella_valore('viaggio'); non dovrebbe servire
        $VModifica->setLayout('inserimento_citta');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        $Fviaggio= new FViaggio();
        $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
        $VModifica->impostaDati('idviaggio',$viaggio->id);
        return $VModifica->processaTemplate();
  
    }


    public function impostaPaginaCompilazioneLuogo()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession');
        $VModifica->setLayout('inserimento_luogo');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        $Fviaggio= new FViaggio();
        $viaggio = $Fviaggio->LastViaggioUtente($session->leggi_valore('username'));
        $VModifica->impostaDati('idviaggio',$viaggio->id);
        return $VModifica->processaTemplate();
    }



    //salvataggi
    public function UpdateViaggio()
    {   
        $VModifica=USingleton::getInstance('VModifica');
        $FViaggio=new FViaggio();
        $session=USingleton::getInstance('USession');
        $ID= $session->leggi_valore('idviaggiomod');
        $VModifica->impostaDati('autore',$session->leggi_valore('username') );
        $VModifica=USingleton::getInstance('VModifica');
        $dati_viaggio=$VModifica->getDatiViaggio();
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
            $viaggio->id=$ID;//passo id a viaggio da modificare
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
            $citta->nome = $this->FormattaApostrofoSQL($citta->nome);
            $citta->stato = $this->FormattaApostrofoSQL($citta->stato);
            $citta->tipoalloggio = $this->FormattaApostrofoSQL($citta->tipoalloggio);
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
            $VModifica->impostaDati('idviaggio',$dati_citta['idviaggio'] );
            $datiutente=$validacitta->getdatipersonali();
            $VModifica->impostaDati('citta', $datiutente);
            $this->_errore='DATI ERRATI';
            $VModifica->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $VModifica->processaTemplate();
    }


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
            $luogo->nomecitta= $session->leggi_valore('cittavisitata');
            $luogo->nome = $this->FormattaApostrofoSQL($luogo->nome);
            if ($luogo->percorso != null)
            {
            $luogo->percorso = $this->FormattaApostrofoSQL($luogo->percorso);
            }
            if ($luogo->commentolibero != null)
            {
            $luogo->commentolibero = $this->FormattaApostrofoSQL($luogo->commentolibero);
            }
            $luogo->nomecitta = $this->FormattaApostrofoSQL($luogo->nomecitta);
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
            $VModifica->impostaDati('idviaggio',$dati_luogo['idviaggio']);
            $datiutente=$validaluogo->getdatipersonali();
            $VModifica->impostaDati('luogo', $datiutente);
            $this->_errore='DATI ERRATI';
            $VModifica->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $VModifica->processaTemplate();
    }
    
    
    //controlli validazioni ajax
     
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
    
    
    //modifiche
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
    
    
    public function ModificaCitta()
    {
        $VModifica=USingleton::getInstance('VModifica'); 
        $session=USingleton::getInstance('USession');
        $FCitta=new FCitta();
        $dati['idviaggio']= (int)$VModifica->getIdViaggio();
        $dati['nome']= $this->FormattaApostrofoSQL($VModifica->getNomeCitta());
        $citta=$FCitta->loadCitta($dati);
        $arraydata['datainizio']=$this->FormattaDatafromSQL($citta->datainizio);
        $arraydata['datafine']=$this->FormattaDatafromSQL($citta->datafine); 
        $arraydata['citta']=$this->FormattaApostrofofromSQL($citta->nome);
        $arraydata['stato']=$this->FormattaApostrofofromSQL($citta->stato);
        $arraydata['tipoalloggio']=$this->FormattaApostrofofromSQL($citta->tipoalloggio);
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
    
    
    public function ModificaLuogo()
    {
        $VModifica=USingleton::getInstance('VModifica');
        $session=USingleton::getInstance('USession');
        $FLuogo=new FLuogo();
        $dati['idviaggio']= $VModifica->getIdViaggio();
        $dati['nome']= $this->FormattaApostrofoSQL($VModifica->getNomeLuogo());
        $dati['nomecitta']= $this->FormattaApostrofoSQL($VModifica->getNomeCitta());
        $luogo=$FLuogo->loadLuogo($dati);
        $arraydata['luogo']=$this->FormattaApostrofofromSQL($luogo->nome);
        $arraydata['sitoweb']=$luogo->sitoweb;; 
        $arraydata['percorso']=$this->FormattaApostrofofromSQL($luogo->nomecitta);
        $arraydata['costobiglietto']=$luogo->costobiglietto;
        $arraydata['guidaturistica']=$luogo->guida;
        $arraydata['coda']=$luogo->coda;
        $arraydata['duratavisita']=$luogo->durata;
        $arraydata['commento']=$this->FormattaApostrofofromSQL($luogo->commentolibero);
        $VModifica->setLayout('inserimento_luogo');
        $VModifica->impostaDati('controller','modifica');
        $VModifica->impostaDati('task','update_luogo');
        $VModifica->impostaDati('autore',$session->leggi_valore('username'));
        $VModifica->impostaDati('idviaggio',$dati['idviaggio'] );
        $VModifica->impostaDati('luogo', $arraydata);
        $VModifica->impostaDati('readonly', 'readonly');
        $this->_errore='Modifica in corso';
        $VModifica->impostaErrore($this->_errore);
        $this->_errore='';
        return $VModifica->processaTemplate();
    }
    
    
    public function FormattaDataSQL($dato)
    {
        $aux= explode('/',$dato);
        return $result = $aux[2]."-".$aux[0]."-".$aux[1];
    }
    
    
    public function FormattaDatafromSQL($dato)
    {   
        $aux= explode('-',$dato);
        return $result = $aux[1]."/".$aux[2]."/".$aux[0];
    }
    
    
    public function Elimina_viaggio()
    {
        // delete è la funzione del fdb per cancellare tabelle pero per viaggio bisogna cercare anche citta e luogo relativo al viaggio
        var_dump('viaggio elim');
     }   
    
    
    public function Elimina_citta()
    {
        // comer per update bisogna passare un oggetto con campo array e non chiave singola
        var_dump('citta elim');
    }

    
    public function Elimina_luogo()
    {
        // comer per update bisogna passare un oggetto con campo array e non chiave singola
        var_dump('luogo elim');
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