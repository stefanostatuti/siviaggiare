<?php /* Smarty version 2.6.26, created on 2013-11-14 23:43:08
         compiled from admin_dettagli_commento.tpl */ ?>
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>

<div class=content id="administrator">
    <h3>Dettagli commento segnalato:</h3>
        <div class=form_settings>

            <?php if (( $this->_tpl_vars['commento']->id )): ?>

                 <table id="administrator">
                     <tr>
                         <td> ID del Commento </td><td><span id= 'idcommento'><?php echo $this->_tpl_vars['commento']->id; ?>
</span></td>
                     </tr>
                     <tr>
                         <td> ID del Viaggio </td><td><?php echo $this->_tpl_vars['commento']->idviaggio; ?>
</td>
                     </tr>
                     <tr>
                         <td> Autore del messaggio:</td><td> <?php echo $this->_tpl_vars['commento']->autore; ?>
 </td>
                     </tr>
                    <tr>
                            <td> Nome Luogo:</td><td> <?php echo $this->_tpl_vars['commento']->nomeluogo; ?>
 </td>
                        </tr>
                    <tr>
                            <td> Nome Citt&agrave;:</td><td> <?php echo $this->_tpl_vars['commento']->nomecitta; ?>
 </td>
                        </tr>
                    <tr>
                            <td> Testo:</td><td> <?php echo $this->_tpl_vars['commento']->testo; ?>
 </td>
                        </tr>
                    <tr>
                            <td> Voto:</td><td> <?php echo $this->_tpl_vars['commento']->voto; ?>
 </td>
                        </tr>
                </table>
            <button id="elimina-commento" class="elimina-commento" >Elimina Commento</button>
            <!--<button id="annulla" class="annulla" >Annulla Modifiche</button>-->
            <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
            <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
            <!--<button id="modifica" class="modifica">Modifica Commento</button>-->
            <?php endif; ?>


            <?php if (! ( $this->_tpl_vars['commento']->id )): ?>
            <br>
               Commento GIA RIMOSSO!<br><br>
               consiglio di eliminare la segnalazione
            <br>
            <br>
            <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>

            <?php endif; ?>
            </div>
    </div>