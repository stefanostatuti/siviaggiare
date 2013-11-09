<?php /* Smarty version 2.6.26, created on 2013-11-09 11:43:06
         compiled from ricerca_pagina_viaggio.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'ricerca_pagina_viaggio.tpl', 42, false),)), $this); ?>
<div class="dettaglio-viaggio-ext">
    <h2>Informazioni sul viaggio</h2>
        <div>
            <table>
                <tr>
                    <td><h6>Autore:</h6></td>
                    <?php if ($this->_tpl_vars['autenticato'] != false && $this->_tpl_vars['viaggio']->utenteusername == $this->_tpl_vars['autenticato']): ?>
                        <td><a href="index.php?controller=profilo&task=visualizza"><h6><?php echo $this->_tpl_vars['viaggio']->utenteusername; ?>
</h6></a></td>
                    <?php elseif ($this->_tpl_vars['autenticato'] != false): ?>
                        <td><a class="button-profilo" href="javascript:void(0)" utente="<?php echo $this->_tpl_vars['viaggio']->utenteusername; ?>
"><h6><?php echo $this->_tpl_vars['viaggio']->utenteusername; ?>
</h6></a></td>
                    <?php else: ?>
                        <td><h6><?php echo $this->_tpl_vars['viaggio']->utenteusername; ?>
</h6></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td><h6>Periodo:</h6></td>   <td><h6>Dal: <?php echo $this->_tpl_vars['viaggio']->datainizio; ?>
</h6> <h6>Al: <?php echo $this->_tpl_vars['viaggio']->datafine; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Spesa totale:</h6></td>   <td><h6><?php echo $this->_tpl_vars['viaggio']->budget; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Mezzo di trasporto:</h6></td>   <td><h6><?php echo $this->_tpl_vars['viaggio']->mezzotrasporto; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Costo:</h6></td>   <td><h6><?php echo $this->_tpl_vars['viaggio']->costotrasporto; ?>
</h6></td>
                </tr>
                <?php if ($this->_tpl_vars['autenticato'] != false && $this->_tpl_vars['viaggio']->utenteusername != $this->_tpl_vars['autenticato']): ?>
                <tr>
                    <td><a class="button-segnalazione-viaggio" href="javascript:void(0)" utente="<?php echo $this->_tpl_vars['autenticato']; ?>
" idviaggio="<?php echo $this->_tpl_vars['viaggio']->id; ?>
"><h6>Invia segnalazione</h6></a></td>
                </tr>
                <?php endif; ?>
            </table>

    <div id="Segnalazione" title="Esprimi una motivazione:" hidden="">
        <textarea placeholder="Inserisci qui il tuo commento..." maxlength="1024" id="CommentoSegnalazione"></textarea>
    </div>

        </div>
    <h2>Citt&agrave; visitate</h2>
    <div class="citta-visitate">
        <?php unset($this->_sections['citta']);
$this->_sections['citta']['name'] = 'citta';
$this->_sections['citta']['loop'] = is_array($_loop=$this->_tpl_vars['viaggio']->_elenco_citta) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['citta']['show'] = true;
$this->_sections['citta']['max'] = $this->_sections['citta']['loop'];
$this->_sections['citta']['step'] = 1;
$this->_sections['citta']['start'] = $this->_sections['citta']['step'] > 0 ? 0 : $this->_sections['citta']['loop']-1;
if ($this->_sections['citta']['show']) {
    $this->_sections['citta']['total'] = $this->_sections['citta']['loop'];
    if ($this->_sections['citta']['total'] == 0)
        $this->_sections['citta']['show'] = false;
} else
    $this->_sections['citta']['total'] = 0;
if ($this->_sections['citta']['show']):

            for ($this->_sections['citta']['index'] = $this->_sections['citta']['start'], $this->_sections['citta']['iteration'] = 1;
                 $this->_sections['citta']['iteration'] <= $this->_sections['citta']['total'];
                 $this->_sections['citta']['index'] += $this->_sections['citta']['step'], $this->_sections['citta']['iteration']++):
$this->_sections['citta']['rownum'] = $this->_sections['citta']['iteration'];
$this->_sections['citta']['index_prev'] = $this->_sections['citta']['index'] - $this->_sections['citta']['step'];
$this->_sections['citta']['index_next'] = $this->_sections['citta']['index'] + $this->_sections['citta']['step'];
$this->_sections['citta']['first']      = ($this->_sections['citta']['iteration'] == 1);
$this->_sections['citta']['last']       = ($this->_sections['citta']['iteration'] == $this->_sections['citta']['total']);
?>
            <div id=<?php echo ((is_array($_tmp=$this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->nome)) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
>
        <h3><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->nome; ?>
</h3>
        <div class="citta-visitate-int">
        <h4>Informazioni sulla citt&agrave;</h4>
        <div>
            <table>
                <tr>
                    <td><h6>Stato:</h6></td>    <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->stato; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Periodo:</h6></td>   <td><h6>Dal: <?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->datainizio; ?>
</h6> <h6>Al: <?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->datafine; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Tipo di alloggio:</h6></td>   <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->tipoalloggio; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Costo dell'alloggio:</h6></td>   <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->costoalloggio; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Voto dell'utente:</h6></td>   <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->voto; ?>
</h6></td>
                </tr>
                <tr>
                    <td><h6>Feedback:</h6></td>   <td><span class="feedback-citta"><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->feedback; ?>
</h6></span></td>
                    <?php if ($this->_tpl_vars['autenticato'] != false): ?>
                        <td><a class="aggiungi-feedback-citta" href="javascript:void(0)" idviaggio="<?php echo $this->_tpl_vars['viaggio']->id; ?>
" citta="<?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->nome; ?>
" stato="<?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->stato; ?>
"><h6>Aggiungi un feedback</h6></a></td>
                    <?php endif; ?>
                </tr>
                </table>
        </div>
                <h4>Luoghi visitati</h4>
                <div class="luoghi-visitati-int">
                    <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <h5><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->nome; ?>
</h5>
                        <div>
                            <table>
                                <tr>
                                    <td><h6>Sito Web:</h6></td> <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->sitoweb; ?>
</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Come raggiungerlo:</h6></td> <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->percorso; ?>
</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Costo biglietto:</h6></td> <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->costobiglietto; ?>
</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Guida Turistica:</h6></td> <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->guida; ?>
</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Coda all'entrata:</h6></td> <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->coda; ?>
</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Durata della visita:</h6></td> <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->durata; ?>
</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Feedback:</h6></td> <td><span class="feedback-luogo"><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->feedback; ?>
</span></td>
                                </tr>
                                <tr>
                                    <td><h6>Commento dell'autore:</h6></td> <td><h6><?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->commentolibero; ?>
</h6></td>
                                </tr>
                                <td><a class="loadCommento" href="javascript:void(0)" idviaggio="<?php echo $this->_tpl_vars['viaggio']->id; ?>
" citta="<?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->nome; ?>
" luogo="<?php echo $this->_tpl_vars['viaggio']->_elenco_citta[$this->_sections['citta']['index']]->_elenco_luoghi[$this->_sections['nr']['index']]->nome; ?>
"><h6>Vedi i commenti</h6></a></td>
                                </tr>
                            </table>
                        </div>
                    <?php endfor; endif; ?>
                </div>
            </div>
        </div>
    <?php endfor; endif; ?>
    </div>
</div>

<br><br>

    <div class="ricerca-navigazione2">
        <button id="prev">Indietro</button><button id="home">Home</button><button id="next">Avanti</button>
    </div>