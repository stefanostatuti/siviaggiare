<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 22/08/13
 * Time: 11.46
 * To change this template use File | Settings | File Templates.
 */

class UValidate {

    private $campi = array ('cognome','nome','provincia','citta');
    private $validati = array ('cognome','nome','provincia','citta');
    private $err = array('cognome'=>null,'nome'=>null,'provincia'=>null,'citta'=>null);
    private $error_message =
        array ( 'cognome' => 'da 3 a 20 caratteri alfabetici',
            'nome' => "da 3 a 20 caratteri alfabetici",
            'provincia' => "2 caratteri alfabetici",
            'citta' => "da 2 a 30 caratteri alfabetici",
        );
$dati_richiesti=array('username','cognome','nome','residenza','nazione','mail','password','password_1');
$dati=array();
foreach ($dati_richiesti as $dato) {
if (isset($_REQUEST[$dato]))
$dati[$dato]=$_REQUEST[$dato];
}
    function __construct($dati)
    {
        $dati_richiesti=array('username','cognome','nome','residenza','nazione','mail','password','password_1');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        /*print ($this->validati['cognome']);
        print "\n";
        print ($this->validati['nome']);
        print "\n";
        print ($this->validati['provincia']);
        print "\n";
        print ($this->validati['citta']);
        print "\n";*/
    }

    private function validateCognome()
    {
        $pattern = '/^[[:alpha:]]{3,30}$/';
        if ( preg_match( $pattern, $this->campi['cognome'] ) )
            $this->validati["cognome"] = "true";

        else
            $this->validati["cognome"] = "false";
    }

    private function validateNome()
    {
        $pattern = '/^[[:alpha:]]{3,30}$/';
        if ( preg_match( $pattern, $this->campi['nome'] ) )
            $this->validati["nome"] = "true";
        else
            $this->validati["nome"] = "false";
    }

    private function validateProvincia()
    {
        $pattern = '/^[[:alpha:]]{2,2}$/';
        if ( preg_match( $pattern, $this->campi['provincia'] ) )
            $this->validati["provincia"] = "true";
        else
            $this->validati["provincia"] = "false";
    }

    private function validatecitta()
    {
        $pattern = '/^[[:alpha:]]{2,30}$/';
        if ( preg_match( $pattern, $this->campi['citta'] ) )
            $this->validati["citta"] = "true";
        else
            $this->validati["citta"] = "false";
    }
    public function check_campi(){
        if ( in_array("false", $this->validati ) )
            return false; // esiste almeno un campo di input errato
        else
            return true;
    }

    public function get_validati(){
        return $this->validati;
    }

    public function get_messaggi(){

        //if($this->validati['cognome'] =="false")
        $this->err['cognome'] = $this->error_message['cognome'];

        //if($this->validati['nome'] =="false")
        $this->err['nome'] = $this->error_message['nome'];

        //if($this->validati['provincia'] =="false")
        $this->err['provincia'] = $this->error_message['provincia'];

        //if($this->validati['citta'] =="false")
        $this->err['citta'] = $this->error_message['citta'];

        //print_r($this->err);
        return $this->err;
    }

}


?>