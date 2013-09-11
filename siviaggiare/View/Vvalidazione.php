<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.59
 * To change this template use File | Settings | File Templates.
 */

class Vvalidazione extends View
{

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

  // messaggi in caso di eventuali errori di input
    private $errors_msg =
      array ( 
              "user" => "caratteri non validi",
              "nome" => "da 3 a 20 caratteri alfanumerici",
              "password" => "da 8 a 16 caratteri",
              "nazione" => "caratteri non valido",
              "residenza" => "caratteri non valido",
              "cognome" => "da 3 a 20 caratteri alfanumerici",
              "mail" => "formato email non valido - solo formati username@domain.it" ,
              "password2"=> "le password non sono uguali",
              "userdata"=>"utente gia usato"
            );
              
              
    private $retrivedFields = false;//inizialmente i dati non sono caricati
    
    // nomi dei campi che contengono errori di input
    private $wrong_fields = array();
    
    //restituisce array messaggi
    private $messaggi = array();
    
    
    // ------------------------------- public methods
    
    
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
          return $fields;
          
    }
    
    
    public function getErrors() 
    {
       if ( in_array("true", $this->wrong_fields ) )
       {
          return $this->messaggi;
          
          
          }
       else
          return false; 
    }
    
    
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


    

   private function validauser()
   {
     $pattern = '/^[[:alpha:]]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['user'] ) )
        {
            $this->wrong_fields['user'] = "true";
            $this->messaggi['user']= $this->errors_msg['user'];
            //var_dump($this->error_msg['user']);
            //var_dump('user non valido');
           // var_dump($this->fields['user']);
         }   
        else
        {
            $this->wrong_fields['user'] = "false";
            //var_dump('user valido');
         }   
   }
    
    
    private function validanome()
   {
   $pattern = '/^[[:alpha:] ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['nome'] ) )
        {
            $this->wrong_fields['nome'] = "true";
            $this->messaggi['nome']= $this->errors_msg['nome'];
            //var_dump('nome non valido');
        }
        else
        {
            $this->wrong_fields['nome'] = "false";
            //var_dump('nome  valido');
        }
   }
    
    
    private function validacognome()
   {
   $pattern = '/^[[:alpha:] ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['cognome'] ) )
        {
            $this->wrong_fields['cognome'] = "true";
            $this->messaggi['cognome']= $this->errors_msg['cognome'];
            //var_dump('cogn non valido');
        }
        else
        {
            $this->wrong_fields['cognome'] = "false";
            //var_dump('cogn  valido');
        }
   }
   
   
   private function validaresidenza()
   {
     
      $pattern = '/^[[:alpha:] ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['residenza'] )) //or ($val==NULL) )
        {    
             $this->wrong_fields['residenza'] = "true";
             $this->messaggi['residenza']= $this->errors_msg['residenza'];
             //var_dump('res non valido');
         }   
        else 
        { 
             $this->wrong_fields['residenza'] = "false";
             //var_dump('res  valido');
         }
   }
   
   
   private function validanazione()
   {
   
      $pattern = '/^[[:alpha:] ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['nazione'] )) //or ($val==NULL) )
        {
            $this->wrong_fields['nazione'] = "true";
            $this->messaggi['nazione']= $this->errors_msg['nazione'];
        }
        
        else
        { 
             $this->wrong_fields['nazione'] = "false"; 
             //var_dump('naz  valido');
        }
    }
   
   
   private function validamail()
   {
       // solo email del tipo pippo_23@pluto.it
        $pattern = '/^[_a-z0-9-]{2,10}+(\.[_a-z0-9-]{2,10}+)*@[a-z0-9-]{2,10}+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if ( !preg_match( $pattern, $this->fields['mail'] ) )
        {
            $this->wrong_fields['mail'] = "true";
            $this->messaggi['mail']= $this->errors_msg['mail'];
            //var_dump('mail non valido');
        }
        else
        {
            $this->wrong_fields['mail'] = "false";
            //var_dump('mail  valido');
        }
   }
   
   
   private function validapassword()
   {
    $pattern = '/^\w{8,16}$/';
        if ( !preg_match( $pattern, $this->fields['password'] ) )
        {
            $this->wrong_fields['password'] = "true";
            $this->messaggi['password']= $this->errors_msg['password'];
            //var_dump('psw non valido');
        }
        else
        {
            $this->wrong_fields['password'] = "false";
            //var_dump('psw  valido');
        }
   }
   
    
   private function valpass($dato)
   {
         if($dato['password']!=$dato['password_1'])
         {
           $this->wrong_fields['password2'] = "true";
           $this->messaggi['password2']= $this->errors_msg['password2'];
            //var_dump('le psw non valide');
          }
          else
          {
            $this->wrong_fields['password2'] = "false";
            //var_dump('pss   valido');
          }  
   }
   
   
   private function valuser($dato)
   {
      if($dato['confronto']==true)
         {
           $this->wrong_fields['userdata'] = "true";
           $this->messaggi['userdata']= $this->errors_msg['userdata'];
            //var_dump('user gia usato ');
          }
          else
          {
            $this->wrong_fields['userdata'] = "false";
            //var_dump('user  valido');
          }  
   } 
   

}
?>