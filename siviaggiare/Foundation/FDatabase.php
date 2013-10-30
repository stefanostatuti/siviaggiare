<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 14/08/13
 * Time: 11.39
 * To change this template use File | Settings | File Templates.
 */            ///DA COMPLETARE

class FDatabase
{

    private $connessione;
    private $risultato;
    protected $tabella;
    protected $chiave;
    protected $classe;
    protected $auto_incremento= false;


    public function __construct()
    {
        global $config;
        $this->connect($config['mysql']['host'], $config['mysql']['password'], $config['mysql']['user'], $config['mysql']['database']);
    }


    public function connect($host,$user,$password,$database)
    {
        $this->connessione = mysql_connect($host,$password,$user);
        if (!$this->connessione)
        {
            die('Impossibile connettersi al database: ' . mysql_error());
        }
        $db = mysql_select_db($database,$this->connessione);
        if (!$db)
        {
            die ("Impossibile utilizzare $database: " . mysql_error());
        }
        $this->query('SET names \'utf8\'');
        return true;
    }


    public function query($query)
    {
        $this->risultato=mysql_query($query);
        debug($query);
        debug(mysql_error());
        if (!$this->risultato)
            return false;
        else
            return true;
    }


    public function getQueryInArray()
    {
        if($this->risultato != false)
        {
            $righe = mysql_num_rows($this->risultato);
            $array_ris = array();
            for($i=0;$i<$righe;$i++)
            {
                $array_ris[$i] = mysql_fetch_assoc($this->risultato);
            }
            $this->risultato = false;
            return $array_ris;
        }
        return false;
    }


    public function getObjectInArray()
    {
        if($this->risultato != false)
        {
            $righe = mysql_num_rows($this->risultato);
            $array_ris = array();
            for ($i=0; $i<$righe; $i++)
            {
                $array_ris[$i] = mysql_fetch_object($this->risultato, $this->classe);
            }
            $this->risultato = false;
            return $array_ris;
        }
        return false;
    }


    public function close()
    {
        mysql_close($this->connessione);
    }


    /**
     * Restituisce un oggetto della classe Entity impostata in _return_class contentente i risultati della query
     *
     * @return mixed
     */
    public function getObject()
    {
        if($this->risultato != false)
        {
            $righe=mysql_num_rows($this->risultato);
            if($righe>0)
            {
                $oggetto = mysql_fetch_object($this->risultato, $this->classe);
                $this->risultato=false;
                return $oggetto;
            }
        }
        else return false;
    }


    public function store($object)
    {
        $i=0;
        $valori='';
        $campi='';
        foreach ($object as $key=>$value)
        {
            if (!($this->auto_incremento && $key == $this->chiave) && substr($key, 0, 1)!='_')
            {
                if ($i==0)
                {
                    $campi.='`'.$key.'`';
                    $valori.='\''.$value.'\'';
                } else {
                    $campi.=', `'.$key.'`';
                    $valori.=', \''.$value.'\'';
                }
                $i++;
            }
        }
        $query = 'INSERT INTO '. $this->tabella.' ('.$campi.') VALUES ('.$valori.')';
        $return = $this->query($query);
        if ($this->auto_incremento)
        {
            $query='SELECT LAST_INSERT_ID() AS `id`';
            $this->query($query);
            $risID=$this->getQueryInArray();
            return $risID[0]['id'];
        } else {
            return $return;
        }
    }


    public function load($key)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$key.'\'';
        $this->query($query);
        $obj = $this->getObject();
        return $obj;
    }

    public function CaricaTutto()
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'`';
        $this->query($query);
        //debug("questo è l'oggetto");
        //debug($this->getObject());
        //$obj = $this->getObject();
        $risultato=$this->getObjectInArray();
        return $risultato;
    }

    /**
     * Cancella dal database lo stato di un oggetto
     *
     * @param object $object
     * @return boolean
     */
    public function delete(& $object)// da sistemare per modifica eliminazione
    {
        $arrayObject=get_object_vars($object);
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.$arrayObject[$this->chiave].'\'';
        unset($object);
        return $this->query($query);
    }


    public function loadRicerca($key,$value)//username,valore
    {
        $query='SELECT * ' .
        'FROM `'.$this->tabella.'` ' .
        'WHERE `'.$key.'` = \''.$value.'\'';
        $this->query($query);
        $ris = $this->getObjectInArray();
        return $ris;
    }


    public function loadRicercaConDueValori($key1,$value1,$key2,$value2)
    {
        $query='SELECT * ' .
        'FROM `'.$this->tabella.'` ' .
        'WHERE `'.$key1.'` = \''.$value1.'\' AND '.'`'.$key2.'` = \''.$value2.'\'';
        $this->query($query);
        $ris = $this->getObjectInArray();
        return $ris;
    }


    public function loadRicercaConTreValori($key1,$value1,$key2,$value2,$key3,$value3)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$key1.'` = \''.$value1.'\' AND '.'`'.$key2.'` = \''.$value2.'\'AND '.'`'.$key3.'` = \''.$value3.'\'';
        $this->query($query);
        $ris = $this->getObjectInArray();
        return $ris;
    }


    public function loadRicercaFeedbackLimite($count)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'ORDER BY feedback DESC';
        $this->query($query);
        $ris_totale = $this->getObjectInArray();
        for($i=0;$i<$count;$i++)
        {
            $ris[$i]=$ris_totale[$i];
        }
        return $ris;
    }


    public function loadRicercaFeedback($key,$value)
    {
        $query='SELECT * ' .
        'FROM `'.$this->tabella.'` ' .
        'WHERE `'.$key.'` = \''.$value.'\'' .
        'ORDER BY feedback DESC';
        $this->query($query);
        $ris = $this->getObjectInArray();
        return $ris;
    }


    /**
     * Aggiorna sul database lo stato di un oggetto
     *
     * @param object $object
     * @return boolean
     */
    public function update($object)
    {
        $i=0;
        $fields='';
        foreach ($object as $key=>$value)
        {
            if (!($key == $this->chiave) && substr($key, 0, 1)!='_')
            {
                if ($i==0)
                {
                    $fields.='`'.$key.'` = \''.$value.'\'';
                } else
                {
                    $fields.=', `'.$key.'` = \''.$value.'\'';
                }
                $i++;
            }
        }

        $arrayObject=get_object_vars($object);
        if(is_array($this->chiave))
        {
            $query='UPDATE `'.$this->tabella.'` SET '.$fields.' WHERE ';
            $j=0;
            for($i=0;$i<count($this->chiave);$i++)
            {
                $query=$query.'`'.$this->chiave[$i].'` = \''.$arrayObject[$this->chiave[$i]].'\'';
                if($j<count($this->chiave)-1)
                {
                    $query=$query.' AND ';
                    $j++;
                }
            }
        }
        else
        {
            $query='UPDATE `'.$this->tabella.'` SET '.$fields.' WHERE `'.$this->chiave.'` = \''.$arrayObject[$this->chiave].'\'';
        }
        return $this->query($query);
    }


    public function JSON($param)
    {
        $response = $_GET["callback"] . "(" . json_encode($param) . ")";
        echo $response;
    }


    public function LastViaggioUtente($user)//forse va in futente!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    {
        $query='SELECT * FROM `'.$this->tabella.'` WHERE `utenteusername` = \''.$user.'\''.'ORDER BY id DESC' ;
        $this->query($query);
        $object=$this->getObjectInArray();
        return $object[0];
    }

}
?>