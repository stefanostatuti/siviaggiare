<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.47
 * To change this template use File | Settings | File Templates.
 */

class CViaggio {



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
            case 'salva_viaggio'://1-2
                return $this->salvaViaggio();
            case 'salva_luogo':
                return $this->salvaLuogo();
            case 'salva_citta':
                return $this->salvaCitta();

            //caricamenti
            case 'visualizza_viaggi_inseriti':
                return $this->visualizzaViaggiTable();//return $this->caricaViaggi();
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
        }
    }

    public function impostaPaginaCompilazioneViaggio()
    {
            $VViaggio=USingleton::getInstance('VViaggio');
            $session=USingleton::getInstance('USession');
            $VViaggio->setLayout('inserimento_viaggio');
            $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
            return $VViaggio->processaTemplate();
    }

    public function impostaPaginaCompilazioneLuogo()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $session=USingleton::getInstance('USession');
        $VViaggio->setLayout('inserimento_luogo');
        $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
        $VViaggio->impostaDati('idviaggio',$session->leggi_valore('idviaggio'));
        return $VViaggio->processaTemplate();
    }

    public function impostaPaginaCompilazioneCitta()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $session=USingleton::getInstance('USession');
        $VViaggio->setLayout('inserimento_citta');
        $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
        $VViaggio->impostaDati('idviaggio',$session->leggi_valore('idviaggio'));
        return $VViaggio->processaTemplate();
    }

    public function salvaViaggio()
    {
        $view=USingleton::getInstance('VViaggio');
        $dati_viaggio=$view->getDatiViaggio();
        $viaggio=new EViaggio();
        $FViaggio=new FViaggio();

        //viaggio non esistente (non esiste gia nel DB quindi lo scrivo)
        $keys=array_keys($dati_viaggio);
        $i=0;
        $validaviaggio=USingleton::getInstance('Vvalidaviaggio');
        $validaviaggio->validacampi($dati_viaggio);
        if(!$validaviaggio->getErrors())
        {
            foreach ($dati_viaggio as $dato)
            {
                $viaggio->$keys[$i]=$dato;
                $i++;
            }
            $FViaggio->store($viaggio);
            $session=USingleton::getInstance('USession');
            $session->imposta_valore('idviaggio',$viaggio->id);
            //$view->show('conferma_inserimento_viaggio.tpl');
            $view->setLayout('conferma_inserimento_viaggio');
        }else
        {
            $view->setLayout('inserimento_viaggio');
            $dati=$validaviaggio->getErrors();
            $view->impostaDati('messaggi' , $dati);
            $datiutente=$validaviaggio->getdatipersonali();
            $view->impostaDati('viaggio', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $view->processaTemplate();
    }

    //salva citta non funziona poichè puo essere inserito SOLO se c'è un ID di un viaggio collegato(infatti la sessione
    //da come id viaggio = null
    // il codice sotto pero funzionava sulla mia versione quindi è corretto

    public function salvaCitta()
    {
        //debug("ci entro?");
        $view=USingleton::getInstance('VViaggio');
        //debug($view);
        $dati_citta=$view->getDatiCitta();
        //debug($dati_citta);//$view->getDatiRegistrazione();
        $validacitta=USingleton::getInstance('Vvalidacitta');
        if($validacitta->getErrors()==false)
        {
            $citta=new ECitta();
            $FCitta=new FCitta();
            //$compilato_correttamente= false;

            //Dò per scontato che la citta sia non esistente (non esiste nel DB quindi lo scrivo)
            //questo controllo teoricamente è superfluo poichè si potra inserire una citta SOLO se si compila un nuovo viaggio.

            $keys=array_keys($dati_citta);
            $i=0;
            foreach ($dati_citta as $dato)
            {
                $citta->$keys[$i]=$dato;
                $i++;
            }
            $FCitta->store($citta);
            $view->setLayout('conferma_inserimento_citta');
            //$compilato_correttamente=true;
        }else
        {
            $view->setLayout('inserimento_citta');
            $dati=$validacitta->getErrors();
            $view->impostaDati('messaggi' , $dati);
            $datiutente=$validacitta->getdatipersonali();
            $view->impostaDati('citta', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $view->processaTemplate();
    }

    public function caricaViaggi(){     //è deprecata!!!!!!

        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $viaggi=$EUtente->getElencoViaggi();
        //debug($viaggi);
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_viaggi');
        $view->impostaDati('results',$viaggi);
        return $view->processaTemplate();
    }

    //salva Luogo non funziona poichè puo essere inserito SOLO se c'è un ID di un viaggio, e di una citta collegata
    // questa parte l'ha fatta checco.
    public function salvaLuogo() {
        //debug("ci entro?");
        $view=USingleton::getInstance('VViaggio');
        $dati_luogo=$view->getDatiLuogo();
        //debug($dati_luogo);
        $luogo=new ELuogo();
        $FLuogo=new FLuogo();
        $keys=array_keys($dati_luogo);
        //debug($keys);
        $i=0;
        $validaluogo=USingleton::getInstance('Vvalidaluogo');
        $dati_luogo['input']=//aggiungo il campo budget del viaggio per un ulteriore controllo
            //var_dump($var);//devo fare una query al database per ottenere budget
            $validaluogo->validacampi($dati_luogo);
        if(!$validaluogo->getErrors())
        {
        foreach ($dati_luogo as $dato) {
            $luogo->$keys[$i]=$dato;
            $i++;
        }
        //debug($luogo);
        $FLuogo->store($luogo);
        $view->setLayout('conferma_inserimento_luogo');
        }else
        {
            $view->setLayout('inserimento_luogo');
            $dati=$validaluogo->getErrors();
            $view->impostaDati('messaggi' , $dati);
            $datiutente=$validaluogo->getdatipersonali();
            $view->impostaDati('luogo', $datiutente);
            $this->_errore='DATI ERRATI';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $view->processaTemplate();
    }

/*    public function visualizzaLuoghiTable()
    {
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi();
        $luoghi=array();
        $z=0;
        for($i=0;$i<count($lista_viaggi);$i++)
        {
            $lista_luoghi=$lista_viaggi[$i]->getElencoLuoghi();
            for($j=0;$j<count($lista_luoghi);$j++)
            {
                $luoghi[$z]=$lista_luoghi[$j];
                $z++;
            }
        }
        //debug($luoghi);
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_luoghi');
        $view->impostaDati('results',$luoghi);
        return $view->processaTemplate();
    }
*/


    public function visualizzaLuoghiTable()
    {   //questa versiona ELIMINA I CLONI
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi(); //qua recupero i viaggi dell'utente
        //debug("controllo se gia ho compilato qualche array ".count($lista_viaggi)." viaggi");

        $cont=0; //memorizza le posizioni dei PDI inseriti in luoghi risultato
        $luoghi_risultato=array();//è quello che poi mandero in stampa al TPL

        foreach($lista_viaggi as $viaggio)
        {
            $lista_citta=$viaggio->getElencoCitta(); //qua recupero le citta del viaggio

            //debug("controllo se gia ho compilato qualche array ".count($lista_citta)." citta");

            foreach($lista_citta as $citta)
            {
                $lista_luoghi= $citta->getElencoLuoghi(); //qua recupero le citta di un singolo viaggio
                //debug("controllo se gia ho compilato l'array con ---> ".count($lista_luoghi)." dei luoghi");

                if ($lista_luoghi !=  false) { //quindi ci sono elementi

                    foreach($lista_luoghi as $luogo)
                    {
                        //debug("contatore in ingresso: ".$cont);
                        //debug("quanti elementi in luoghi risultato ".count($luoghi_risultato));

                        $verifica=in_array($luogo,$luoghi_risultato);//verifica se un elemento è presente in un array

                        if ($verifica==true)//quindi è presente
                        {
                            //debug("è presente quindi non lo aggiungo");
                        }

                        else if($verifica==false)  //quindi non è presente
                        {
                            //debug("luogo NON presente!!!!");
                            //debug("-------------------->quindi lo aggiungo");
                            $luoghi_risultato[$cont]=$luogo; //metto in pos $cont il luogo testato
                            $cont++; //sposto cont
                        }

                        //debug("contatore attuale dopo il test: ".$cont);
                        //debug("contatore luoghi risultato dopo il test: ".count($luoghi_risultato));
                    }
                }
            }
        }
        //mando in stampa tutto
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_luoghi');
        $view->impostaDati('results',$luoghi_risultato);
        return $view->processaTemplate();
    }

    public function visualizzaViaggiTable()
    {   //questa versiona ELIMINA I CLONI
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi(); //qua recupero i viaggi dell'utente
        //debug("controllo se gia ho compilato qualche array ".count($lista_viaggi)." viaggi");
        //mando in stampa tutto
        $VViaggio=USingleton::getInstance('VViaggio');
        $VViaggio->setLayout('elenco_viaggi');
        $VViaggio->impostaDati('results',$lista_viaggi);
        return $VViaggio->processaTemplate();
    }

    public function visualizzaCittaTable()
    {   //questa versiona ELIMINA I CLONI
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        $FUtente=new FUtente();
        $EUtente=$FUtente->load($user);
        $lista_viaggi=$EUtente->getElencoViaggi(); //qua recupero i viaggi dell'utente
        //debug("controllo se gia ho compilato qualche array ".count($lista_viaggi)." viaggi");

        $cont=0; //memorizza le posizioni dei PDI inseriti in luoghi risultato
        $citta_risultato=array();//è quello che poi mandero in stampa al TPL

        foreach($lista_viaggi as $viaggio)
        {
            $lista_citta=$viaggio->getElencoCitta(); //qua recupero le citta del viaggio

            //debug("controllo se gia ho compilato qualche array ".count($lista_citta)." citta");

            foreach($lista_citta as $citta)
            {
                //$lista_luoghi= $citta->getElencoLuoghi(); //qua recupero le citta di un singolo viaggio
                //debug("controllo se gia ho compilato l'array con ---> ".count($lista_luoghi)." dei luoghi");

                //if ($lista_luoghi !=  false) { //quindi ci sono elementi

                //     foreach($lista_luoghi as $luogo)
                //    {
                //debug("contatore in ingresso: ".$cont);
                //debug("quanti elementi in luoghi risultato ".count($luoghi_risultato));

                $verifica=in_array($citta,$citta_risultato);//verifica se un elemento è presente in un array

                if ($verifica==true)//quindi è presente
                {
                    //debug("è presente quindi non lo aggiungo");
                }

                else if($verifica==false)  //quindi non è presente
                {
                    //debug("CITTA NON presente!!!!");
                    //debug("-------------------->quindi lo aggiungo");
                    $citta_risultato[$cont]=$citta; //metto in pos $cont il luogo testato
                    $cont++; //sposto cont
                }

                //debug("contatore attuale dopo il test: ".$cont);
                //debug("contatore luoghi risultato dopo il test: ".count($luoghi_risultato));
            }
        }
        //mando in stampa tutto
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_citta');
        $view->impostaDati('results',$citta_risultato);
        return $view->processaTemplate();

    }

    public function visualizzaCommentiTable()
    {
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        //$FUtente=new FUtente();
        //$EUtente=$FUtente->load($user);
        $FCommento = new FCommento();
        //$FCommento = $FCommento->loadCommento($user);
        $FCommenti = $FCommento->loadCommentiUtente(array($user));
        //debug("elementi dentro Fcommento: ".count($FCommento));

        $cont=0; //memorizza le posizioni dei commenti inseriti in luoghi risultato
        $commenti_risultato=array();//è quello che poi mandero in stampa al TPL
        //var_dump($FCommento);
        if ($FCommenti !=  false) { //quindi ci sono elementi
            //debug('ci entro?');
            foreach($FCommenti as $commento){
                //debug("------->");
                //var_dump($commento);
                $commenti_risultato[$cont]=$commento; //metto in pos $cont il commento testato
                $cont++; //sposto cont
                //debug("contatore attuale dopo il test: ".$cont);
            }

            //debug("contatore attuale dopo il test: ".$cont);
            //debug("contatore luoghi risultato dopo il test: ".count($commenti_risultato));
        }
        //mando in stampa tutto
        //var_dump($commenti_risultato);
        $view=USingleton::getInstance('VViaggio');
        $view->setLayout('elenco_commenti');
        $view->impostaDati('results',$commenti_risultato);
        //$view->show('viaggio_elenco_commenti.tpl');
        return $view->ProcessaTemplate();
    }



    public function visualizzaCitta()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCitta=new FCitta();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeCitta());
        //debug($key);
        $citta=$FCitta->loadCitta($key);
        $VViaggio->setLayout('dettagli_citta');
        $VViaggio->impostaDati('citta',$citta);
        return $VViaggio->processaTemplate();

        /*debug("ci entro?");
        //$session=USingleton::getInstance('USession');
        //$user=$session->leggi_valore('username');
        //$FUtente=new FUtente();
        //$EUtente=$FUtente->load($user);
        //$lista_viaggi=$EUtente->getElencoViaggi();
        foreach($lista_viaggi as $viaggio)
        {
            $lista_citta=$viaggio->getElencoCitta();
            foreach($lista_citta as $citta)
            {
                $view = USingleton::getInstance("VViaggio");
                $view->compilaTemplateCitta($citta);
            }
        }
        */
    }

    public function VisualizzaLuogo()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FLuogo=new FLuogo();
        $key=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeLuogo(),'nomecitta'=>$VViaggio->getNomeCitta());
        $luogo=$FLuogo->loadLuogo($key);
        $VViaggio->setLayout('dettagli_luogo');
        $VViaggio->impostaDati('luogo',$luogo);
        return $VViaggio->processaTemplate();
    }

    public function VisualizzaViaggio()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FViaggio=new FViaggio();
        $viaggio=$FViaggio->load($VViaggio->getIdViaggio());
        $VViaggio->setLayout('dettagli_viaggio');
        $VViaggio->impostaDati('viaggio',$viaggio);
        //debug($viaggio);
        return $VViaggio->processaTemplate();
    }

    public function VisualizzaCommento()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FCommento=new FCommento();
        //$id=array('idviaggio'=>$VViaggio->getIdViaggio(),'nome'=>$VViaggio->getNomeLuogo(),'nomecitta'=>$VViaggio->getNomeCitta());
        /*$id=$VViaggio->getIDCommento();
        debug('Questo è id del viaggio'.$id);
        $commento=$FCommento->loadCommento($id);
        $VViaggio->compilaTemplateLuogo($commento);//da sistemare*/
        debug($VViaggio->getIDCommento());
        $idcommento=$VViaggio->getIDCommento();
        debug($idcommento);
        $commento=$FCommento->loadCommento($idcommento);//qua copio in commento il risultato della query
        debug($commento);
        $VViaggio->setLayout('dettagli_commento');
        $VViaggio->impostaDati('commento',$commento);
        //debug($viaggio);
        return $VViaggio->processaTemplate();
    }

    public function salvaCommento()
    {
        //debug("ci entro?");
        $view=USingleton::getInstance('VViaggio');
        $dati_luogo=$view->getDatiLuogo();
        //debug($dati_luogo);
        $luogo=new ELuogo();
        $FLuogo=new FLuogo();
        $keys=array_keys($dati_luogo);
        debug($keys);
        $i=0;
        foreach ($dati_luogo as $dato)
        {
            $luogo->$keys[$i]=$dato;
            $i++;
        }
        //debug($luogo);
        $FLuogo->store($luogo);
        return $view->show('conferma_inserimento_luogo.tpl'); //verifica
    }//da sistemare
}
?>
