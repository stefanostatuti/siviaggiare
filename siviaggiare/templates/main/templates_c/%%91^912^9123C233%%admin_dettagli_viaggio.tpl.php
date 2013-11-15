<?php /* Smarty version 2.6.26, created on 2013-11-14 23:43:31
         compiled from admin_dettagli_viaggio.tpl */ ?>
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>

<div class=content id="administrator">
    <h3>Viaggio Segnalato</h3>
    <div class=form_settings>

        <?php if (( $this->_tpl_vars['viaggio']->id )): ?>
        <table id="administrator">
            <tr>
                <td><h4>IdViaggio:</h4></td>
                <td><h6><span id= 'idviaggio'><?php echo $this->_tpl_vars['viaggio']->id; ?>
</span></h6></td>
            </tr>
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
</h6></td>
            </tr>
            <!--<tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti&idviaggio=<?php echo $this->_tpl_vars['viaggio']->id; ?>
"<h5>Vedi i luoghi visitati(NON FUNZIONANTE)</h5></a></td>
            </tr>
            -->
        </table>

    <button id="elimina-viaggio" class="elimina-viaggio" >Elimina Viaggio</button>
    <!--<button id="annulla" class="annulla" >Annulla Modifiche</button>-->
    <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
    <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
    <!--<button id="modifica" class="modifica">Modifica Viaggio</button>-->
    <?php endif; ?>


    <?php if (! ( $this->_tpl_vars['viaggio']->id )): ?>
        <br>
        Viaggio GIA RIMOSSO!<br><br>
        consiglio di eliminare la segnalazione
        <br>
        <br>
        <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>
    <?php endif; ?>
</div>
</div>