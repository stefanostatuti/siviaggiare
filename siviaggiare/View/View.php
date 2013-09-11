<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.33
 * To change this template use File | Settings | File Templates.
 */

require('lib/smarty/Smarty.class.php');
    /**
     * @access public
     * @package View
     */

class View extends Smarty {
    public function __construct() {
        $this->Smarty();
        global $config;
        $this->template_dir = $config['smarty']['template_dir'];
        $this->compile_dir = $config['smarty']['compile_dir'];
        $this->config_dir = $config['smarty']['config_dir'];
        $this->cache_dir = $config['smarty']['cache_dir'];
        $this->caching = false;
    }
}
?>
