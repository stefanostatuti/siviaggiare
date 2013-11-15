<?php
/**
 * @access public
 * @package Controller
 */
class CRicerca
{

    /**
     * @var $_term Variabile dove il plugin autocomplete imposta la parola da cercare
     */
    private $_term = null;


    /**
     * Smista le richieste ai vari metodi
     *
     * @return mixed
     */
    public function smista()
    {
        $view=USingleton::getInstance('VRicerca');
        switch ($view->getTask())
        {
            case 'autocomplete':
                return $this->eseguiRicercaAutocomplete();
            case 'ricerca':
                return $this->ricerca();
            case 'visualizza_viaggio':
                return $this->visualizzaViaggio();
            case 'visualizza_commenti':
                return $this->visualizzaCommenti();
            case 'inserisci_commento':
                return $this->inserisciCommento();
            case 'ricerca_menu_laterale':
                return $this->RicercaMenuLaterale();
            case 'aggiungi_feedback_citta':
                return $this->aggiungiFeedbackCitta();
            case 'aggiungi_feedback_luogo':
                return $this->aggiungiFeedbackLuogo();
            default:
                return $this->impostaPaginaRicerca();
        }
    }


    /**
     * Imposta la pagina di ricerca
     *
     * @return string
     */
    public function impostaPaginaRicerca()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('pagina_ricerca');
        return $VRicerca->processatemplate();
    }


    /**
     * Imposta per la ricerca dai menu laterali il contenuto della pagina principale
     * @author francesco
     * @return void
     */
    public function RicercaMenuLaterale()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('pagina_ricerca');
        echo $VRicerca->processatemplate();
    }


    /**
     * Esegue la ricerca per il plugin autocomplete
     * @author francesco
     * @return void
     */
    public function eseguiRicercaAutocomplete()
    {
        if ( !isset($_REQUEST['term']) )
            exit;

        $this->_term = mysql_real_escape_string($_REQUEST['term']);
        $Fdb=USingleton::getInstance('FDatabase');
        $query = 'SELECT DISTINCT nome, nomecitta, idviaggio FROM luogo WHERE nome like "%'. $this->_term .'%" group by nome order by nome asc limit 0,10';
        $Fdb->query($query);
        $array=$Fdb->getQueryInArray();
        $return = array();
        for($i=0;$i<count($array);$i++)
        {
            $return[] = array(
                'label' => $array[$i]['nome'],
                'value' => $array[$i]['nome'],
                'idviaggio' => $array[$i]['idviaggio'],
                'nomecitta' =>$array[$i]['nomecitta']
            );
        }
        $query = 'SELECT distinct nome, stato, idviaggio FROM citta WHERE nome like "%'. $this->_term .'%" group by nome order by nome asc limit 0,10';
        $Fdb->query($query);
        $array=$Fdb->getQueryInArray();
        for($i=0;$i<count($array);$i++)
        {
            $return[] = array(
                'label' => $array[$i]['nome'],
                'value' => $array[$i]['nome'],
                'idviaggio' => $array[$i]['idviaggio'],
                'stato' =>$array[$i]['stato']
            );
        }
        //jQuery vuole dati JSON
        echo json_encode($return);
        flush();
    }


    /**
     * Esegue la ricerca e imposta i dati nel relativo template
     * @author francesco
     * @return string
     */
    public function ricerca()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $search=$VRicerca->getNome();
        $FLuogo= new FLuogo();
        $risultatoluoghi=$FLuogo->loadRicercaFeedback('nome',$search);
        foreach ($risultatoluoghi as $luogo)
        {
            $FViaggio= new FViaggio();
            $viaggio=$FViaggio->loadViaggio($luogo->idviaggio);
            $date[]=$viaggio->datafine;
            $utente_luogo[]=$viaggio->utenteusername;
        }
        $FCitta= new FCitta();
        $risultatocitta=$FCitta->loadRicercaFeedback('nome',$search);
        foreach ($risultatocitta as $citta)
        {
            $FViaggio= new FViaggio();
            $viaggio=$FViaggio->loadViaggio($citta->idviaggio);
            $utente_citta[]=$viaggio->utenteusername;
        }
        $VRicerca->setLayout('risultati');
        $VRicerca->impostaDati('luoghi',$risultatoluoghi);
        if (isset($date))
            $VRicerca->impostaDati('data',$date);
        $session=USingleton::getInstance('USession');
        if($session->leggi_valore('username')!=false)
        {
            if (isset($utente_luogo))
                $VRicerca->impostaDati('utente_luogo_logged',$utente_luogo);
            if (isset($utente_citta))
                $VRicerca->impostaDati('utente_citta_logged',$utente_citta);
            $VRicerca->impostaDati('utente_sessione',$session->leggi_valore('username'));
        }
        else
        {
            if (isset($utente_luogo))
                $VRicerca->impostaDati('utente_luogo',$utente_luogo);
            if (isset($utente_citta))
                $VRicerca->impostaDati('utente_citta',$utente_citta);
        }
        $VRicerca->impostaDati('citta',$risultatocitta);
        echo $VRicerca->ProcessaTemplate();
    }


    /**
     * Carica i dati del viaggio selezionato
     * @author francesco
     */
    public function visualizzaViaggio()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $session=USingleton::getInstance('USession');
        $autenticato=$session->leggi_valore('username');
        $Fviaggio = new FViaggio();
        $viaggio=$Fviaggio->loadViaggio($VViaggio->getIdViaggio());
        $viaggio->getElencoCitta();
        foreach ($viaggio->getElencoCitta() as $citta)
        {
            $rilasciato_citta[]=$citta->verificaFeedbackUtente($session->leggi_valore('username'));
            $citta->getElencoLuoghi();
        }
        foreach ($citta->getElencoLuoghi() as $luogo)
        {
            $luogo->getElencoCommenti();
        }
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('pagina_viaggio');
        if (isset($rilasciato_citta))
            $VRicerca->impostaDati('rilasciato_citta',$rilasciato_citta);
        $VRicerca->impostaDati('viaggio',$viaggio);
        $VRicerca->impostaDati('autenticato',$autenticato);
        echo $VRicerca->ProcessaTemplate();
    }


    /**
     * Carica i commenti relativi ad un viaggio
     * @author francesco
     */
    public function visualizzaCommenti()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $FLuogo = new FLuogo();
        $key['idviaggio']=$VViaggio->getIdViaggio();
        $key['nome']=$VViaggio->getNomeLuogo();
        $key['nomecitta']=$VViaggio->getNomeCitta();
        $luogo=$FLuogo->loadLuogo($key);
        $luogo->getElencoCommenti();
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('pagina_commento');
        $VRicerca->impostaDati('luogo', $luogo);
        $session=USingleton::getInstance('USession');
        $autenticato=$session->leggi_valore('username');
        $VRicerca->impostaDati('autenticato', $autenticato);
        if($autenticato!=false)
        {
            $VRicerca->setLayoutInterno('inserimento_commento');
            $inserimento=$VRicerca->processaTemplateInterno();
            $VRicerca->impostaDati('inserimento_commento',$inserimento);
        }
        $FViaggio = new FViaggio();
        $viaggio=$FViaggio->loadViaggio($VViaggio->getIdViaggio());
        $VRicerca->impostaDati('utente', $viaggio->utenteusername);
        $rilasciato_luogo = $luogo->verificaFeedbackUtente($session->leggi_valore('username'));
        $VRicerca->impostaDati('rilasciato_luogo', $rilasciato_luogo);
        echo $VRicerca->processaTemplate();
    }


    /**
     * Salva un commento inserito da un utente e lo restituisce in visualizzazione
     * @author francesco
     */
    public function inserisciCommento()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $FCommento=new FCommento();
        $commento=new ECommento();
        $dati_commento=$VRicerca->getDatiCommento();
        $keys=array_keys($dati_commento);
        $i=0;
        foreach ($dati_commento as $dato)
        {
            $commento->$keys[$i]=$dato;
            $i++;
        }
        $FCommento->store($commento);
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('ultimo_commento_inserito');
        $commento=$FCommento->loadCommento($commento->id);
        $VRicerca->impostaDati('commento', $commento);
        echo $VRicerca->processaTemplate();
    }


    /**
     * Aggiunge un feedback ad una città
     * @author francesco
     */
    public function aggiungiFeedbackCitta()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $dati=$VRicerca->getDatiCitta();
        $session=USingleton::getInstance('USession');
        $dati['username']=$session->leggi_valore('username');
        $FCitta=new FCitta();
        $feedback = $FCitta->updateFeedback($dati);
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        if($feedback!=false)
        {
            echo $feedback;
        }
    }


    /**
     * Aggiunge un feedback ad una luogo
     * @author francesco
     */
    public function aggiungiFeedbackLuogo()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $dati=$VRicerca->getDatiLuogo();
        $session=USingleton::getInstance('USession');
        $dati['username']=$session->leggi_valore('username');
        $FLuogo=new FLuogo();
        $feedback = $FLuogo->updateFeedback($dati);
        if($feedback!=false)
        {
            echo $feedback;
        }
    }
}
?>