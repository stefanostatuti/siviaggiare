<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.27
 * To change this template use File | Settings | File Templates.
 */

class CHome {
         /*
         * Smista le richieste ai vari controller
         *
         * @return mixed
         */
        public function smista() {
        $view=USingleton::getInstance('VHome');
        switch ($view->getController()) {
            case 'registrazione':
                $CRegistrazione=USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
            case 'ricerca':
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            case 'aggiunta_viaggio':
                $CViaggio=USingleton::getInstance('CViaggio');
                return $CViaggio->smista();
            default:
                return $view->mostraPaginaIniziale();
            }
        }

    /**
     * Imposta la pagina, controlla l'autenticazione
     */
    public function impostaPagina ()
    {
        $CRegistrazione=USingleton::getInstance('CRegistrazione');
        $registrato=$CRegistrazione->getUtenteRegistrato();
		var_dump($registrato);
        $VHome= USingleton::getInstance('VHome');
        var_dump($VHome->getController());
        if ($registrato==false && $VHome->getController()==false)
        {
             $VHome->mostraPaginaIniziale();
        } else
            $this->smista();
    }
}

?>