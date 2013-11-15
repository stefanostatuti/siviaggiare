<?php

class Vvalidaviaggio extends View
{

    /**
     * @var $fields  Rappresenta l'arrray degli attributi dell'oggetto viaggio inizialmente impostati a null
     * @author Riccardo
     */
      private $fields =
      array ( "datainizio" => null,
              "datafine" => null,
              "mezzotrasporto" =>null,
              "costotrasporto" => null,
              "budget" => null,
              "utenteusername" => null
            );


    /**
     * @var $errors_msg  Rappresenta l'array dei messaggi d'errore
     * @author Riccardo
     */
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


    /**
     * @var $retrivedFields  Variabile inizialmente impostata a false, verifica se un un attributo dell'oggetto viaggio è stato settato
     * @author Riccardo
     */
    private $retrivedFields = false;//inizialmente i dati non sono caricati


    /**
     * @var $wrong_fields  Array che identifica se un campo dell'oggetto viaggio contiene errori
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
         $this->fields['datainizio']=$dati['datainizio'];
         $this->fields['datafine']=$dati['datafine'];
         $this->fields['mezzotrasporto']=$dati['mezzotrasporto'];
         $this->fields['costotrasporto']=$dati['costotrasporto'];
         $this->fields['budget']=$dati['budget'];
         $this->fields['utenteusername']=$dati['utenteusername'];
         
       }
       		$this->retrivedFields = true;
    }


    /**
     * restituisce l'array che identifica se un campo dell'oggetto viaggio contiene errori, se non ci sono errori,altrimenti ritorna false
     * @author Riccardo
     * @return mixed
     */
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
          
          }
       else
          return false; 
    }


    /**
     * restituisce i dati usati per la validazione al template
     * @author Riccardo
     * @return array
     */
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



    /**
     * se il costo del trasporto è settato verifica se quest'ultimo è un intero di al più 6 cifre, se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
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


    /**
     * se il budget è settato verifica se quest'ultimo è un intero di al più 6 cifre, se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
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


    /**
     * controlla che il budget sia maggiore del costo del trasporto
     * @author Riccardo
     * @return array
     */
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


    /**
     * verifica che il campo datainizio sia settato, non serve la validazione della data in quanto si prende da datapicker
     * @author Riccardo
     * @return array
     */
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


    /**
     * verifica che il campo datafine sia settato, non serve la validazione della data in quanto si prende da datapicker
     * @author Riccardo
     * @return array
     */
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


    /**
     * verfifica che la data di inizio del viaggio sia minore della data di fine
     * @author Riccardo
     * @return array
     */
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