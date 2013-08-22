<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francesco
 * Date: 16/08/13
 * Time: 15.37
 * To change this template use File | Settings | File Templates.
 */

class VHome extends View {

    public function getController() {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }

    public function mostraPaginaIniziale() {
        //$this->assign('right_content',$this->_side_content);
        //$this->assign('tasti_laterali',$this->_side_button);
        $this->display('Home_default.tpl');
    }
}
?>