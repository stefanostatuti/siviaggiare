<?php

class Vvalidazione extends View
{

        /**
        * @var $fields  Rappresenta l'arrray degli attributi dell'oggetto registrazione inizialmente impostati a null
        * @author Riccardo
        */
        private $fields =
        array ( "user" => null,
              "password" => null,
              "password_1" =>null,
              "nome" => null,
              "cognome" => null,
              "residenza" => null,
              "nazione" => null,
              "mail" => null
            );


        /**
        * @var $errors_msg  Rappresenta l'array dei messaggi d'errore
        * @author Riccardo
        */
        private $errors_msg =
        array (
              "user" => "Usare solo caratteri alfanumerici, numeri,.,-,_!",
              "nome" => "da 3 a 20 caratteri alfanumerici!",
              "password" => "da 8 a 16 caratteri!",
              "nazione" => "da 3 a 20 caratteri alfanumerici!",
              "residenza" => "da 3 a 20 caratteri alfanumerici!",
              "cognome" => "da 3 a 20 caratteri alfanumerici!",
              "mail" => "Email non valida es. pippo.pluto@dominio.it!" ,
              "password2"=> "le password non sono uguali!",
              "userdata"=>"utente gia usato!",
              "campo"=> "campo obbligatorio!"
            );


    /**
     * @var $retrivedFields  Variabile inizialmente impostata a false, verifica se un un attributo dell'oggetto registrazione è stato settato
     * @author Riccardo
     */
    private $retrivedFields = false;//inizialmente i dati non sono caricati


    /**
     * @var $wrong_fields  Array che identifica se un campo dell'oggetto registrazione contiene errori
     * @author Riccardo
     */
    private $wrong_fields = array();


    /**
     * @var $messaggi  Array che restituisce al template i campi con i relativi messaggi di errore
     * @author Riccardo
     */
    private $messaggi = array();
    
    
    // ------------------------------- public methods


    /**
     * assegna agli attributi il valore passatogli da template
     * @author Riccardo
     * @return boolean
     */
    public function retriveFields($dati) 
    {  
       if (!$this->retrivedFields) 
       {
       		//carico dati  
         $this->fields['user']=$dati['username'];
         $this->fields['password']=$dati['password'];
         $this->fields['password_1']=$dati['password_1'];
         $this->fields['nome']=$dati['nome'];
         $this->fields['cognome']=$dati['cognome'];
         $this->fields['residenza']=$dati['residenza'];
         $this->fields['nazione']=$dati['nazione'];
         $this->fields['mail']=$dati['mail'];
         
       }
       		$this->retrivedFields = true;
    }


    /**
     * restituisce l'array che identifica se un campo dell'oggetto registrazione contiene errori, se non ci sono errori,altrimenti ritorna false
     * @author Riccardo
     * @return mixed
     */
     public function validacampi($input) 
    {
       $this->retriveFields($input);
       $this->validauser();
       $this->validanome();
       $this->validacognome();
       $this->validapassword();
       $this->validaresidenza();
       $this->validanazione();
       $this->validamail();
       $this->valpass($input);//verifica che le password immesse siano uguali
       $this->valuser($input);//verifica che non ci sia un user uguale in database
       
       if ( in_array("true", $this->wrong_fields ) )
          return false; // esiste almeno un campo di input errato
       else
          return $this->fields;
    }


    /**
     * restituisce array messagi di errore se ci sono errori altrimenti false
     * @author Riccardo
     * @return mixed
     */
    public function getErrors() 
    {
       if ( in_array("true", $this->wrong_fields ) )
       {  
          return $this->messaggi;
       }else
          return false; 
    }


    /**
     * restituisce i dati usati per la validazione al template
     * @author Riccardo
     * @return array
     */
    public function getdatipersonali()
    {
         $arraydata['user']=$this->fields['user'];
         $arraydata['password']=$this->fields['password'];
         $arraydata['password_1']=$this->fields['password_1'];
         $arraydata['nome']=$this->fields['nome'];
         $arraydata['cognome']=$this->fields['cognome'];
         $arraydata['residenza']=$this->fields['residenza'];
         $arraydata['nazione']=$this->fields['nazione'];
         $arraydata['mail']=$this->fields['mail']; 
         return $arraydata;
     }


// -------------------------------------------- private functions



    /**
     * se l'user è settato verifica se quest'ultimo è di tipo user, se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validauser()
   {   
     if($this->fields['user'] != null)
     {  
        $pattern = '/^[a-zA-Z0-9]{3,15}$/';
        if ( !preg_match( $pattern, $this->fields['user'] ) )
        {
            $this->wrong_fields['user'] = "true";
            $this->messaggi['user']= $this->errors_msg['user'];
            
        }   
        else
        {
            $this->wrong_fields['user'] = "false";
        }  
     }else
     {     
            $this->wrong_fields['campouser'] = "true";
            $this->messaggi['campouser']= $this->errors_msg['campo'];
     }
   }


    /**
     * se il nome è settato verifica se quest'ultimo è un alfanumerico , se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
    private function validanome()
   {
     if($this->fields['nome'] != null)
     { 
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['nome'] ) )
        {
            $this->wrong_fields['nome'] = "true";
            $this->messaggi['nome']= $this->errors_msg['nome'];
        }
        else
        {
            $this->wrong_fields['nome'] = "false";
        }
      }else
      {
            $this->wrong_fields['camponome'] = "true";
            $this->messaggi['camponome']= $this->errors_msg['campo'];         
      }
   }


    /**
     * se il cognome è settato verifica se quest'ultimo è un alfanumerico, se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
    private function validacognome()
   {
     if($this->fields['cognome'] != null)
     { 
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['cognome'] ) )
        {
            $this->wrong_fields['cognome'] = "true";
            $this->messaggi['cognome']= $this->errors_msg['cognome'];
        }
        else
        {
            $this->wrong_fields['cognome'] = "false";
        }
     }else
     {
            $this->wrong_fields['campocognome'] = "true";
            $this->messaggi['campocognome']= $this->errors_msg['campo'];
     }
   }


    /**
     * se la citta è settata verifica se quest'ultima è un alfanumerico, se non è settata rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validaresidenza()
   {
     if($this->fields['residenza'] != null)
     { 
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['residenza'] )) 
        {    
             $this->wrong_fields['residenza'] = "true";
             $this->messaggi['residenza']= $this->errors_msg['residenza'];
         }   
        else 
        { 
             $this->wrong_fields['residenza'] = "false";
         }
      }else
      {
             $this->wrong_fields['camporesidenza'] = "true";
             $this->messaggi['camporesidenza']= $this->errors_msg['campo'];
      }
   }


    /**
     * se la nazione è settata verifica se quest'ultima è un alfanumerico, se non è settata rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validanazione()
   {
     if($this->fields['nazione'] != null)
     {
   
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['nazione'] ))
        {
            $this->wrong_fields['nazione'] = "true";
            $this->messaggi['nazione']= $this->errors_msg['nazione'];
        }
        
        else
        { 
             $this->wrong_fields['nazione'] = "false"; 
        }
      }else
      {
             $this->wrong_fields['camponazione'] = "true";
             $this->messaggi['camponazione']= $this->errors_msg['campo'];
      }
   }


    /**
     * se l'e-mail è settata verifica se quest'ultima è di tipo mail, se non è settata rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validamail()
   {
     if($this->fields['mail'] != null)
     {
        $pattern = '/^[_a-z0-9-]{2,15}+(\.[_a-z0-9-]{1,15}+)*@[a-z0-9-]{2,10}+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if ( !preg_match( $pattern, $this->fields['mail'] ) )
        {
            $this->wrong_fields['mail'] = "true";
            $this->messaggi['mail']= $this->errors_msg['mail'];
        }    
        else
        {
            $this->wrong_fields['mail'] = "false";
        }
     }else
     {
            $this->wrong_fields['campomail'] = "true";
            $this->messaggi['campomail']= $this->errors_msg['campo'];
     }
   }


    /**
     * se la password è settata verifica se quest'ultima è un alfanumerico, se non è settata rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validapassword()
   {
     if($this->fields['password'] != null)
     {  
        $pattern = '/^\w{8,16}$/';
        if ( !preg_match( $pattern, $this->fields['password'] ) )
        {
            $this->wrong_fields['password'] = "true";
            $this->messaggi['password']= $this->errors_msg['password'];
        }
        else
        {
            $this->wrong_fields['password'] = "false";
        }
     }else
     {
            $this->wrong_fields['campopassword'] = "true";
            $this->messaggi['campopassword']= $this->errors_msg['campo'];
     }
   }


    /**
     * verifica se le due password coincidono
     * @author Riccardo
     * @return array
     */
   private function valpass($dato)
   {
         if($dato['password']!=$dato['password_1'])
         {
           $this->wrong_fields['password2'] = "true";
           $this->messaggi['password2']= $this->errors_msg['password2'];
          }
          else
          {
            $this->wrong_fields['password2'] = "false";
          }  
   }


    /**
     * verifica se un user è gia usato in db
     * @author Riccardo
     * @return array
     */
   private function valuser($dato)
   {  
      if($dato['confronto']==true)
         {
           $this->wrong_fields['userdata'] = "true";
           $this->messaggi['userdata']= $this->errors_msg['userdata'];
          }
          else
          {
            $this->wrong_fields['userdata'] = "false";
          }  
   }  

}
?>