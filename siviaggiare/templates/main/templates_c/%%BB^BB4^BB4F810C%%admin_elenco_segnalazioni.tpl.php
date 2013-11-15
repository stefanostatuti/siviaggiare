<?php /* Smarty version 2.6.26, created on 2013-11-15 10:52:13
         compiled from admin_elenco_segnalazioni.tpl */ ?>
<script type="text/javascript" src="templates/main/template/js/admin.js"></script>
<div class="content">
    <div class="form_settings">
        <div id="administrator">
        <h3>Lista segnalazioni ricevute:</h3>
        <?php if (( $this->_tpl_vars['results'] )): ?>
        <table id="administrator">
            <tr>
                <td><h5>Autore</h5></td>
                <td><h5>Utente Segnalato</h5></td>
                <td><h5>IdViaggio</h5></td>
                <td><h5>Citta</h5></td>
                <td><h5>Luogo</h5></td>
                <td><h5>IdCommento</h5></td>
                <td><h5>Dettagli (link alla segnalazione)</h5></td>
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
                <tr>
                    <td>
                        <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->autore; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->segnalato; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->idviaggio; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->citta; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->luogo; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->idcommento; ?>

                    </td>
                    <td>
                        <a href="?controller=amministrazione&task=dettaglio_segnalazione&id=<?php echo $this->_tpl_vars['results'][$this->_sections['nr']['index']]->id; ?>
">Vedi dettagli</a>
                    </td>
                </tr>
            <?php endfor; endif; ?>
        </table>
        <?php else: ?>
        <td class="center">
            <h5> nessuna Segnalazione Ricevuta </h5>
        <td>
            <?php endif; ?>
    </div>

  </div>

</div>