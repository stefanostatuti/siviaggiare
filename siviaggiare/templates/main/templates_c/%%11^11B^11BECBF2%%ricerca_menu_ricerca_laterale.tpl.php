<?php /* Smarty version 2.6.26, created on 2013-11-04 17:23:01
         compiled from ricerca_menu_ricerca_laterale.tpl */ ?>
<div id=tab-citta>
        <ul>
            <li><a href="#tab-1"><h6>Citt&agrave; pi&ugrave; votate<h6></a></li>
            <li><a href="#tab-2"><h6>Ultime Citt&agrave;<h6></a></li>
        </ul>
        <div id=tab-1>
            <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['cittafeedback']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nr']['show'] = true;
$this->_sections['nr']['max'] = $this->_sections['nr']['loop'];
$this->_sections['nr']['step'] = 1;
$this->_sections['nr']['start'] = $this->_sections['nr']['step'] > 0 ? 0 : $this->_sections['nr']['loop']-1;
if ($this->_sections['nr']['show']) {
    $this->_sections['nr']['total'] = $this->_sections['nr']['loop'];
    if ($this->_sections['nr']['total'] == 0)
        $this->_sections['nr']['show'] = false;
} else
    $this->_sections['nr']['total'] = 0;
if ($this->_sections['nr']['show']):

            for ($this->_sections['nr']['index'] = $this->_sections['nr']['start'], $this->_sections['nr']['iteration'] = 1;
                 $this->_sections['nr']['iteration'] <= $this->_sections['nr']['total'];
                 $this->_sections['nr']['index'] += $this->_sections['nr']['step'], $this->_sections['nr']['iteration']++):
$this->_sections['nr']['rownum'] = $this->_sections['nr']['iteration'];
$this->_sections['nr']['index_prev'] = $this->_sections['nr']['index'] - $this->_sections['nr']['step'];
$this->_sections['nr']['index_next'] = $this->_sections['nr']['index'] + $this->_sections['nr']['step'];
$this->_sections['nr']['first']      = ($this->_sections['nr']['iteration'] == 1);
$this->_sections['nr']['last']       = ($this->_sections['nr']['iteration'] == $this->_sections['nr']['total']);
?>
                <button class="button-menu-citta">
                    <?php echo $this->_tpl_vars['cittafeedback'][$this->_sections['nr']['index']]->nome; ?>

                    <div class="feedback-citta-laterale">
                        <?php echo $this->_tpl_vars['cittafeedback'][$this->_sections['nr']['index']]->feedback; ?>

                    </div>
                </button>
            <?php endfor; endif; ?>
        </div>
    </div>