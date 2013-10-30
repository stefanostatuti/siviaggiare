<?php /* Smarty version 2.6.26, created on 2013-10-26 11:11:21
         compiled from admin_dettagli_segnalazione.tpl */ ?>
<?php echo '
    <!--<script type="text/javascript" src="//siviaggiare//script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
'; ?>


<div class="content">
    <h3>Dettaglio segnalazione <?php echo $this->_tpl_vars['segnalazione']->idsegnalazione; ?>
 di <?php echo $this->_tpl_vars['segnalazione']->autore; ?>
:</h3>
    <div class="form_settings">

        <?php if (( $this->_tpl_vars['segnalazione']->idsegnalazione )): ?>
        <table>
            <tr>
                <td><h4>IdSegnalazione</h4></td>
                <td><h6><span id= 'idsegnalazione'><?php echo $this->_tpl_vars['segnalazione']->idsegnalazione; ?>
</span></h6></td>
            </tr>
            <tr>
                <td><h4>Autore</h4></td>
                <td><h6><?php echo $this->_tpl_vars['segnalazione']->autore; ?>
</h6></td>
            </tr>
            <tr>
                <td><h4>Utente Segnalato</h4></td>
                <td><h6><?php echo $this->_tpl_vars['segnalazione']->segnalato; ?>
</h6></td>
            </tr>
            <?php if (( $this->_tpl_vars['segnalazione']->idviaggio ) && ! ( $this->_tpl_vars['segnalazione']->citta )): ?> <!-- verifica che non ci sia nome città-->
                <tr>
                    <td><h4>IdViaggio</h4></td>
                    <td><h6><?php echo $this->_tpl_vars['segnalazione']->idviaggio; ?>
</h6></td>
                </tr>
            <?php endif; ?>
            <?php if (( $this->_tpl_vars['segnalazione']->citta ) && ! ( $this->_tpl_vars['segnalazione']->luogo )): ?><!-- verifica che non ci sia nome città-->
                <tr>
                    <td><h4>Citta (accoppiata Citta con IDVIAGGIO)</h4></td>

                        <td><h6>citta=<?php echo $this->_tpl_vars['segnalazione']->citta; ?>
</h6></td>
                        <td><h6>idviaggio=<?php echo $this->_tpl_vars['segnalazione']->idviaggio; ?>
</h6></td>
                </tr>
            <?php endif; ?>
            <?php if (( $this->_tpl_vars['segnalazione']->idluogo )): ?>
                <tr>
                    <td><h4>Luogo accoppiata Luogo con IdViaggio e Citta</h4></td>
                    <table>
                        <td><h6><?php echo $this->_tpl_vars['segnalazione']->idviaggio; ?>
</h6></td>
                        <td><h6><?php echo $this->_tpl_vars['segnalazione']->citta; ?>
</h6></td>
                        <td><h6><?php echo $this->_tpl_vars['segnalazione']->luogo; ?>
</h6></td>
                    </table>
                </tr>
            <?php endif; ?>
            <?php if (( $this->_tpl_vars['segnalazione']->idcommento )): ?>
                <tr>
                <td><h4>IdCommento</h4></td>
                <td><h6><?php echo $this->_tpl_vars['segnalazione']->idcommento; ?>
</h6></td>
                <tr>
            <?php endif; ?>
             <tr>
                <td><h4>Motivo segnalazione</h4></td>
                <td><h6><?php echo $this->_tpl_vars['segnalazione']->motivo; ?>
</h6></td>
             </tr>

             <tr>
                <td><h4>Dettagli (link alla segnalazione)</h4></td>

                <!-----qua metto il link a seconda del tipo di segnalazione-->
                    <?php if (( $this->_tpl_vars['segnalazione']->idviaggio ) && ! ( $this->_tpl_vars['segnalazione']->citta )): ?>
                    <td>
                        <a href="?controller=amministrazione&task=dettaglio_segnalazione_viaggio&idviaggio=<?php echo $this->_tpl_vars['segnalazione']->idviaggio; ?>
">Vedi dettagli</a>
                    </td>
                    <?php endif; ?>
                    <?php if (( $this->_tpl_vars['segnalazione']->citta ) && ! ( $this->_tpl_vars['segnalazione']->luogo )): ?>
                        <td>
                            <a href="?controller=amministrazione&task=dettaglio_segnalazione_citta&idviaggio=<?php echo $this->_tpl_vars['segnalazione']->idviaggio; ?>
&nomecitta=<?php echo $this->_tpl_vars['segnalazione']->citta; ?>
" >Vedi dettagli</a>
                        </td>
                    <?php endif; ?>
                    <?php if (( $this->_tpl_vars['segnalazione']->luogo )): ?>
                        <td>
                            <a href="?controller=amministrazione&task=dettaglio_segnalazione_luogo&idviaggio=<?php echo $this->_tpl_vars['segnalazione']->idviaggio; ?>
&nomecitta=<?php echo $this->_tpl_vars['segnalazione']->citta; ?>
&nome=<?php echo $this->_tpl_vars['segnalazione']->luogo; ?>
">Vedi dettagli</a>
                        </td>
                    <?php endif; ?>
                    <?php if (( $this->_tpl_vars['segnalazione']->idcommento )): ?>
                        <td>
                            <a href="?controller=amministrazione&task=dettaglio_segnalazione_commento&idcommento=<?php echo $this->_tpl_vars['segnalazione']->idcommento; ?>
">Vedi dettagli</a>
                        </td>
                    <?php endif; ?>
                    <!-- ----------------------------FINE------------------------------------------>
                </tr>
        </table>

            <button id="elimina-segnalazione"  class="elimina-segnalazione" >Elimina Segnalazione</button>
        <?php endif; ?>

        <?php if (! ( $this->_tpl_vars['segnalazione']->idsegnalazione )): ?>
            <br>
            Segnalazione RIMOSSA!<br><br>
            <br>
            <br>
            <button id="redirect" class="redirect">Vai alla lista Segnalazioni</button>

        <?php endif; ?>
    </div>
</div>