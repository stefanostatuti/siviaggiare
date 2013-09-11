<?php /* Smarty version 2.6.26, created on 2013-09-02 16:45:03
         compiled from viaggio_elenco_viaggi.tpl */ ?>
<div class="content">
     <div class="form_settings">
        <h3>Viaggi inseriti da te:</h3>
            <table>
            <tr>
            <td><h5>IdViaggio</h5></td>
            <td><h5>Utente</h5></td>
                <td><h5>Data Inizio;</h5></td>
                <td><h5>Data Fine;</h5></td>
                <td><h5></h5></td>
            </tr>
            <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <tr <?php if ((1 & $this->_sections['nr']['iteration'])): ?> bgcolor="#ccc" <?php endif; ?>>
                <td>
                    <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->id; ?>

                </td>
                <td>
                    <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->utenteusername; ?>

                </td>
                <td>
                    <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->datainizio; ?>

                </td>
                <td>
                    <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->datainizio; ?>

                </td>
                <td>
                <a href="?controller=aggiunta_viaggio&task=visualizza_viaggio&id=<?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->id; ?>
">Vedi dettagli</a>
                </td>
                </tr>
            <?php endfor; else: ?>
                <tr>
                <td class="center">
                    <h5> nessun risultato </h5>
                <td>
                </tr>
            <?php endif; ?>
            </table>
     </div>
</div>