<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 18/09/13
 * Time: 10.46
 * To change this template use File | Settings | File Templates.
 */

class CRicerca {

    private $_term = null;      //$_REQUEST['term']---->variabile dove l'autocomplete mette la parola da cerca

    public function smista()
    {
        $view=USingleton::getInstance('VRicerca');
        switch ($view->getTask())
        {
            case 'autocomplete':
                return $this->eseguiRicercaAutocomplete();
            case 'menu_citta':
                return $this->menuCitta();
            case 'ricerca':
                return $this->ricerca();
            case 'visualizza_viaggio':
                return $this->visualizzaViaggio();
            case 'visualizza_commenti':
                return $this->visualizzaCommenti();
            case 'inserisci_commento':
                return $this->inserisciCommento();
            default:
                return $this->impostaPaginaRicerca();
        }
    }

    public function impostaPaginaRicerca()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('pagina_ricerca');
        //var_dump($modulo);
        return $VRicerca->processatemplate();
    }

    public function eseguiRicercaAutocomplete()
    {
        if ( !isset($_REQUEST['term']) )
            exit;

        $this->_term = mysql_real_escape_string($_REQUEST['term']);
        $Fdb=USingleton::getInstance('FDatabase');
        $query = 'SELECT distinct nome, nomecitta, idviaggio FROM luogo WHERE nome like "%'. $this->_term .'%" group by nome order by nome asc limit 0,10';
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

    public function menuCitta()
    {
        $ciao='ciao';
        var_dump($ciao);
        echo $ciao;
    }

    public function ricerca()
    {
        $VRicerca=USingleton::getInstance('VRicerca');
        $search=$VRicerca->getNome();
        $FLuogo= new FLuogo();
        $risultatoluoghi=$FLuogo->loadRicercaFeedback('nome',$search);
        $VRicerca=USingleton::getInstance('VRicerca');
        foreach ($risultatoluoghi as $luogo)
        {
            $FViaggio= new FViaggio();
            $viaggio=$FViaggio->loadViaggio($luogo->idviaggio);
            $date[]=$viaggio->datafine;
        }
        $FCitta= new FCitta();
        $risultatocitta=$FCitta->loadRicercaFeedback('nome',$search);
        $VRicerca->setLayout('risultati');
        $VRicerca->impostaDati('luoghi',$risultatoluoghi);
        if (isset($date))
            $VRicerca->impostaDati('data',$date);
        $VRicerca->impostaDati('citta',$risultatocitta);
        echo $VRicerca->ProcessaTemplate();
    }

    public function visualizzaViaggio()
    {
        $VViaggio=USingleton::getInstance('VViaggio');
        $Fviaggio = new FViaggio();
        $viaggio=$Fviaggio->loadViaggio($VViaggio->getIdViaggio());
        $viaggio->getElencoCitta();
        foreach ($viaggio->getElencoCitta() as $citta)
        {
            $citta->getElencoLuoghi();
        }
        foreach ($citta->getElencoLuoghi() as $luogo)
        {
            $luogo->getElencoCommenti();
        }
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('pagina_viaggio');
        $VRicerca->impostaDati('viaggio',$viaggio);
        echo $VRicerca->ProcessaTemplate();
    }

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
        if($autenticato!=false)
        {
            $VRicerca->setLayoutInterno('inserimento_commento');
            $inserimento=$VRicerca->processaTemplateInterno();
            $VRicerca->impostaDati('inserimento_commento',$inserimento);
        }
        echo $VRicerca->processaTemplate();
    }

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
        //debug($luogo);
        $FCommento->store($commento);
        $VRicerca=USingleton::getInstance('VRicerca');
        $VRicerca->setLayout('ultimo_commento_inserito');
        $VRicerca->impostaDati('commento', $commento);
        echo $VRicerca->processaTemplate();
    }
}