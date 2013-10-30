<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.59
 * To change this template use File | Settings | File Templates.
 */

class Vvalidacitta extends View
{

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


  // messaggi in caso di eventuali errori di input
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
         $this->fields['stato']=$dati['dati']['stato'];
         $this->fields['datainizio']=$dati['dati']['datainizio'];
         $this->fields['datafine']=$dati['dati']['datafine'];
         $this->fields['citta']=$dati['dati']['nome'];
         $this->fields['costoalloggio']=$dati['dati']['costoalloggio'];
         $this->fields['tipoalloggio']=$dati['dati']['tipoalloggio'];
       }
       		$this->retrivedFields = true;
    } 
            
     
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
       //$this->validadateviaggio($input);
      
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
          
       }else
          return false; 
    }
    
    
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
    
    
    private function validadateviaggio($a)
    {    //manca validazione mesi perche troppo complicato
            $dataincitta=list( $month , $day, $year ) = explode('/',$this->fields['datainizio']);
            $datafincitta=list( $month , $day, $year ) = explode('/',$this->fields['datafine']);
            $datainviaggio=list( $month , $day, $year ) = explode('/',$a['varie']->datainizio);
            $datafinviaggio=list( $month , $day, $year ) = explode('/',$a['varie']->datafine);
            $dataincitta[1]=intval($dataincitta[1]);
            $datafincitta[1]=intval($datafincitta[1]);
            $datainviaggio[1]=intval($datainviaggio[1]);
            $datafinviaggio[1]=intval($datafinviaggio[1]);
            if($dataincitta[2] != $datainviaggio[2] || $datafincitta[2] != $datafinviaggio[2])
            {       
                   $this->wrong_fields['dateviaggio'] = "true";
                   $this->messaggi['dateviaggio']= $this->errors_msg['dateviaggio'];   
            }elseif($dataincitta[1] < $datainviaggio[1] || $datafincitta[1] > $datafinviaggio[1])
            {      
                   $this->wrong_fields['dateviaggio'] = "true";
                   $this->messaggi['dateviaggio']= $this->errors_msg['dateviaggio'];    
            }else
            {    
                   $this->wrong_fields['date'] = "false";      
            }
            
            
            
            
            $datain=list( $monthi , $dayi, $yeari ) = explode('/',$this->fields['datainizio']);
            $datafin=list( $monthf , $dayf, $yearf ) = explode('/',$this->fields['datafine']);
            if($datain[0] < $datafin[0] || $datain[1] < $datafin[1] || $datain[2]< $datafin[2])
            {
                   $this->wrong_fields['date'] = "false";                    
            }else
            {  
                   $this->wrong_fields['date'] = "true";
                   $this->messaggi['date']= $this->errors_msg['date'];
            }        
    }
   
    
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