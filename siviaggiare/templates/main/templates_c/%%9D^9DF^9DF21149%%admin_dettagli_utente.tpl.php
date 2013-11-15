<?php /* Smarty version 2.6.26, created on 2013-11-15 14:09:00
         compiled from admin_dettagli_utente.tpl */ ?>
<script type="text/javascript" src="templates/main/template/js/admin.js"></script>


<div class="content">

    <div class=form_settings>

        <div id="administrator">

        <h3>Dettagli Utente</h3>

        <?php if (( $this->_tpl_vars['utente']->username )): ?>
        <!--<h3>Utente: <?php echo $this->_tpl_vars['utente']->username; ?>
</h3>-->
            <table id="administrator">
                <tr>
                    <td>Username:</td><td><span id= 'nomeutente'><?php echo $this->_tpl_vars['utente']->username; ?>
</span> </td>
                </tr>
                <tr>
                    <td>Nome:</td><td> <?php echo $this->_tpl_vars['utente']->nome; ?>
</td>
                </tr>
                <tr>
                    <td>Cognome:</td><td> <?php echo $this->_tpl_vars['utente']->cognome; ?>
 </td>
                </tr>
                <tr>
                    <td>Residenza:</td><td> <?php echo $this->_tpl_vars['utente']->residenza; ?>
 </td>
                </tr>
                <tr>
                    <td>Nazione:</td><td> <?php echo $this->_tpl_vars['utente']->nazione; ?>
 </td>
                </tr>
                <tr>
                    <td>Mail:</td><td> <?php echo $this->_tpl_vars['utente']->mail; ?>
 </td>
                </tr>
                <tr>
                    <td>Password:</td><td> <?php echo $this->_tpl_vars['utente']->password; ?>
 </td>
                </tr>
                <tr>
                    <td>Codice attivazione:</td><td> <?php echo $this->_tpl_vars['utente']->cod_attivazione; ?>
 </td>
                </tr>
                <tr>
                    <td>Numero Avvertimenti:</td><td><span id='numeroavvertimenti'><?php echo $this->_tpl_vars['utente']->avvertimenti; ?>
</span> </td>
                </tr>
                <tr>
                    <td>Stato:</td><td><span id='stato'><?php echo $this->_tpl_vars['utente']->stato; ?>
</span></td>
                </tr>
            </table>
            <button id="elimina-utente" class="elimina-utente" >Elimina Utente</button>
            <button id="annulla" class="annulla">Annulla Modifiche</button>
            <button id="gestisci-utente" class="gestisci-utente">Gestisci Utente</button>
            <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
            <button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>
            <button id="modifica" class="modifica">Modifica Utente</button>
        <?php endif; ?>



            <?php if (! ( $this->_tpl_vars['utente']->username )): ?>
                <br>
                Utente GIA RIMOSSO!<br><br>
                <br>
                <br>
                <button id="redirect-utenti" class="redirect-utenti">Lista Utenti</button>

            <?php endif; ?>
        </div>
    </div>
</div>