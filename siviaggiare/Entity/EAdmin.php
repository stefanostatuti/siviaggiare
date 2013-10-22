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
    //creo una nuova variabile newAdmin
    //$newAdmin = new FAdmin ();
    $newAdmin = clone ($utente); //copia $utente in newAdmin
    var_dump($newAdmin);
    debug("qui lo devo distruggere");
    $destroy = new FDatabase();
    $destroy->delete($utente);
    debug("eliminato!");
    $newAdmin->stato="admin"; //modifico lo stato di newAdmin
    debug("utente promosso, ora è amministratore");
    $destroy->store($newAdmin); //mi risalvo nel DB lo stato del nuovo oggetto
    return 0;
}

    //Toglie permessi ad un utente prendolo come imput e modifica lo stato
    // per poi risalvarlo
    public function TogliPermessiAmministratore(EAdmin $admin) {
        //creo una nuova variabile newUser
        //$newUser = new FUtente();
        $newUser = clone ($admin); //copia $utente in newAdmin
        var_dump($newUser);
        debug("qui lo devo distruggere");
        $destroy = new FDatabase();
        $destroy->delete($admin);
        debug("eliminato!");
        $newUser->stato = "attivato"; //modifico lo stato di newUser
        debug("Permessi tolti, ora è un utente");
        $destroy->store($newUser); //mi risalvo nel DB lo stato del nuovo oggetto
        return 0;
    }

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