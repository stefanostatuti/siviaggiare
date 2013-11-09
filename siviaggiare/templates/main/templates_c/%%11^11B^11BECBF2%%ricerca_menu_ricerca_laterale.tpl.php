<?php /* Smarty version 2.6.26, created on 2013-11-09 10:16:35
         compiled from ricerca_menu_ricerca_laterale.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'ricerca_menu_ricerca_laterale.tpl', 8, false),)), $this); ?>
<div id=tab-citta>
        <ul>
            <li><a href="#tab-1"><h6>Citt&agrave; pi&ugrave; votate</h6></a></li>
            <li><a href="#tab-2"><h6>Ultime Citt&agrave; inserite</h6></a></li>
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
                <button class="button-menu-citta" idviaggio="<?php echo $this->_tpl_vars['cittafeedback'][$this->_sections['nr']['index']]->idviaggio; ?>
" citta="<?php echo ((is_array($_tmp=$this->_tpl_vars['cittafeedback'][$this->_sections['nr']['index']]->nome)) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
">
                    <h6><?php echo $this->_tpl_vars['cittafeedback'][$this->_sections['nr']['index']]->nome; ?>
</h6>
                    <span class="feedback-citta-laterale">
                        <?php echo $this->_tpl_vars['cittafeedback'][$this->_sections['nr']['index']]->feedback; ?>

                    </span>
                </button>
            <?php endfor; endif; ?>
        </div>
        <div id=tab-2>
            <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['ultimecitta']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <button class="button-menu-citta" idviaggio="<?php echo $this->_tpl_vars['ultimecitta'][$this->_sections['nr']['index']]->idviaggio; ?>
" citta="<?php echo ((is_array($_tmp=$this->_tpl_vars['ultimecitta'][$this->_sections['nr']['index']]->nome)) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
">
                    <h6><?php echo $this->_tpl_vars['ultimecitta'][$this->_sections['nr']['index']]->nome; ?>
</h6>
                        <span class="feedback-citta-laterale">
                            <?php echo $this->_tpl_vars['ultimecitta'][$this->_sections['nr']['index']]->feedback; ?>

                        </span>
                </button>
            <?php endfor; endif; ?>
        </div>
    </div>
<br>

<div id=tab-luogo>
    <ul>
        <li><a href="#tab-1"><h6>Luoghi pi&ugrave; votati</h6></a></li>
        <li><a href="#tab-2"><h6>Ultimi Luoghi inseriti</h6></a></li>
    </ul>
    <div id=tab-1>
        <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['luogofeedback']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <button class="button-menu-luogo" idviaggio="<?php echo $this->_tpl_vars['luogofeedback'][$this->_sections['nr']['index']]->idviaggio; ?>
" citta="<?php echo ((is_array($_tmp=$this->_tpl_vars['luogofeedback'][$this->_sections['nr']['index']]->nomecitta)) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
" luogo="<?php echo ((is_array($_tmp=$this->_tpl_vars['luogofeedback'][$this->_sections['nr']['index']]->nome)) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
">
                <h6><?php echo $this->_tpl_vars['luogofeedback'][$this->_sections['nr']['index']]->nome; ?>
</h6>
                    <span class="feedback-luogo-laterale">
                        <?php echo $this->_tpl_vars['luogofeedback'][$this->_sections['nr']['index']]->feedback; ?>

                    </span>
            </button>
        <?php endfor; endif; ?>
    </div>
    <div id=tab-2>
        <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['ultimiluoghi']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <button class="button-menu-luogo" idviaggio="<?php echo $this->_tpl_vars['ultimiluoghi'][$this->_sections['nr']['index']]->idviaggio; ?>
" citta="<?php echo ((is_array($_tmp=$this->_tpl_vars['ultimiluoghi'][$this->_sections['nr']['index']]->nomecitta)) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
" luogo="<?php echo ((is_array($_tmp=$this->_tpl_vars['ultimiluoghi'][$this->_sections['nr']['index']]->nome)) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
">
                <h6><?php echo $this->_tpl_vars['ultimiluoghi'][$this->_sections['nr']['index']]->nome; ?>
</h6>
                        <span class="feedback-luogo-laterale">
                            <?php echo $this->_tpl_vars['ultimiluoghi'][$this->_sections['nr']['index']]->feedback; ?>

                        </span>
            </button>
        <?php endfor; endif; ?>
    </div>
</div>