<?php

class FCitta extends FDatabase
{

    public function __construct() 
    {
        $this->tabella='citta';
        $this->chiave=array('idviaggio','nome');
        $this->classe='ECitta';
        $this->auto_incremento=false;
        USingleton::getInstance('FDatabase');
    }


    /**
     * Carica la citta
     * @param array $key
     * @return mixed
     */
    public function loadCitta($key)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio']
            .'\' AND '.'`'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nome']).'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


    /**
     * Elimina la citta
     * @param array $key
     * @return mixed
     */
    public function deleteCitta($key)
    {
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio']
            .'\' AND '.'`'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nome']).'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


    /**
     * Carica le ultime citta inserite nel database
     * @param int $count
     * @return array $ris
     */
    public function loadLastCitta($count)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'ORDER BY `'.$this->chiave[0].'` DESC';
        $this->query($query);
        $ris_totale = parent::getObjectInArray(parent::query($query));
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
     * Aggiorna il feedback della città
     * @param array $key
     * @return mixed
     */
    public function updateFeedback($key)
    {
        $query='UPDATE `'.$this->tabella.'` SET `feedback`=`feedback`+1 , `utentifeedback` = CONCAT(`utentifeedback`, "'.$key['username'].'", " ") WHERE '
            .'`'.$this->chiave[0].'` = \''.$key['idviaggio'].'\''
            .' AND `'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nomecitta']).'\'';
        $result=$this->query($query);
        if($result!=false)
        {
            $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio']
            .'\' AND '.'`'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nomecitta']).'\'';
            $obj=parent::getObject(parent::query($query));
            return $obj->feedback;
        }
        else
            return false;
    }

}
?>