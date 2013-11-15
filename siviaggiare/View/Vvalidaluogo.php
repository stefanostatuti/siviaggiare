<?php

class Vvalidaluogo extends View
{

    /**
     * @var $fields  Rappresenta l'arrray degli attributi dell'oggetto luogo inizialmente impostati a null
     * @author Riccardo
     */
      private $fields =
      array ( "luogo" => null,
              "sitoweb" => null,
              "percorso" =>null,
              "costobiglietto" => null,
              "guidaturistica" => null,
              "duratavisita"=>null,
              "commento"=>null,
              "valuta"=>null
            );


    /**
     * @var $errors_msg  Rappresenta l'array dei messaggi d'errore
     * @author Riccardo
     */
    private $errors_msg =
      array ( 
              "luogo" =>"campo non valido, solo caratteri alfanumerici!",
              "sitoweb" =>"sito web non valido - es. www.dominio.it!",
              "costobiglietto" =>"dato non valido es.12 euro!",
              "guidaturistica" =>"campo non valido, solo caratteri alfanumerici!",
              "duratavisita"=>"in minuti!",
              "biglietto_budget"=>"costo biglietto maggiore costo budget???",
              "campo" => "Campo obbligatorio!"
            );


    /**
     * @var $retrivedFields  Variabile inizialmente impostata a false, verifica se un un attributo dell'oggetto luogo è stato settato
     * @author Riccardo
     */
    private $retrivedFields = false;//inizialmente i dati non sono caricati


    /**
     * @var $wrong_fields  Array che identifica se un campo dell'oggetto luogo contiene errori
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
         $this->fields['luogo']=$dati['nome'];
         $this->fields['sitoweb']=$dati['sitoweb'];
         $this->fields['percorso']=$dati['percorso'];
         $this->fields['costobiglietto']=$dati['costobiglietto'];
         $this->fields['guidaturistica']=$dati['guida'];
         $this->fields['duratavisita']=$dati['durata'];
         $this->fields['commento']=$dati['commentolibero'];
         $this->fields['valuta']=$dati['valuta'];
         
       }
       		$this->retrivedFields = true;
    }


    /**
     * restituisce l'array che identifica se un campo dell'oggetto luogo contiene errori, se non ci sono errori,altrimenti ritorna false
     * @author Riccardo
     * @return mixed
     */
     public function validacampi($input) 
    {  
       $this->retriveFields($input);
       $this->validaluogo();
       $this->validasito();
       $this->validacostobiglietto($input);
       $this->validaguidaturistica();
       $this->validacosti($input);
       $this->validadurata();
      
       if ( in_array("true", $this->wrong_fields ) )
          return false; 
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
         $arraydata['luogo']=$this->fields['luogo'];
         $arraydata['commento']=$this->fields['commento'];
         $arraydata['percorso']=$this->fields['percorso'];
         $arraydata['sitoweb']=$this->fields['sitoweb'];
         $arraydata['costobiglietto']=$this->fields['costobiglietto'];
         $arraydata['guidaturistica']=$this->fields['guidaturistica'];
         $arraydata['duratavisita']=$this->fields['duratavisita'];
         $arraydata['valuta']=$this->fields['valuta'];
         return $arraydata;
     }
    
    
// -------------------------------------------- private functions



    /**
     * se il nome del luogo è settato verifica se quest'ultimo è un alfanumerico , se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validaluogo()
   {  
     if($this->fields['luogo']!=null)
     {   
        $pattern = '/^[a-zA-Z \' ]{3,40}$/';
        if ( !preg_match( $pattern, $this->fields['luogo'] ) )
        {
            $this->wrong_fields['luogo'] = "true";
            $this->messaggi['luogo']= $this->errors_msg['luogo'];
         }   
        else
        {    
            $this->wrong_fields['luogo'] = "false";
        }
      }else
      {     
            $this->wrong_fields['campoluogo'] = "true";
            $this->messaggi['campoluogo']= $this->errors_msg['campo']; 
      }     
   }


    /**
     * se il nome del sito web è settato verifica se quest'ultimo è corretto, se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validasito()
   {
     if($this->fields['sitoweb']!=null)
     {   
        $pattern = '/^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}?$/';
        if ( !preg_match( $pattern, $this->fields['sitoweb'] ))
        {    
             $this->wrong_fields['sitoweb'] = "true";
             $this->messaggi['sitoweb']= $this->errors_msg['sitoweb'];
         }   
        else 
        { 
             $this->wrong_fields['sitoweb'] = "false";
        } 
      }else
      {
             $this->wrong_fields['sitoweb'] = "false";
      } 
   }


    /**
     * se il costo del biglietto è settato verifica se quest'ultimo è un intero di al più 4 cifre, se non è settato rilascia errore
     * @author Riccardo
     * @return array
     */
   private function validacostobiglietto($a)
   {
     if($this->fields['costobiglietto']!=null)
     {
        $pattern = '/^[0-9]{1,4}$/';
        if ( !preg_match( $pattern, $this->fields['costobiglietto'] )) 
        {
            $this->wrong_fields['costobiglietto'] = "true";
            $this->messaggi['costobiglietto']= $this->errors_msg['costobiglietto'];
        }
        else
        { 
             $this->wrong_fields['costobiglietto'] = "false"; 
        }
      }else
      {
             $this->wrong_fields['costobiglietto'] = "false";
      }   
    }


    /**
     * se il campo guida turistica è settata verifica se quest'ultima è alfanumerica, se non è settata rilascia errore
     * @author Riccardo
     * @return array
     */
    private function validaguidaturistica()
   {
      if($this->fields['guidaturistica']!=null)
      {
        $pattern = '/^[a-zA-Z \' ]{2,50}$/';
        if ( !preg_match( $pattern, $this->fields['guidaturistica'] )) 
        {
            $this->wrong_fields['guidaturistica'] = "true";
            $this->messaggi['guidaturistica']= $this->errors_msg['guidaturistica'];
        }
        
        else
        { 
             $this->wrong_fields['guidaturistica'] = "false"; 
        }
      }else
      {
             $this->wrong_fields['guidaturistica'] = "false";
      }   
    }


    /**
     * se la durata della visita è settata verifica se quest'ultima è un intero di al più 3 cifre, se non è settata rilascia errore
     * @author Riccardo
     * @return array
     */
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
      }else
      {
             $this->wrong_fields['duratavisita'] = "false";
      }
    }


    /**
     * se il costo del biglietto è maggiore del budget rilascia errore
     * @author Riccardo
     * @return array
     */
    private function validacosti($input)
    {
      if($input['costobiglietto'] !=null)
      { 
        if($input['budget'] < $input['costobiglietto'])
        {   
            $this->wrong_fields['biglietto_budget'] = "true";
            $this->messaggi['biglietto_budget']= $this->errors_msg['biglietto_budget'];
        }else
        {
            $this->wrong_fields['biglietto_budget'] = "false";
        }
      }else
      {
          $this->wrong_fields['biglietto_budget'] = "false";  
      }  
    }
    
}
?>