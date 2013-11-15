<?php /* Smarty version 2.6.26, created on 2013-11-15 14:23:45
         compiled from ricerca_risultati.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'ricerca_risultati.tpl', 25, false),)), $this); ?>
<div class="luoghi-panoramica-ext">
    <h2>Luoghi Trovati:</h2>
    <div class="luoghi-panoramica-int">
        <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['luoghi']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <h3><?php echo $this->_tpl_vars['luoghi'][$this->_sections['nr']['index']]->nome; ?>
, <?php echo $this->_tpl_vars['luoghi'][$this->_sections['nr']['index']]->nomecitta; ?>
<span class="feedback-luogo"><?php echo $this->_tpl_vars['luoghi'][$this->_sections['nr']['index']]->feedback; ?>
</span></h3>
            <div>
                <table>
                    <tr>
                        <td><h5>Autore:</h5></td>
                        <?php if (isset ( $this->_tpl_vars['utente_luogo_logged'] ) && $this->_tpl_vars['utente_luogo_logged'][$this->_sections['nr']['index']] == $this->_tpl_vars['utente_sessione']): ?>
                            <td><a href="index.php?controller=profilo&task=visualizza"><h5><?php echo $this->_tpl_vars['utente_luogo_logged'][$this->_sections['nr']['index']]; ?>
</h5></a></td>
                        <?php elseif (isset ( $this->_tpl_vars['utente_luogo_logged'] )): ?>
                            <td><a class="button-profilo" href="javascript:void(0)" utente="<?php echo $this->_tpl_vars['utente_luogo_logged'][$this->_sections['nr']['index']]; ?>
" pagina="1"><h5><?php echo $this->_tpl_vars['utente_luogo_logged'][$this->_sections['nr']['index']]; ?>
</h5></a></td>
                            <?php else: ?>
                            <td><h5><?php echo $this->_tpl_vars['utente_luogo'][$this->_sections['nr']['index']]; ?>
</h5></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td><h5>Citt&agrave;:</h5></td>  <td><h5><?php echo $this->_tpl_vars['luoghi'][$this->_sections['nr']['index']]->nomecitta; ?>
</h5></td>
                    </tr>
                    <tr>
                        <td><h5>Data:</h5></td>  <td><h5><?php echo $this->_tpl_vars['data'][$this->_sections['nr']['index']]; ?>
</h5></td>
                    </tr>
                    <tr>
                        <td><a class="link-dettaglio-viaggio" href="javascript:void(0)" citta="<?php echo ((is_array($_tmp=$this->_tpl_vars['luoghi'][$this->_sections['nr']['index']]->nomecitta)) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\ \']/", '') : smarty_modifier_regex_replace($_tmp, "/[\ \']/", '')); ?>
" luogo="<?php echo ((is_array($_tmp=$this->_tpl_vars['luoghi'][$this->_sections['nr']['index']]->nome)) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\ \']/", '') : smarty_modifier_regex_replace($_tmp, "/[\ \']/", '')); ?>
" idviaggio="<?php echo $this->_tpl_vars['luoghi'][$this->_sections['nr']['index']]->idviaggio; ?>
"><h5>Visualizza viaggio</h5></a></td>
                    </tr>
                </table>
            </div>
            <?php endfor; else: ?>
            <h5> nessun risultato </h5>
        <?php endif; ?>
    </div>
</div>

<br><br>

<div class="citta-panoramica-ext">
    <h2>Citt&agrave; Trovate:</h2>
    <div class="citta-panoramica-int">
        <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['citta']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <h3><?php echo $this->_tpl_vars['citta'][$this->_sections['nr']['index']]->nome; ?>
, <?php echo $this->_tpl_vars['citta'][$this->_sections['nr']['index']]->stato; ?>
<span class="feedback-citta"><?php echo $this->_tpl_vars['citta'][$this->_sections['nr']['index']]->feedback; ?>
</span></h3>
            <div>
                <table>
                    <tr>
                        <td><h5>Autore:</h5></td>
                        <?php if (isset ( $this->_tpl_vars['utente_citta'] )): ?>
                            <td><h5><?php echo $this->_tpl_vars['utente_citta'][$this->_sections['nr']['index']]; ?>
</h5></td>
                        <?php elseif (isset ( $this->_tpl_vars['utente_citta_logged'] )): ?>
                            <td><a href="""><h5><?php echo $this->_tpl_vars['utente_citta_logged'][$this->_sections['nr']['index']]; ?>
</h5></a></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td><h5>Stato:</h5></td>  <td><h5><?php echo $this->_tpl_vars['citta'][$this->_sections['nr']['index']]->stato; ?>
</h5></td>
                    </tr>
                    <tr>
                        <td><h5>Data:</h5></td>  <td><h5><?php echo $this->_tpl_vars['citta'][$this->_sections['nr']['index']]->datafine; ?>
</h5></td>
                    </tr>
                    <tr>
                        <td><a class="link-dettaglio-viaggio" href="javascript:void(0)" citta="<?php echo ((is_array($_tmp=$this->_tpl_vars['citta'][$this->_sections['nr']['index']]->nome)) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\ \']/", '') : smarty_modifier_regex_replace($_tmp, "/[\ \']/", '')); ?>
" idviaggio=<?php echo $this->_tpl_vars['citta'][$this->_sections['nr']['index']]->idviaggio; ?>
><h5>Visualizza viaggio</h5></a></td>
                    </tr>
                </table>
            </div>
            <?php endfor; else: ?>
            <h5> nessun risultato </h5>
        <?php endif; ?>
    </div>
</div>

<br><br>

<div class="ricerca-navigazione1">
    <button id="prev">Indietro</button><button id="home">Home</button><button id="next">Avanti</button>
</div>