<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 14/08/13
 * Time: 10.13
 * To change this template use File | Settings | File Templates.
 */

class EAdmin extends EUtente
{
    public $stato='admin';
    public $_elenco_segnalazioni = array();

    //promuove un utente prendolo come imput e modifica lo stato
    public function PromuoviUtente(EUtente $utente) {
    $newAdmin = clone ($utente); //copia $utente in newAdmin
    var_dump($newAdmin);
    debug("qui lo Aggiorno");
    $newAdmin->stato='admin'; //modifico lo stato di newAdmin
    $FAdmin = new FAdmin();
    $FAdmin->update($newAdmin);
    debug("Aggiornato da EAdmin!");
    debug("utente promosso, ora è amministratore");
    return 0;
}//ok

    //Toglie permessi ad un utente prendolo come imput e modifica lo stato
    // per poi risalvarlo
    public function TogliPermessiAmministratore(EAdmin $admin) {
        $newUser = clone ($admin); //copia $utente in newAdmin
        var_dump($newUser);
        debug("qui lo Aggiorno");
        $newUser->stato='attivo'; //modifico lo stato di newUser
        $FUtente = new FUtente();
        $FUtente->update($newUser);
        debug("Aggiornato da EAdmin!");
        debug("Admin Degradato, ora è utente");
        return 0;
    } //ok

    public function getElencoSegnalazioni()
    {
        $FSegnalazioni=new FSegnalazione();
        $this->_elenco_segnalazioni=$FSegnalazioni->loadTUTTEleSegnalazioni();
        //debug("risultati ricevuti: ".count($this->_elenco_segnalazioni)); //ok
        //var_dump($this->_elenco_segnalazioni);
        return $this->_elenco_segnalazioni;
    }

    public function destroySegnalazione(ESegnalazione $segnalazione)
    {

        //$FDatabase = new FDatabase();  boh!
        //$FDatabase->delete($id);

        $arrayObject=get_object_vars($segnalazione);//splitta la segnalazione in array
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$arrayObject[$this->chiave].'\'';
        //unset($object);
        unset($segnalazione);
        return $this->query($query);
    }

    public function getAccountAmministratore()
    {
        if ($this->stato=='admin') //qui controllo se si è admin
        return true;
        else
            return false;
    }

}
?>