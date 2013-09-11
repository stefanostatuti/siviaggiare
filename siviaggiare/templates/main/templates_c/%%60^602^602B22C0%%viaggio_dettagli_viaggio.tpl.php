<?php /* Smarty version 2.6.26, created on 2013-09-02 17:38:24
         compiled from viaggio_dettagli_viaggio.tpl */ ?>
<div class=content>
    <div class=form_settings>
        <h3>Viaggio</h3>
        <table>
            <tr>
                <td><h4>Autore:</h4></td>
                <td><h6><?php echo $this->_tpl_vars['viaggio']->utenteusername; ?>
</h6></td>
            </tr>
            <tr>
                <td><h4>Periodo</h4></td>
                <td>
                    <h6>Inizio: <?php echo $this->_tpl_vars['viaggio']->datainizio; ?>
 </h6>
                    <h6>Fine: <?php echo $this->_tpl_vars['viaggio']->datafine; ?>
 </h6>
                </td>
            </tr>
            <tr>
                <td> Mezzo di trasporto:</td>
                <td><h6><?php echo $this->_tpl_vars['viaggio']->mezzotrasporto; ?>
</h6></td>
            </tr>
            <tr>
                <td> Costo del trasporto:</td>
                <td><h6><?php echo $this->_tpl_vars['viaggio']->costotrasporto; ?>
</h6></td>
            </tr>
            <tr>
                <td> Budget:</td>
                <td><h6><?php echo $this->_tpl_vars['viaggio']->budget; ?>
<h6></td>
            </tr>
            <tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti&idviaggio=<?php echo $this->_tpl_vars['viaggio']->id; ?>
"<h5>Vedi i luoghi visitati(NON FUNZIONANTE)</h5></a></td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="visualizza_viaggi_inseriti" />
            <input type="submit" class="submit" value="Indietro" />
        </form>
    </div>
</div>