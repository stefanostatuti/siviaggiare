<?php

class ELuogo
{
    public $idviaggio;
    public $nome;
    public $nomecitta;
    public $sitoweb;
    public $percorso;
    public $costobiglietto;
    public $valuta;
    public $guida;
    public $coda;
    public $durata;
    public $commentolibero;
    public $feedback;
    public $utentifeedback;
    public $immagini;
    public $_elenco_commenti = array();



    /**
     * Carica tutti i commenti associati al luogo nell'attributo $_elenco_commenti
     *
     * @return array
     */
    public function getElencoCommenti()
    {
        $FCommento=new FCommento();
        $key[0]='idviaggio';
        $value[0]=$this->idviaggio;
        $key[1]='nomecitta';
        $value[1]=mysql_real_escape_string($this->nomecitta);
        $key[2]='nomeluogo';
        $value[2]=mysql_real_escape_string($this->nome);
        $this->_elenco_commenti=$FCommento->loadRicerca($key,$value);
        return $this->_elenco_commenti;
    }


    /**
     * Verifica se un utente ha già rilasciato o meno un feedback per il luogo
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