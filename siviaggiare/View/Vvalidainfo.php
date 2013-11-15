<?php

class Vvalidainfo extends View
{

    /**
     * se il nome dell'utente è settato verifica se quest'ultimo è un alfanumerico restituendo un buleano
     * @author Riccardo
     * @return array
     */
   public function ValidaNome()
   {
     $view=USingleton::getInstance('VProfilo');
     $nome=$view->getCampo();
     if($nome != null)
     {  
        $pattern = '/^[a-zA-Z \' ]{3,15}$/';
        if ( !preg_match( $pattern, $nome) )
        {
            return false;
        }   
        else
        {
            return true;
        }
     }
   }


    /**
     * se il cognome dell'utente è settato verifica se quest'ultimo è un alfanumerico restituendo un buleano
     * @author Riccardo
     * @return array
     */
    public function ValidaCognome()
   {
     $view=USingleton::getInstance('VProfilo');
     $cognome=$view->getCampo();
     if($cognome != null)
     { 
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $cognome ) )
        {
            return false;
        }
        else
        {
            return true;
        }
     }
   }


    /**
     * se la nazione dell'utente è settata verifica se quest'ultima è un alfanumerico restituendo un buleano
     * @author Riccardo
     * @return array
     */
    public function ValidaNazione()
   {
     $view=USingleton::getInstance('VProfilo');
     $nazione=$view->getCampo();
     if($nazione != null)
     { 
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $nazione ) )
        {
            return false;
        }
        else
        {
            return true;
        }
     }
   }


    /**
     * se il numero di telefono dell'utente è settato verifica se quest'ultimo è un intero di al più 12 cifre restituendo un buleano
     * @author Riccardo
     * @return array
     */
   public function ValidaTelefono()
   {
     $view=USingleton::getInstance('VProfilo');
     $telefono=$view->getCampo();
     if($telefono != null)
     { 
        $pattern = '/^[0-9 ]{8,12}$/';
        if ( !preg_match( $pattern, $telefono ))
        {
            return false;
        }
        else
        {
            return true;
        }
     }
   }


    /**
     * se la citta dell'utente è settata verifica se quest'ultima è un alfanumerico restituendo un buleano
     * @author Riccardo
     * @return array
     */
   public function ValidaResidenza()
   {
     $view=USingleton::getInstance('VProfilo');
     $nazione=$view->getCampo();
     if($nazione != null)
     {
        $pattern = '/^[a-zA-Z \' ]{3,20}$/';
        if ( !preg_match( $pattern, $nazione ))
        {
            return false;
        }
        else
        {
            return true;
        }
     }
   }


    /**
     * se l'e-mail dell'utente è settata verifica se quest'ultima è i tipo mail restituendo un buleano
     * @author Riccardo
     * @return array
     */
   public function validaMail()
   {
     $view=USingleton::getInstance('VProfilo');
     $mail=$view->getCampo();
     if($mail != null)
     {
        $pattern = '/^[_a-z0-9-]{2,15}+(\.[_a-z0-9-]{1,15}+)*@[a-z0-9-]{2,10}+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if ( !preg_match( $pattern, $mail ) )
        {
            return false;
        }
        else
        {
            return true;
        }
     }
   }
}
?>