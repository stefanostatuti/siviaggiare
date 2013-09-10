<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.59
 * To change this template use File | Settings | File Templates.
 */

class Vvalidaluogo extends View
{

      private $fields =
      array ( "nome" => null,
              "stato" => null,
              "datainizio" =>null,
              "datafine" => null,
              "costoalloggio"=>null
            );

  // messaggi in caso di eventuali errori di input
    private $errors_msg =
      array ( 
              "nome" =>"nome non valido",
              "stato" =>" stato non valido",
              "datainizio" =>"data non valida",
              "datafine" =>"data non valida",
              "date"=>"datafine minore data inizio????",
              "costoalloggio"=>"costoalloggio errato es. 12,3",
              "costi"=>"costo alloggio maggiore del budget????"
            );
              
           
    private $retrivedFields = false;//inizialmente i dati non sono caricati
    
    // nomi dei campi che contengono errori di input
    private $wrong_fields = array();


    private $messaggi = array();
    
    
    // ------------------------------- public methods
    
    
    public function retriveFields($dati) 
    {  
       if (!$this->retrivedFields) 
       {
       		//carico dati  
         $this->fields['nome']=$dati['nome'];
         $this->fields['stato']=$dati['stato'];
         $this->fields['datainizio']=$dati['datainizio'];
         $this->fields['datafine']=$dati['datafine'];
         $this->fields['costoalloggio']=$dati['costoalloggio'];
         
       }
       		$this->retrivedFields = true;
    } 
            
     
     public function validacampi($input) 
    {
       $this->retriveFields($input);
       $this->validanome();
       $this->validastato();
       $this->validadatainizio();
       $this->validadatafine();
       $this->validadate();
       $this->validacostoalloggio();
       $this->validacosti();//verifica se budget è > costo_... 
      
       if ( in_array("true", $this->wrong_fields ) )
          return false; // esiste almeno un campo di input errato
       else
          return $this->fields;
          
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
    
    
    public function show_again()  //da verificare
    {   
        $this->setDataIntoTemplate( "luogo", $this->getdatipersonali() );
        $this->setDataIntoTemplate( "wrong_fields", $this->wrong_fields );
        $this->setDataIntoTemplate( "errors_msg", $this->errors_msg );
        $this->showTemplate();//affiche parta il template deve partire qui non fuori
    }
    
    
    public function getdatipersonali()
    {
         $arraydata['nome']=$this->fields['nome'];
         $arraydata['stato']=$this->fields['stato'];
         $arraydata['datainizio']=$this->fields['datainizio'];
         $arraydata['datafine']=$this->fields['datafine'];
         $arraydata['costoalloggio']=$this->fields['costoalloggio'];
         return $arraydata;
     }
    
      public function setDataIntoTemplate($key,$valore) //davedere
    {  
        $this->assign($key,$valore);  
    }   
    
    
    public function showTemplate() //davedere
    {
         $this->display('davedere.tpl'); 
    }
    
// -------------------------------------------- private functions



   private function validanome()
   {
        $pattern = '/^[[:alpha:]]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['nome'] ) )
        {
            $this->wrong_fields['nome'] = "true";
            $this->messaggi['nome'] = $this->errors_msg['nome'];
         }   
        else
        {
            $this->wrong_fields['nome'] = "false";
        }   
   }
    
    
    private function validastato()
   {
        $pattern = '/^[[:alpha:]]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['stato'] ) )
        {
            $this->wrong_fields['stato'] = "true";
            $this->messaggi['stato'] = $this->errors_msg['stato'];
        }
        else
        {
            $this->wrong_fields['stato'] = "false";
        }
   }
   
    
   private function validadatainizio()//da finire
   {
        $pattern = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        if ( !preg_match( $pattern, $this->fields['datainizio'] ) )
        {
            $this->wrong_fields['datainizio'] = "true";
            $this->messaggi['datainizio'] = $this->errors_msg['datainizio'];
         }   
        else
        {
            $this->wrong_fields['datainizio'] = "false";
        }   
   }
    
    
    private function validadatafine()//da finire
   {
        $pattern = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        if ( !preg_match( $pattern, $this->fields['datafine'] ) )
        {
            $this->wrong_fields['datafine'] = "true";
            $this->messaggi['datafine'] = $this->errors_msg['datafine'];
        }
        else
        {
            $this->wrong_fields['datafine'] = "false";
        }
   }
    
    
    private function validadate()
    {
         if($this->fields['datainizio']<$this->fields['datafine'])
         {
             $this->wrong_fields['date'] = "false";
         }else
         {
              $this->wrong_fields['date'] = "true";
             $this->messaggi['date'] = $this->errors_msg['date'];
         }
    }
    
    private function validacosti()
    {
         if($this->fields['budget']<$this->fields['costoalloggio'])
         {
             $this->wrong_fields['costo_budget'] = "true";
             $this->messaggi['costo_budget'] = $this->errors_msg['costo_budget'];
         }else
         {
             $this->wrong_fields['costo_budget'] = "false";
         }
    }
    
    private function validacostoalloggio()
   {
      $pattern = '/^[0-9]{1,6},[0-9]{0,2}$/';
        if ( !preg_match( $pattern, $this->fields['costoalloggio'] ))
        {    
             $this->wrong_fields['costoalloggio'] = "true";
            $this->messaggi['costoalloggio'] = $this->errors_msg['costoalloggio'];
         }   
        else 
        { 
             $this->wrong_fields['costoalloggio'] = "false";
        }  
   }
   
   
}
?>