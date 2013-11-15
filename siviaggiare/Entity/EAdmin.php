<?php

class EAdmin extends EUtente
{
    public $stato='admin';
    public $_elenco_segnalazioni = array();

    /**
     * Permette ad un utente amministratore di promuovere un utente cambiandogli lo "stato"
     *
     * @param EUtente
     * @return bolean
     */
    public function PromuoviUtente(EUtente $utente)
    {
    $newAdmin = clone ($utente);
    $newAdmin->stato='admin';
    $FAdmin = new FAdmin();
    $FAdmin->update($newAdmin);
    return 0;
    }

    /**
     * Permette ad un utente amministratore di togliere permessi da amministratore ad un utente cambiandogli lo "stato"
     *
     * @param EAdmin
     * @return bolean
     */
    public function TogliPermessiAmministratore(EAdmin $admin)
    {
        $newUser = clone ($admin);
        $newUser->stato='attivo';
        $FUtente = new FUtente();
        $FUtente->update($newUser);
        return 0;
    }

    /**
     * Permette ad un utente amministratore di ottenere tutte le segnalazioni ricevute
     *
     * @return string
     */
    public function getElencoSegnalazioni()
    {
        $FSegnalazioni=new FSegnalazione();
        $this->_elenco_segnalazioni=$FSegnalazioni->loadTUTTEleSegnalazioni();
        return $this->_elenco_segnalazioni;
    }

    /**
     * Permette ad un utente amministratore di cancellare una segnalazione
     *
     * @param ESegnalazione
     * @return bolean
     */
    public function destroySegnalazione(ESegnalazione $segnalazione)
    {
        $arrayObject=get_object_vars($segnalazione);
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$arrayObject[$this->chiave].'\'';
        unset($segnalazione);
        return $this->query($query);
    }

    /**
     * Metodo verifica se è un amministratore
     *
     * @return bolean
     */
    public function getAccountAmministratore()
    {
        if ($this->stato=='admin')
        return true;
        else
            return false;
    }

}
?>