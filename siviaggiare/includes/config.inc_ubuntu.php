<?php
/* 
 * To change this template, choose Tools | Templates---------------------DA rivedere
 * and open the template in the editor.
 */

global $config;  //LINUX

$config['smarty']['template_dir'] =
'/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/template/';
//'/home/cicerone/public_html/webprog/bookstore/templates/main/template/';
$config['smarty']['compile_dir'] =
'/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/templates_c/';
$config['smarty']['config_dir'] =
'/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/configs/';
$config['smarty']['cache_dir'] =
'/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/cache/';

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
