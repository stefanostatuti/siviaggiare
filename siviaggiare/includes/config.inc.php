<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $config;
//sono da modificare con i vostri percorsi!!! CIAO STUPIDILLU
$config['smarty']['template_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\template\\';
$config['smarty']['compile_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\templates_c\\';
$config['smarty']['config_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\configs\\';
$config['smarty']['cache_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\cache\\';

$config['debug']=true;
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'pippo';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'siviaggiare';

//configurazione server smtp per invio email
$config['smtp']['host'] = 'smtp.cheapnet.it';
$config['smtp']['port'] = '25';
$config['smtp']['smtpauth'] = false;
$config['smtp']['username'] = '';
$config['smtp']['password'] = '';

$config['email_webmaster']='webmaster@bookstore.lamjex.com';
$config['url_siviaggiare']='http://localhost/siviaggiare2/';

function debug($var){
    global $config;
    if ($config['debug']){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

?>
