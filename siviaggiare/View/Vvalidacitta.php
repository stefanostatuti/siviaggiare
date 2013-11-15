<?php

class Vvalidacitta extends View
{

    /**
     * @var $fields  Rappresenta l'arrray degli attributi dell'oggetto citta inizialmente impostati a null
     * @author Riccardo
     */
      private $fields =
      array ( 
              "stato" => null,
              "datainizio" =>null,
              "datafine" => null,
              "citta" => null,
              "costoalloggio"=>null,
              "tipoalloggio"=>null,
              "valuta"=>null
            );



    /**
     * @var $errors_msg  Rappresenta l'array dei messaggi d'errore
     * @author Riccardo
     */
    private $errors_msg =
      array ( 
              "date" => "data inizio maggiore data fine?",
              "stato" =>" Usare solo dai 3 ai 20 caratteri alfanumerici!",
              "costoalloggio"=>"costoalloggio errato es. 12!",
              "costi"=>"costo alloggio maggiore del budget?",
              "campo" => "campo obbligatorio!",
              "dateviaggio" => "le date inserite non sono coerenti con quelle inserite in viaggio!",
              "citta" => "dato non valido es.Roma!"
            );


    /**
     * @var $retrivedFields  Variabile inizialmente impostata a false, verifica se un un attributo dell'oggetto citta è stato settato
     * @author Riccardo
     */
    private $retrivedFields = false;//inizialmente i dati non sono caricati


    /**
     * @var $wrong_fields  Array che identifica se un campo dell'oggetto citta contiene errori
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
         $this->fields['stato']=$dati['dati']['stato'];
         $this->fields['datainizio']=$dati['dati']['datainizio'];
         $this->fields['datafine']=$dati['dati']['datafine'];
         $this->fields['citta']=$dati['dati']['nome'];
         $this->fields['costoalloggio']=$dati['dati']['costoalloggio'];
         $this->fields['tipoalloggio']=$dati['dati']['tipoalloggio'];
       }
       		$this->retrivedFields = true;
    }


    /**
     * restituisce l'array che identifica se un campo dell'oggetto citta contiene errori, se non ci sono errori,altrimenti ritorna false
     * @author Riccardo
     * @return mixed
     */
     public function validacampi($input) 
    { 
       $this->retriveFields($input);
       $this->validastato();
       $this->validacostoalloggio();
       $this->validadatainizio();
       $this->validadatafine();
       $this->validadate();
       $this->validacitta();
       $this->validacosti($input);//verifica se budget è > costo_...
      
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
         $arraydata['stato']=$this->fields['stato'];
         $arraydata['datainizio']=$this->fields['datainizio'];
         $arraydata['datafine']=$this->fields['datafine'];
         $arraydata['costoalloggio']=$this->fields['costoalloggio'];
         $arraydata['tipoalloggio']=$this->fields['tipoalloggio'];
         $arraydata['citta']=$this->fields['citta'];
         $arraydata['valuta']=$this->fields['valuta'];
         return $arraydata;
     }
    

// -------------------------------------------- private functions



    /**
     * verifica se la data d'inizio del soggiorno in citta è settata , se non è settato rilascia errore
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
     * verifica se la data di fine del soggiorno in citta è settata , se non è settato rilascia errore
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
     * verifica se la data d'inizio del soggiorno in citta sia minore della data di fine, altrimenti genera errore
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


    /**
     * se la nazione è settata verifica se quest'ultima è un alfanumerico, se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
    private function validastato()
   {
      if($this->fields['stato'] != null)
      {
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $this->fields['stato'] ) )
        {
            $this->wrong_fields['stato'] = "true";
            $this->messaggi['stato'] = $this->errors_msg['stato'];
        }
        else
        {
            $this->wrong_fields['stato'] = "false";
        }
       }else
       {
            $this->wrong_fields['campostato'] = "true";
            $this->messaggi['campostato'] = $this->errors_msg['campo'];
       } 
   }


    /**
     * se il campo è settato, verifica che il costo dell'alloggio sia inferiore al budget definito in viaggio
     * @author Riccardo
     * @return array
     */
    private function validacosti($a)
    {
       if($this->fields['costoalloggio'] != null)
       { 
         if($a['varie']->budget < $this->fields['costoalloggio'])
         {
             $this->wrong_fields['costo_budget'] = "true";
             $this->messaggi['costo_budget'] = $this->errors_msg['costi'];
         }else
         {
             $this->wrong_fields['costo_budget'] = "false";
         }
        }else
        {
             $this->wrong_fields['costo_budget'] = "false";
        } 
    }


    /**
     * se il costo dell alloggio è settato verifica se quest'ultimo è un intero di al più 6 cifre
     * @author Riccardo
     * @return array
     */
    private function validacostoalloggio()
    {
      if($this->fields['tipoalloggio'] != null )
      { 
        if($this->fields['costoalloggio'] != null)
        {
           $pattern = '/^[0-9]{1,6}$/';
           if ( !preg_match( $pattern, $this->fields['costoalloggio'] ))
           {
               $this->wrong_fields['costoalloggio'] = "true";
               $this->messaggi['costoalloggio'] = $this->errors_msg['costoalloggio'];
           }   
           else 
           {

               $this->wrong_fields['costoalloggio'] = "false";
           }
         }else
         {
              $this->wrong_fields['campocostoalloggio'] = "true";
              $this->messaggi['campocostoalloggio'] = $this->errors_msg['campo'];
         }  
        }else
        {
           $this->wrong_fields['costoalloggio'] = "false";
        } 
   }


    /**
     * se il nome della citta è settata verifica se quest'ultima è un alfanumerico, se non è settata rilascia errore
     * @author Riccardo
     * @return array
     */
    private function validacitta()
    {
         if ($this->fields['citta'] != null)
         {
            $pattern = '/^[a-zA-Z \']{3,50}$/';
            if ( !preg_match( $pattern, $this->fields['citta'] )) 
            {
                $this->wrong_fields['citta'] = "true";
                $this->messaggi['citta']= $this->errors_msg['citta'];
            }else
            { 
                $this->wrong_fields['citta'] = "false"; 
            }
            
         }else
         {
             $this->wrong_fields['campocitta'] = "true";
             $this->messaggi['campocitta']= $this->errors_msg['campo'];
         }    
        
    }
   
}
?>