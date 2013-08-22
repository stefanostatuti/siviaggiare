<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Riso64Bit
 * Date: 20/08/13
 * Time: 16.47
 * To change this template use File | Settings | File Templates.
 */

class CViaggio {



    public function smista() {
        debug("entro dentro smista di CViaggio");
        $view=USingleton::getInstance('VRegistrazione');
        var_dump("questo è il task ".$view->getTask());
        switch ($view->getTask()) {


            case 'inserimento_viaggio':
                debug("lancio imposta pagina compilazione");
                return $this->impostaPaginaCompilazioneViaggio();
            case 'salvaviaggio':
                return $this->salvaViaggio();
            case 'viaggi_personali':
               return $this->caricaViaggi();
            default:
                return $this->impostaPaginaCompilazioneViaggio();
        }
    }

    public function impostaPaginaCompilazioneViaggio()
        {
            $VViaggio=USingleton::getInstance('VViaggio');
            $session=USingleton::getInstance('USession');
            $VViaggio->impostaDati('autore',$session->leggi_valore('username'));
            $VViaggio->show('Viaggio.tpl');
        }

    public function salvaViaggio() {
        debug("ci entro?");
        $view=USingleton::getInstance('VViaggio');
        $dati_viaggio=$view->getDatiViaggio();
        debug($dati_viaggio);//$view->getDatiRegistrazione();
        $viaggio=new EViaggio();
        $FViaggio=new FViaggio();
        $compilato_correttamente= false;

        //viaggio non esistente (non esiste gia nel DB quindi lo scrivo

        $keys=array_keys($dati_viaggio);
        $i=0;
        foreach ($dati_viaggio as $dato) {
            $viaggio->$keys[$i]=$dato;
            $i++;
            }
        $FViaggio->store($viaggio);
        $compilato_correttamente=true;
        return $view->show('conferma_registrazione.tpl'); //verifica
    }

    public function caricaViaggi(){
        debug("ci entro in caricaViaggi?");
        //$VViaggio=USingleton::getInstance('VViaggio');
        //recupero sessione per avere username
        $session=USingleton::getInstance('USession');
        $user=$session->leggi_valore('username');
        //

        $FViaggio=new FViaggio();
        $lista_viaggi=$FViaggio->loadRicerca('utenteusername',$user);
        $lista=array();
        for($i=0;$i<count($lista_viaggi);$i++)
        {
            $lista[$i] = $lista_viaggi[$i];
            debug("--->");
            var_dump($lista[$i]);
        }

        debug("risultato query: ");
        var_dump($lista);
        return $lista;
    }
}