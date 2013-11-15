<?php
/**
 * @access public
 * @package Controller
 */
class CProfilo
{

    /**
     * @var $_errore Variabile dove dove si impostano i messaggi di errore
     */
    private $_errore = '';


    /**
     * Smista le richieste ai vari metodi
     * @author Riccardo
     * @return mixed
     */
    public function smista()
    {
        $view=USingleton::getInstance('VProfilo');
        switch ($view->getTask())
        {
            case 'visualizza':
                return $this->VisualizzaProfiloPersonale();
            case 'visualizza_link':
                return $this->VisualizzaProfilo();
            case 'galleria':
                return $this->VisualizzaGalleria();
            case 'modifica_foto_profilo':
                return $this->ModificaFoto();
            case 'salva_foto':
                return $this->SalvaFotoProfilo();
            case 'aggiungi_foto_galleria':
                return $this->SalvaFotoGalleria();
            case 'salva_info':
                return $this->SalvaInfoProfilo();
            case 'elimina_galleria':
                return $this->EliminaFotoGalleria();
            default:
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->impostaPaginaRicerca();
        }
    }


    /**
     * visualizza le informazioni del profilo dell'utente loggato
     * @author Riccardo
     * @return string
     */
    public function VisualizzaProfiloPersonale()
    {
        $view=USingleton::getInstance('VProfilo');
        $session=USingleton::getInstance('USession');
        $Futente=USingleton::getInstance('FUtente');
        $username=$session->leggi_valore('username');
        $dati_utente=$Futente->loadUtente($username);
        $view->setLayout('profilo_dettagli');
        $view->impostaDati('modifica','modifica');
        $utente['nome']=$dati_utente->nome;
        $utente['cognome']=$dati_utente->cognome;
        $utente['residenza']=$dati_utente->residenza;
        $utente['nazione']=$dati_utente->nazione;
        $utente['datanascita']=$dati_utente->datanascita;
        $utente['mail']=$dati_utente->mail;
        $utente['telefono']=$dati_utente->telefono;
        $utente['lavoro']=$dati_utente->lavoro;
        $utente['sesso']=$dati_utente->sesso;
        $utente['usertpl']=$dati_utente->username;
        $utente['galleria']=$dati_utente->galleria;
        $view->impostaDati('profilo',$utente);
        return $view->processaTemplate();
    }


    /**
     * visualizza le informazioni del profilo di un utente
     * @author Riccardo
     * @return string
     */
    public function VisualizzaProfilo()
    {
        $view=USingleton::getInstance('VProfilo');
        $Futente=USingleton::getInstance('FUtente');
        $nome=$view->getUtente();
        $utente=$Futente->loadUtente($nome);
        $pagina=$view->getNumeroPagina();
        $view->setLayout('dettagli_user');
        $view->impostaDati('profilo',$utente);
        $view->impostaDati('pagina',$pagina);
        echo $view->processaTemplate();
    }


    /**
     * visualizza la galleria dell'utente loggato
     * @author Riccardo
     * @return string
     */
    public function VisualizzaGalleria()
    {
        $view=USingleton::getInstance('VProfilo');
        $session=USingleton::getInstance('USession');
        $view->setLayout('profilo_galleria');
        $Futente=USingleton::getInstance('FUtente');
        $username=$session->leggi_valore('username');
        $dati_utente=$Futente->load($username);
        $immagini=$dati_utente->galleria;
        $foto= explode('/',$immagini);
        $view->impostaDati('foto',$foto);
        return $view->processaTemplate();
    }


    /**
     * visualizza template per modificare la foto del profilo dell'utente loggato
     * @author Riccardo
     * @return string
     */
    public function ModificaFoto()
    {
        $view=USingleton::getInstance('VProfilo');
        $view->setLayout('modifica_foto_profilo');
        return $view->processaTemplate();
    }


    /**
     * modifica la foto del profilo dell'utente loggato
     * @author Riccardo
     * @return string
     */
    public function SalvaFotoProfilo()
    {
        $view=USingleton::getInstance('VProfilo');
        $session=USingleton::getInstance('USession');
        $foto=$view->getFotoProfilo();
        if($foto != false)
        {
            $Futente=USingleton::getInstance('FUtente');
            $username=$session->leggi_valore('username');
            $dati_utente=$Futente->load($username);
            if($dati_utente->foto != null)
            {
                $file = "templates/main/template/images/foto_profilo/".$dati_utente->foto;
                if (!unlink($file))
                {
                    $this->_errore="impossibile eliminare $file";
                    $view->impostaErrore($this->_errore);
                    $this->_errore='';
                }
                else
                {
                    $this->_errore="$file eliminato";
                    $view->impostaErrore($this->_errore);
                    $this->_errore='';
                }
            }
            $dati_utente->foto= $foto;
            $Futente->update($dati_utente);
            $this->_errore="L'upload del file è avvenuto correttamente";
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            return $this->ModificaFoto();
        }else
        {
            $this->_errore="Problemi nell'upload del file";
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            return $this->ModificaFoto();
        }
    }


    /**
     * salva le foto della galleria dell'utente loggato
     * @author Riccardo
     * @return string
     */
    public function SalvaFotoGalleria()
    {
        $view=USingleton::getInstance('VProfilo');
        $session=USingleton::getInstance('USession');
        $foto=$view->getFotoGalleria();
        if($foto != false)
        {
            $Futente=USingleton::getInstance('FUtente');
            $username=$session->leggi_valore('username');
            $dati_utente=$Futente->load($username);
            $aux=$dati_utente->galleria;
            if($aux == '')
            {
                $dati_utente->galleria= $foto;
            }else
            {
                $dati_utente->galleria= $aux."/".$foto;
            }
            $Futente->update($dati_utente);
            return $this->VisualizzaGalleria();
        }else
        {
            $this->_errore="Problemi nell'upload del file";
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            return $this->VisualizzaGalleria();
        }
    }


    /**
     * salva le modifiche del profilo dell'utente loggato
     * @author Riccardo
     * @return string
     */
    public function SalvaInfoProfilo()
    {
        $view=USingleton::getInstance('VProfilo');
        $session=USingleton::getInstance('USession');
        $validazione=USingleton::getInstance('Vvalidainfo');
        $label=$view->getLabel();
        $Futente=USingleton::getInstance('FUtente');
        $username=$session->leggi_valore('username');
        $dati_utente=$Futente->load($username);
        if($label == 'nome')
        {
            $campo=$view->getCampo();
            $dati_utente->nome = $campo;
            if($validazione->ValidaNome($campo))
            {
                $Futente->update($dati_utente);
                echo json_encode(true);
            }else
            {
                echo json_encode(false);
            }
        }elseif($label == 'cognome')
        {
            $campo=$view->getCampo();
            $dati_utente->cognome = $campo;
            if($validazione->ValidaCognome($campo))
            {
                $Futente->update($dati_utente);
                echo json_encode(true);
            }else
            {
                echo json_encode(false);
            }
        }elseif($label == 'lavoro')
        {
            $campo=$view->getCampo();
            $dati_utente->lavoro = $campo;
            $Futente->update($dati_utente);
            echo json_encode(true);
        }elseif($label == 'nazione')
        {
            $campo=$view->getCampo();
            $dati_utente->nazione = $campo;
            if( $validazione->ValidaNazione($campo))
            {
                $Futente->update($dati_utente);
                echo json_encode(true);
            }else
            {
                echo json_encode(false);
            }
        }elseif($label == 'residenza')
        {
            $campo=$view->getCampo();
            $dati_utente->residenza =$campo;
            if($validazione->ValidaResidenza($campo))
            {
                $Futente->update($dati_utente);
                echo json_encode(true);
            }else
            {
                echo json_encode(false);
            }
        }elseif($label == 'mail')
        {
            $campo=$view->getCampo();
            $dati_utente->mail=$campo;
            if($validazione->ValidaMail($campo))
            {
                $Futente->update($dati_utente);
                echo json_encode(true);
            }else
            {
                echo json_encode(false);
            }
        }elseif($label == 'telefono')
        {
            $campo=$view->getCampo();
            $dati_utente->telefono=$campo;
            if($validazione->ValidaTelefono($campo))
            {
                $Futente->update($dati_utente);
                echo json_encode(true);
            }else
            {
                echo json_encode(false);
            }
        }elseif($label == 'sesso')
        {
            $campo=$view->getCampo();
            $dati_utente->sesso=$campo;
            $Futente->update($dati_utente);
            echo json_encode(true);
        }elseif($label == 'data')
        {
            $campo=$view->getCampo();
            $dati_utente->datanascita=$campo;
            $Futente->update($dati_utente);
            echo json_encode(true);
        }
    }


    /**
     * elimina tutte le foto della galleria dell'utente loggato
     * @author Riccardo
     * @return string
     */
    public function EliminaFotoGalleria()
    {
        $view=USingleton::getInstance('VProfilo');
        $session=USingleton::getInstance('USession');
        $Futente=USingleton::getInstance('FUtente');
        $username=$session->leggi_valore('username');
        $dati_utente=$Futente->load($username);
        if($dati_utente->galleria != null)
        {
            $foto=$dati_utente->galleria;
            $aux= explode('/',$foto );
            $count=count($aux);
            for($i=0;$i<$count;$i++)
            {
                $file = "templates/main/template/images/galleria/".$aux[$i];
                if (!unlink($file))
                {
                    $this->_errore="impossibile eliminare $file";
                    $view->impostaErrore($this->_errore);
                    $this->_errore='';
                }
                else
                {
                    $this->_errore="$file eliminato";
                    $view->impostaErrore($this->_errore);
                    $this->_errore='';
                }
            }
        }
        $dati_utente->galleria="";
        $Futente->update($dati_utente);
        $dati_utente=$Futente->load($username);
        if($dati_utente->galleria == "")
        {
            $this->_errore="foto eliminate";
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }else
        {
            $this->_errore="impossibile eliminare le foto";
            $view->impostaErrore($this->_errore);
            $this->_errore='';
        }
        return $this->VisualizzaGalleria();
    }

}
?>