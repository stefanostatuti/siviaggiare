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
              "datainizio" => "data non valida!",
              "datafine" => "data non valida!",
              "date" => "data inizio maggiore data fine?", 
              "costotrasporto" => "dato non valido  es. 12 euro! ",
              "budget" => "dato non valido es.12 euro! ",
              "costo_budget" => "budget minore del costo trasporto? ",
              "campo" => "campo obbligatorio! "
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
       $this->validadate();
       $this->validacosto();
       $this->validabudget();
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
         $arraydata['valutatrasporto']=$this->fields['valutatrasporto'];
         $arraydata['valutabudget']=$this->fields['valutabudget'];
         return $arraydata;
     }

    
// -------------------------------------------- private functions


   
   private function validacosto()
   { 
      if ($this->fields['costotrasporto'] != null)
      {
        $pattern = '/^[0-9]{1,6}$/';
        if ( !preg_match( $pattern, $this->fields['costotrasporto'] ))
        {    
             $this->wrong_fields['costotrasporto'] = "true";
             $this->messaggi['costotrasporto']= $this->errors_msg['costotrasporto'];
             
         }   
        else 
        { 
             $this->wrong_fields['costotrasporto'] = "false";
        }
      }else
      {
            
             $this->wrong_fields['campocostotras'] = "true";
             $this->messaggi['campocostotras']= $this->errors_msg['campo'];
      }      
      
   }
   
   
   private function validabudget()
   {  
      if ($this->fields['budget'] != null)
      {
        $pattern = '/^[0-9]{1,6}$/';
        if ( !preg_match( $pattern, $this->fields['budget'] )) 
        {
            $this->wrong_fields['budget'] = "true";
            $this->messaggi['budget']= $this->errors_msg['budget'];
        }
        
        else
        { 
             $this->wrong_fields['budget'] = "false"; 
        }
      }else
      {
             $this->wrong_fields['campobudget'] = "true";
             $this->messaggi['campobudget']= $this->errors_msg['campo'];
      }  
      
    }
   
    
    private function validacosti()
    {    
         if($this->fields['budget'] < $this->fields['costotrasporto'])
         {
             $this->wrong_fields['costo_budget'] = "true";
             $this->messaggi['costo_budget']= $this->errors_msg['costo_budget'];
         }else
         {
             $this->wrong_fields['costo_budget'] = "false";
         }
    }
    
    
    private function validadatainizio()
    {
      if ($this->fields['datainizio'] != null)
      {  
      }else
      {
           $this->wrong_fields['campodatainizio'] = "true";
           $this->messaggi['campodatainizio']= $this->errors_msg['campo'];
      } 
    }
    
    
    private function validadatafine()
    {
      if ($this->fields['datafine'] != null)
      {  
      }else
      {
             $this->wrong_fields['campodatafine'] = "true";
             $this->messaggi['campodatafine']= $this->errors_msg['campo'];
      } 
    }
    
    
    private function validadate()
    {
            $datain=list( $monthi , $dayi, $yeari ) = explode('/',$this->fields['datainizio']);
            $datafin=list( $monthf , $dayf, $yearf ) = explode('/',$this->fields['datafine']);
            $datain[0]=intval($datain[0]);
            $datain[1]=intval($datain[1]);
            $datafin[0]=intval($datafin[0]);
            $datafin[1]=intval($datafin[1]);
            if($datain[0] <= $datafin[0] || $datain[1] <= $datafin[1] || $datain[2]<= $datafin[2])
            {
                   $this->wrong_fields['date'] = "false";                    
            }else
            {  
                   $this->wrong_fields['date'] = "true";
                   $this->messaggi['date']= $this->errors_msg['date'];
            }       
    }   
}
?>