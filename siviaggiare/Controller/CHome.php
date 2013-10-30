<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.27
 * To change this template use File | Settings | File Templates.
 */

class CHome
{

         /*
         * Smista le richieste ai vari controller
         *
         * @return mixed
         */
        public function smista()
        {
        $view=USingleton::getInstance('VHome');
        switch ($view->getController())
        {
            case 'registrazione':
                $CRegistrazione=USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
            case 'ricerca':
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            case 'aggiunta_viaggio':
                $CViaggio=USingleton::getInstance('CViaggio');
                return $CViaggio->smista();
            case 'info':
                return $this->info();
            case 'contattaci':
                return $this->contattaci();
            case 'modifica':
                $CModifica=USingleton::getInstance('CModifica');
                return $CModifica->smista();
            case 'profilo':
                $CProfilo=USingleton::getInstance('CProfilo');
                return $CProfilo->smista();
            case 'amministrazione':
                $CAdmin=USingleton::getInstance('CAdmin');
                return $CAdmin->smista();
            default:
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->impostaPaginaRicerca();
        }
        }

        /**
        * Imposta la pagina, controlla l'autenticazione
        */
        public function impostaPagina ()
        {
            $VHome=USingleton::getInstance('VHome');
            $controller=$VHome->getController();
            $task=$VHome->getTask();
            if($controller=='ricerca')
            {
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            }
            $CRegistrazione=USingleton::getInstance('CRegistrazione');
            $contenuto=$this->smista();
            $VHome->impostaContenuto($contenuto);
            $registrato=null;  //creo $registrato
            $registrato=$CRegistrazione->getAdmin(); //metto in registrato il risultato di getAdmin()
            if ($registrato == 1) //quindi è un admin
            {
                $VHome->impostaPaginaAdmin();
                $VHome->mostraPagina();
            }
            elseif($registrato== 0) //se $registrato è 0 (quindi non è un Admin)
            {
                $registrato=$CRegistrazione->getUtenteRegistrato(); //qua $registrato viene sovrascritto con false o true
                if ($registrato==false)
                {
                    $VHome->impostaPaginaOspite();
                    $VHome->mostraPagina();
                }
                elseif ($registrato==true)
                {
                    $VHome->impostaPaginaAutenticato();
                    $VHome->mostraPagina();
                }
            }
        }

        public function info()
        {
            $VHome=USingleton::getInstance('VHome');
            return $VHome->processaTemplate('home_info.tpl');
        }

        public function contattaci()
        {
            $VHome=USingleton::getInstance('VHome');
            return $VHome->processaTemplate('home_contattaci.tpl');
        }
}

?>