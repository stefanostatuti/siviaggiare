<?php

class ECitta 
{

    public $idviaggio;
    public $nome;
    public $stato;
    public $datainizio;
    public $datafine;
    public $tipoalloggio;
    public $costoalloggio;
    public $valuta;
    public $voto;
    public $feedback;
    public $utentifeedback;
    public $_elenco_luoghi = array();


    /**
     * Carica tutti i luoghi associati alla città nell'attributo $_elenco_luoghi
     *
     * @return array
     */
    public function getElencoLuoghi() 
    {
        $FLuogo=new FLuogo();
        $key[0]='idviaggio';
        $value[0]=$this->idviaggio;
        $key[1]='nomecitta';
        $value[1]=mysql_real_escape_string($this->nome);
        $this->_elenco_luoghi=$FLuogo->loadRicerca($key,$value);
        return $this->_elenco_luoghi;
    }


    /**
     * Verifica se un utente ha già rilasciato o meno un feedback per la città
     *
     * @param $user username dell'utente da verificare
     * @return bool
     */
    public function verificaFeedbackUtente($user)
    {
        $lista_utenti= rtrim($this->utentifeedback);
        $lista_utenti= explode(" ", $lista_utenti);
        $rilasciato=false;
        foreach ($lista_utenti as $utente)
        {
            if ($user==$utente)
                $rilasciato=true;
        }
        return $rilasciato;
    }

}
?>