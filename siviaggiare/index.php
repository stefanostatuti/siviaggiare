<?php
/*
 * Effettuo il redirect a main/index.php------si viaggiare
 */
require_once 'includes/autoload.inc.php';
require_once 'includes/config.inc.php';

$CHome=USingleton::getInstance('CHome');
$CHome->impostaPagina();
?>