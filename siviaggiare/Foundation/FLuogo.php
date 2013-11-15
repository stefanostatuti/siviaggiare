<?php

class FLuogo extends FDatabase
{

    public function __construct()
    {
        $this->tabella='luogo';
        $this->chiave=array('idviaggio','nome','nomecitta');
        $this->classe='ELuogo';
        $this->auto_incremento=false;
        USingleton::getInstance('FDatabase');
    }


    /**
     * carica un determinato luogo
     *
     * @param $key
     * @return mixed
     */
    public function loadLuogo($key)
    {
        $query='SELECT * ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio'].'\' AND '.'`'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nome']).'\' AND '.'`'.$this->chiave[2].'` = \''.mysql_real_escape_string($key['nomecitta']).'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


    /**
     * cancella un determinato luogo
     *
     * @param $key
     * @return mixed
     */
    public function deleteLuogo($key)
    {
        $query='DELETE ' .
            'FROM `'.$this->tabella.'` ' .
            'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio']
            .'\' AND '.'`'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nome'])
            .'\' AND '.'`'.$this->chiave[2].'` = \''.mysql_real_escape_string($key['nomecitta'])
            .'\'';
        $obj=parent::getObject(parent::query($query));
        return $obj;
    }


    /**
     * carica gli ultimi luoghi inseriti
     *
     * @param int $count
     * @return array
     */
    public function loadLastLuoghi($count)
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
     * aggiorna il numero di feedback
     *
     * @param array $key
     * @return mixed
     */
    public function updateFeedback($key)
    {
        $query='UPDATE `'.$this->tabella.'` SET `feedback`=`feedback`+1 , `utentifeedback` = CONCAT(`utentifeedback`, "'.$key['username'].'", " ") WHERE '
            .'`'.$this->chiave[0].'` = \''.$key['idviaggio'].'\''
            .' AND `'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nomeluogo']).'\''
            .' AND `'.$this->chiave[2].'` = \''.mysql_real_escape_string($key['nomecitta']).'\'';
        $result=$this->query($query);
        if($result!=false)
        {
            $query='SELECT * ' .
                'FROM `'.$this->tabella.'` ' .
                'WHERE `'.$this->chiave[0].'` = \''.$key['idviaggio']
                .'\' AND '.'`'.$this->chiave[1].'` = \''.mysql_real_escape_string($key['nomeluogo'])
            .'\' AND '.'`'.$this->chiave[2].'` = \''.mysql_real_escape_string($key['nomecitta']).'\'';
            $obj=parent::getObject(parent::query($query));
            return $obj->feedback;
        }
        else
            return false;
    }
}
?>