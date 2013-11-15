<?php

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


    /**
     * inizializza la connessione tramite parametri sql per l'accesso al db
     * @param $host
     * @param $user
     * @param $password
     * @param $database
     * @return mixed
     */
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


    /**
     * verifica il ritorno delle query
     * @param $query
     * @return boolean
     */
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


    /**
     * dispone i risultati di una query in array
     *
     * @return mixed
     */
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


    /**
     * crea un array di oggetti data una query
     *
     * @return mixed
     */
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


    /**
     * chiude la sessione con il db
     *
     */
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


    /**
     * salva dati in database
     * @param $object
     * @return mixed
     */
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
                    $campi.='`'.mysql_real_escape_string($key).'`';
                    $valori.='\''.mysql_real_escape_string($value).'\'';
                } else {
                    $campi.=', `'.mysql_real_escape_string($key).'`';
                    $valori.=', \''.mysql_real_escape_string($value).'\'';
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
        } else
        {
            return $return;
        }
    }


    /**
     * carica dati da database
     * @param $key
     * @return mixed
     */
    public function load($key)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave.'` = \''.mysql_real_escape_string($key).'\'';
        $this->query($query);
        $obj = $this->getObject();
        return $obj;
    }


    public function CaricaTutto()
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'`';
        $this->query($query);
        $risultato=$this->getObjectInArray();
        return $risultato;
    }


    /**
     * Cancella dal database lo stato di un oggetto
     *
     * @param object $object
     * @return boolean
     */
    public function delete($object)
    {
        $i=0;
        $fields='';
        foreach ($object as $key=>$value)
        {
            if (!($key == $this->chiave) && substr($key, 0, 1)!='_')
            {
                if ($i==0)
                {
                    $fields.='`'.$key.'` = \''.mysql_real_escape_string($value).'\'';
                } else
                {
                    $fields.=', `'.$key.'` = \''.mysql_real_escape_string($value).'\'';
                }
                $i++;
            }
        }

        $arrayObject=get_object_vars($object);
        if(is_array($this->chiave))
        {
            $query= 'DELETE FROM `'.$this->tabella.'` WHERE ';
            $j=0;
            for($i=0;$i<count($this->chiave);$i++)
            {
                $query=$query.'`'.$this->chiave[$i].'` = \''.mysql_real_escape_string($arrayObject[$this->chiave[$i]]).'\'';
                if($j<count($this->chiave)-1)
                {
                    $query=$query.' AND ';
                    $j++;
                }
            }
        }
        else
        {
            $query='DELETE FROM `'.$this->tabella.'` WHERE `'.$this->chiave.'` = \''.mysql_real_escape_string($arrayObject[$this->chiave]).'\'';
        }
        return $this->query($query);
    }


    /**
     * carica dati per la ricerca, dal database
     * @param $key
     * @param $value
     * @return mixed
     */
    public function loadRicerca($key,$value)
    {
        if(count($key)==3)
        {
            $query='SELECT * ' .
                'FROM `'.$this->tabella.'` ' .
                'WHERE `'.$key[0].'` = \''.$value[0].'\' AND '.'`'.$key[1].'` = \''.$value[1].'\'AND '.'`'.$key[2].'` = \''.$value[2].'\'';
            $this->query($query);
            $ris = $this->getObjectInArray();
            return $ris;
        }
        elseif(count($key)==2)
        {
            $query='SELECT * ' .
                'FROM `'.$this->tabella.'` ' .
                'WHERE `'.$key[0].'` = \''.$value[0].'\' AND '.'`'.$key[1].'` = \''.$value[1].'\'';
            $this->query($query);
            $ris = $this->getObjectInArray();
            return $ris;
        }
        else{
            $query='SELECT * ' .
                'FROM `'.$this->tabella.'` ' .
                'WHERE `'.$key.'` = \''.$value.'\'';
            $this->query($query);
            $ris = $this->getObjectInArray();
            return $ris;
        }
    }


    /**
     * Aggiorna sul database lo stato di un oggetto
     *
     * @param $count
     * @return array
     */
    public function loadRicercaFeedbackLimite($count)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'ORDER BY feedback DESC';
        $this->query($query);
        $ris_totale = $this->getObjectInArray();
        if($ris_totale!=false)
        {
            if(count($ris_totale)>=$count)
            {
                for($i=0;$i<$count;$i++)
                {
                    $ris[$i]=$ris_totale[$i];
                }
                return $ris;
            }
            elseif(count($ris_totale)<$count)
            {
                for($i=0;$i<count($ris_totale);$i++)
                {
                    $ris[$i]=$ris_totale[$i];
                }
                return $ris;
            }
        }
        else return false;
    }


    /**
     * carica dati dal db ordinati per feedback
     *
     * @param $key
     * @param $value
     * @return array
     */
    public function loadRicercaFeedback($key,$value)
    {
        $query='SELECT * ' .
        'FROM `'.$this->tabella.'` ' .
        'WHERE `'.$key.'` = \''.mysql_real_escape_string($value).'\'' .
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
                    $fields.='`'.$key.'` = \''.mysql_real_escape_string($value).'\'';
                } else
                {
                    $fields.=', `'.$key.'` = \''.mysql_real_escape_string($value).'\'';
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
                $query=$query.'`'.$this->chiave[$i].'` = \''.mysql_real_escape_string($arrayObject[$this->chiave[$i]]).'\'';
                if($j<count($this->chiave)-1)
                {
                    $query=$query.' AND ';
                    $j++;
                }
            }
        }
        else
        {
            $query='UPDATE `'.$this->tabella.'` SET '.$fields.' WHERE `'.mysql_real_escape_string($this->chiave).'` = \''.$arrayObject[$this->chiave].'\'';
        }
        return $this->query($query);
    }


    /**
     * carica dal db l'ultimo viaggio di un utente
     *
     * @param $user
     * @return mixed
     */
    public function LastViaggioUtente($user)//forse va in futente!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    {
        $query='SELECT * FROM `'.$this->tabella.'` WHERE `utenteusername` = \''.$user.'\''.'ORDER BY id DESC' ;
        $this->query($query);
        $object=$this->getObjectInArray();
        return $object[0];
    }

}
?>