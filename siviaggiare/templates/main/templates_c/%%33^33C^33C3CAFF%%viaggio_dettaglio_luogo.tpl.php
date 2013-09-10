<?php /* Smarty version 2.6.26, created on 2013-09-02 16:00:48
         compiled from viaggio_dettagli_luogo.tpl */ ?>
<div class=content>
    <div class=form_settings>
        <h3>Viaggio <?php echo $this->_tpl_vars['luogo']->id; ?>
 </h3>
        <table>
            <tr>
                <td> Nome:</td><td><?php echo $this->_tpl_vars['luogo']->nome; ?>
 </td>
            </tr>
            <tr>
                <td> Citt&agrave;:</td><td> <?php echo $this->_tpl_vars['luogo']->nomecitta; ?>
 </td>
            </tr>
            <tr>
                <td> Sito Web:</td><td> <?php echo $this->_tpl_vars['luogo']->sitoweb; ?>
 </td>
            </tr>
            <tr>
                <td> Percorso:</td><td> <?php echo $this->_tpl_vars['luogo']->percorso; ?>
 </td>
            </tr>
            <tr>
                <td> Costo del Biglietto:</td><td> <?php echo $this->_tpl_vars['luogo']->costobiglietto; ?>
 </td>
            </tr>
            <tr>
                <td> Guida Turistica:</td><td> <?php echo $this->_tpl_vars['luogo']->guida; ?>
 </td>
            </tr>
            <tr>
                <td> Coda:</td><td> <?php echo $this->_tpl_vars['luogo']->coda; ?>
 </td>
            </tr>
            <tr>
                <td> Durata Visita:</td><td> <?php echo $this->_tpl_vars['luogo']->durata; ?>
 </td>
            </tr>
            <tr>
                <td> Commento Personale:</td><td> <?php echo $this->_tpl_vars['luogo']->commentolibero; ?>
 </td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="visualizza_luoghi_inseriti" />
            <input type="submit" class="submit" value="Indietro" />
        </form>
    </div>
</div>