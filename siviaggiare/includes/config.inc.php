<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $config;
//                        WINDOWS
//sono da modificare con i vostri percorsi!!!
/*$config['smarty']['template_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\template\\';
$config['smarty']['compile_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\templates_c\\';
$config['smarty']['config_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\configs\\';
$config['smarty']['cache_dir'] =
'C:\\xampp\\htdocs\\siviaggiare\\siviaggiare\\templates\\main\\cache\\';*/


//                          LINUX
$config['smarty']['template_dir'] =
    '/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/template/';
//'/home/cicerone/public_html/webprog/bookstore/templates/main/template/';
$config['smarty']['compile_dir'] =
    '/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/templates_c/';
$config['smarty']['config_dir'] =
    '/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/configs/';
$config['smarty']['cache_dir'] =
    '/opt/lampp/htdocs/siviaggiare_gitHub/siviaggiare/templates/main/cache/';


/*                          //Mac
$config['smarty']['template_dir'] =
    '/Applications/XAMPP/xamppfiles/htdocs/siviaggiare1/templates/main/template/';
$config['smarty']['compile_dir'] =
    '/Applications/XAMPP/xamppfiles/htdocs/siviaggiare1/templates/main/templates_c/';
$config['smarty']['config_dir'] =
    '/Applications/XAMPP/xamppfiles/htdocs/siviaggiare1/templates/main/configs/';
$config['smarty']['cache_dir'] =
    '/Applications/XAMPP/xamppfiles/htdocs/siviaggiare1/templates/main/cache/';
*/

$config['debug']=true;
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'pippo';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'siviaggiare';

//configurazione server smtp per invio email
// x ALICE: $config['smtp']['host'] = 'out.aliceposta.it';
$config['smtp']['host'] = 'out.aliceposta.it';
$config['smtp']['port'] = '25';
$config['smtp']['smtpauth'] = false;
$config['smtp']['username'] = '';
$config['smtp']['password'] = '';

$config['email_webmaster']='webmaster@yesyoutravel.lamjex.com';
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
