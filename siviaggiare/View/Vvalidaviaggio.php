<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.59
 * To change this template use File | Settings | File Templates.
 */

class Vvalidaviaggio extends View
{

      private $fields =
      array ( "datainizio" => null,
              "datafine" => null,
              "mezzotrasporto" =>null,
              "costotrasporto" => null,
              "budget" => null,
              "utenteusername" => null
            );

  // messaggi in caso di eventuali errori di input
    private $errors_msg =
      array ( 
              "datainizio" => "gg/mm/aaaa",
              "datafine" => "gg/mm/aaaa",
              "date"=> "data fine minore di data inizio!!!!!",
              "costotrasporto"=> "dato non valido  xxx,xx",
              "budget" => "dato non valido xxx,xx",
              "costo_budget"=>"budget minore del costo trasporto??"
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
         $this->fields['datainizio']=$dati['datainizio'];
         $this->fields['datafine']=$dati['datafine'];
         $this->fields['mezzotrasporto']=$dati['mezzotrasporto'];
         $this->fields['costotrasporto']=$dati['costotrasporto'];
         $this->fields['budget']=$dati['budget'];
         $this->fields['utenteusername']=$dati['utenteusername'];
         
       }
       		$this->retrivedFields = true;
    } 
            
     
     public function validacampi($input) 
    {
       $this->retriveFields($input);
       $this->validadatainizio();
       $this->validadatafine();
       $this->validacosto();
       $this->validabudget();
       $this->validadata();
       $this->validacosti();
      
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
    
    
    public function getdatipersonali()
    {
         $arraydata['datainizio']=$this->fields['datainizio'];
         $arraydata['datafine']=$this->fields['datafine'];
         $arraydata['mezzotrasporto']=$this->fields['mezzotrasporto'];
         $arraydata['costotrasporto']=$this->fields['costotrasporto'];
         $arraydata['budget']=$this->fields['budget'];
         return $arraydata;
     }

    
// -------------------------------------------- private functions


    
   private function validadatainizio()//da finire
   {
        $pattern = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        if ( !preg_match( $pattern, $this->fields['datainizio'] ) )
        {
            $this->wrong_fields['datainizio'] = "true";
            $this->messaggi['datainizio']= $this->errors_msg['datainizio'];
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
            $this->messaggi['datadine']= $this->errors_msg['datafine'];
        }
        else
        {
            $this->wrong_fields['datafine'] = "false";
        }
   }
    
   
   private function validacosto()
   {
     
        $pattern = '/^[0-9]{1,6},[0-9]{0,2}$/';
        if ( !preg_match( $pattern, $this->fields['costotrasporto'] )) //or ($val==NULL) )
        {    
             $this->wrong_fields['costotrasporto'] = "true";
             $this->messaggi['datafine']= $this->errors_msg['datafine'];
         }   
        else 
        { 
             $this->wrong_fields['costotrasporto'] = "false";
        }    
   }
   
   
   private function validabudget()
   {
   
        $pattern = '/^[0-9]{1,6},[0-9]{0,2}$/';
        if ( !preg_match( $pattern, $this->fields['budget'] )) 
        {
            $this->wrong_fields['budget'] = "true";
            $this->messaggi['budget']= $this->errors_msg['budget'];
        }
        
        else
        { 
             $this->wrong_fields['budget'] = "false"; 
        }
    }
   
    
    private function validadata()
    {
         if($this->fields['datainizio']<$this->fields['datafine'])
         {
             $this->wrong_fields['date'] = "false";
         }else
         {
              $this->wrong_fields['date'] = "true";
              $this->messaggi['date']= $this->errors_msg['date'];
         }
    }
    
    private function validacosti()
    {
         if($this->fields['budget']<$this->fields['costotrasporto'])
         {
             $this->wrong_fields['costo_budget'] = "true";
             $this->messaggi['costo_budget']= $this->errors_msg['costo_budget'];
         }else
         {
             $this->wrong_fields['costo_budget'] = "false";
         }
    }
    
      
}
?>