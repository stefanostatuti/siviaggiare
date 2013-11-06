<?php /* Smarty version 2.6.26, created on 2013-11-06 13:31:57
         compiled from admin_dettagli_luogo.tpl */ ?>
<?php echo '
    <!--<script type="text/javascript" src="script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
'; ?>


<div class=content>
    <h3>luogo segnalato</h3>
    <div class=form_settings>


        <?php if (( $this->_tpl_vars['luogo']->idviaggio && $this->_tpl_vars['luogo']->nome && $this->_tpl_vars['luogo']->nomecitta )): ?>
        <table>

            <tr>
                <td><h3>IDViaggio:</h3></td><td><span id='idviaggio'><?php echo $this->_tpl_vars['luogo']->idviaggio; ?>
</span></td>
            </tr>

            <tr>
                <td> Nome:</td><td><span id= 'nomeluogo'><?php echo $this->_tpl_vars['luogo']->nome; ?>
<span> </td>
            </tr>
            <tr>
                <td> Citt&agrave;:</td><td><span id= 'nomecitta'><?php echo $this->_tpl_vars['luogo']->nomecitta; ?>
<span></td>
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

        <button id="elimina-luogo" class="elimina-luogo" >Elimina Luogo</button>
        <button id="annulla" class="annulla" >Annulla Modifiche</button>
        <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
        <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
        <button id="modifica" class="modifica">Modifica Luogo</button>
        <?php endif; ?>

        <?php if (! ( $this->_tpl_vars['luogo']->idviaggio && $this->_tpl_vars['luogo']->nome && $this->_tpl_vars['luogo']->nomecitta )): ?>
            <br>
            Luogo GIA RIMOSSO!<br><br>
            consiglio di eliminare la segnalazione
            <br>
            <br>
            <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>
        <?php endif; ?>
    </div>
</div>