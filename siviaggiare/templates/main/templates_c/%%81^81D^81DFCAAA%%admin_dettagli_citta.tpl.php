<?php /* Smarty version 2.6.26, created on 2013-11-14 23:42:41
         compiled from admin_dettagli_citta.tpl */ ?>
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>

<div class=content id="administrator">
    <h3>Citt&agrave; segnalata</h3>
    <div class=form_settings>

        <?php if (( $this->_tpl_vars['citta']->idviaggio && $this->_tpl_vars['citta']->nome )): ?>
        <table id="administrator">
            <tr>
                <td><h4>Idviaggio:</h4></td>
                <td><h6><span id= 'idviaggio'><?php echo $this->_tpl_vars['citta']->idviaggio; ?>
<span></h6></td>
            </tr>
            <tr>
                <td> Nome:</td>
                <td><h6><span id= 'nomecitta'><?php echo $this->_tpl_vars['citta']->nome; ?>
</span></h6></td>
            </tr>
            <tr>
                <td> Stato:</td>
                <td><h6><?php echo $this->_tpl_vars['citta']->stato; ?>
</h6></td>
            </tr>
            <tr>
                <td><h4>Periodo</h4></td>
                <td>
                    <h6>Inizio: <?php echo $this->_tpl_vars['citta']->datainizio; ?>
 </h6>
                    <h6>Fine: <?php echo $this->_tpl_vars['citta']->datafine; ?>
 </h6>
                </td>
            </tr>
            <tr>
                <td> Tipo di alloggio:</td>
                <td><h6><?php echo $this->_tpl_vars['citta']->tipoalloggio; ?>
</h6></td>
            </tr>
            <tr>
                <td> Costo dell' alloggio:</td>
                <td><h6><?php echo $this->_tpl_vars['citta']->costoalloggio; ?>
</h6></td>
            </tr>
            <tr>
                <td> Voto: </td>
                <td><h6><?php echo $this->_tpl_vars['citta']->voto; ?>
</h6></td>
            </tr>
        </table>
        <button id="elimina-citta" class="elimina-citta" >Elimina Citta</button>
        <!--<button id="annulla" class="annulla" >Annulla Modifiche</button>-->
        <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
        <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
        <!--<button id="modifica" class="modifica">Modifica Citta</button>-->
        <?php endif; ?>

        <?php if (! ( $this->_tpl_vars['citta']->idviaggio && $this->_tpl_vars['citta']->nome )): ?>
            <br>
            Citta GIA RIMOSSA!<br><br>
            consiglio di eliminare la segnalazione
            <br>
            <br>
            <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>
        <?php endif; ?>
    </div>
</div>