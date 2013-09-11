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
              "citta" => null,
              "sito" =>null,
              "costobiglietto" => null,
              "guidaturistica" => null,
              "duratavisita"=>null,
              "input"=>null
            );

  // messaggi in caso di eventuali errori di input
    private $errors_msg =
      array ( 
              "nome" =>"nome non valido",
              "citta" =>"citt&agrave; non valida",
              "sito" =>"sito web non valido - es. www.dominio.it",
              "costobiglietto" =>"es. xxx,xx",
              "guidaturistica" =>"dato non valido",
              "duratavisita"=>"in minuti",
              "biglietto_budget"=>"costo biglietto maggiore costo budget???"
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
         $this->fields['nome']=$dati['nome'];
         $this->fields['citta']=$dati['nomecitta'];
         $this->fields['sito']=$dati['sitoweb'];
         $this->fields['costobiglietto']=$dati['costobiglietto'];
         $this->fields['guidaturistica']=$dati['guida'];
         $this->fields['duratavisita']=$dati['durata'];
         $this->fields['input']=$dati['input'];
         
       }
       		$this->retrivedFields = true;
    } 
            
     
     public function validacampi($input) 
    {
       $this->retriveFields($input);
       $this->validanome();
       $this->validacitta();
       $this->validasito();
       $this->validacostobiglietto();
       $this->validaguidaturistica();
       $this->validadurata();
       $this->validabudget();
      
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
         $arraydata['nome']=$this->fields['nome'];
         $arraydata['citta']=$this->fields['citta'];
         $arraydata['sito']=$this->fields['sito'];
         $arraydata['costobiglietto']=$this->fields['costobiglietto'];
         $arraydata['guidaturistica']=$this->fields['guidaturistica'];
         $arraydata['duratavisita']=$this->fields['duratavisita'];
         return $arraydata;
     }
    
    
// -------------------------------------------- private functions



   private function validanome()
   {
        $pattern = '/^[[:alpha:] ]{3,30}$/';
        if ( !preg_match( $pattern, $this->fields['nome'] ) )
        {
            $this->wrong_fields['nome'] = "true";
            $this->messaggi['nome']= $this->errors_msg['nome'];
         }   
        else
        {
            $this->wrong_fields['nome'] = "false";
        }   
   }
    
    
    private function validacitta()
   {
        $pattern = '/^[[:alpha:] ]{3,30}$/';
        if ( !preg_match( $pattern, $this->fields['citta'] ) )
        {
            $this->wrong_fields['citta'] = "true";
            $this->messaggi['citta']= $this->errors_msg['citta'];
        }
        else
        {
            $this->wrong_fields['citta'] = "false";
        }
   }
    
   
   private function validasito()
   {
     if($this->fields['sito']!=null)
     {
        $pattern = '/^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}?$/';
        if ( !preg_match( $pattern, $this->fields['sito'] ))
        {    
             $this->wrong_fields['sito'] = "true";
             $this->messaggi['sito']= $this->errors_msg['sito'];
         }   
        else 
        { 
             $this->wrong_fields['sito'] = "false";
        } 
      }
   }
   
   
   private function validacostobiglietto()
   {
     if($this->fields['costobiglietto']!=null)
     {
        $pattern = '/^[0-9]{1,6},[0-9]{0,2}$/';
        if ( !preg_match( $pattern, $this->fields['costobiglietto'] )) 
        {
            $this->wrong_fields['costobiglietto'] = "true";
            $this->messaggi['costobiglietto']= $this->errors_msg['costobiglietto'];
        }
        
        else
        { 
             $this->wrong_fields['costobiglietto'] = "false"; 
        }
      }
    }
    
    
    private function validaguidaturistica()
   {
      if($this->fields['guidaturistica']!=null)
      {
        $pattern = '/^[[:alpha:] ]{2,50}$/';
        if ( !preg_match( $pattern, $this->fields['guidaturistica'] )) 
        {
            $this->wrong_fields['guidaturistica'] = "true";
            $this->messaggi['guidaturistica']= $this->errors_msg['guidaturistica'];
        }
        
        else
        { 
             $this->wrong_fields['guidaturistica'] = "false"; 
        }
       } 
    }
    
    
    private function validadurata()
   {
      if($this->fields['duratavisita']!=null)
      {
        $pattern = '/^[0-9]{1,3}$/';
        if ( !preg_match( $pattern, $this->fields['duratavisita'] )) 
        {
            $this->wrong_fields['duratavisita'] = "true";
            $this->messaggi['duratavisita']= $this->errors_msg['duratavisita'];
        }
        
        else
        { 
             $this->wrong_fields['duratavisita'] = "false"; 
        }
      } 
    }
    
    
    private function validabudget()
   {
      if($this->fields['costobiglietto']!=null)
      {   //var_dump($this->fields['input']);
        if ( $this->fields['input']< $this->fields['costobiglietto'] ) 
        {
            $this->wrong_fields['budget'] = "true";
            $this->messaggi['budget']= $this->errors_msg['budget'];
        }
        
        else
        { 
             $this->wrong_fields['budget'] = "false"; 
        }
      }  
    }
   
   
}
?>