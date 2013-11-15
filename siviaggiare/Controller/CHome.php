<?php
/**
 * @access public
 * @package Controller
 */
class CHome
{

         /**
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
        * @return string
        */
        public function impostaPagina ()
        {
            $VHome=USingleton::getInstance('VHome');
            $controller=$VHome->getController();
            $task=$VHome->getTask();
            if($controller=='registrazione' && $task=='verifica_registrazione')
            {
                $CRegistrazione=USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
            }
            if($controller=='amministrazione' && $task=='modifica_utente')
            {
                $CAdmin=USingleton::getInstance('CAdmin');
                return $CAdmin->smista();
            }
            if($controller=='amministrazione' && $task=='salva_modifica_utente')
            {
                $CAdmin=USingleton::getInstance('CAdmin');
                return $CAdmin->smista();
            }
            if($controller=='aggiunta_viaggio' && $task=='verifica_costobiglietto')
            {
                $CViaggio=USingleton::getInstance('CViaggio');
                return $CViaggio->smista();
            }
            if($controller=='aggiunta_viaggio' && $task=='verifica_alloggio')
            {
                $CViaggio=USingleton::getInstance('CViaggio');
                return $CViaggio->smista();
            }
            if($controller=='profilo' && $task=='visualizza_link')
            {
                $CProfilo=USingleton::getInstance('CProfilo');
                return $CProfilo->smista();
            }
            if($controller=='profilo' && $task=='salva_info')
            {
                $CProfilo=USingleton::getInstance('CProfilo');
                return $CProfilo->smista();
            }
            if($controller=='ricerca')
            {
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            }

            $CRegistrazione=USingleton::getInstance('CRegistrazione');
            $contenuto=$this->smista();
            $VHome->impostaContenuto($contenuto);
            $registrato=null;
            $registrato=$CRegistrazione->getAdmin();
            if ($registrato == 1)
            {
                $VHome->impostaPaginaAdmin();
                $VHome->mostraPagina();
            }
            elseif($registrato== 0)
            {
                $registrato=$CRegistrazione->getUtenteRegistrato();
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


        /**
        * Imposta la pagina info
        * @return string
        */
        public function info()
        {
            $VHome=USingleton::getInstance('VHome');
            return $VHome->processaTemplate('home_info.tpl');
        }


        /**
        * Imposta la pagina contattaci
        * @return string
        */
        public function contattaci()
        {
            $VHome=USingleton::getInstance('VHome');
            return $VHome->processaTemplate('home_contattaci.tpl');
        }
}
?>