<?php /* Smarty version 2.6.26, created on 2013-11-15 14:08:59
         compiled from admin_elenco_utenti.tpl */ ?>
<script type="text/javascript" src="templates/main/template/js/admin.js"></script>

<div class="content">

    <div class="form_settings">

        <div id="administrator">

        <h3>Lista Utenti:</h3>
        <?php if (( $this->_tpl_vars['utente'] )): ?>
        <table id="administrator">
            <tr>
                <td><h5>Username</h5></td>
                <td><h5>Mail</h5></td>
                <td><h5>Cod_attivazione</h5></td>
                <td><h5>Stato</h5></td>
                <td><h5>Avvertimenti</h5></td>
                <td><h5>Dettagli (link al profilo)</h5></td>
            </tr>
            <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['utente']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <?php echo $this->_tpl_vars['utente'][$this->_sections['nr']['index']]->username; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['utente'][$this->_sections['nr']['index']]->mail; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['utente'][$this->_sections['nr']['index']]->cod_attivazione; ?>

                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['utente'][$this->_sections['nr']['index']]->stato; ?>

                    </td>
                    <td>
                        <span id='numeroavvertimenti'><?php echo $this->_tpl_vars['utente'][$this->_sections['nr']['index']]->avvertimenti; ?>
</span>
                    </td>
                    <td>
                        <a href="?controller=amministrazione&task=dettaglio_utente&username=<?php echo $this->_tpl_vars['utente'][$this->_sections['nr']['index']]->username; ?>
">Vedi dettagli</a>
                    </td>
                </tr>
            <?php endfor; endif; ?>
        </table>
        <?php else: ?>
        <td class="center">
            <h5> Nessun Utente !! c'è un errore :D</h5>
        <td>
            <?php endif; ?>
    </div>
</div>
</div>