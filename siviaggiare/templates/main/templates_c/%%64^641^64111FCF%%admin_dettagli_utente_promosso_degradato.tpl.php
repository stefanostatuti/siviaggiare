<?php /* Smarty version 2.6.26, created on 2013-10-25 15:50:28
         compiled from admin_dettagli_utente_promosso_degradato.tpl */ ?>
<?php echo '
    <!--<script type="text/javascript" src="//siviaggiare//script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
'; ?>


<div class="content">
    <!--questa mi verra caricata quando si passerà un utente(quindi è passato da admin a utente)-->
    <?php if (( $this->_tpl_vars['utente']->username )): ?>
    <h3>UTENTE DEGRADATO</h3>
    <table>
        <tr>
            <td> Nome:</td><td><span id= 'nomeutente'><?php echo $this->_tpl_vars['utente']->username; ?>
</span> </td>
        </tr>
    </table>
    <?php endif; ?>

    <!--questa mi verra caricata quando si passerà un admin (quindi è passato da utente a admin)-->
    <?php if (( $this->_tpl_vars['admin']->username )): ?>
    <h3>UTENTE PROMOSSO</h3>
    <table>
       <tr>
           <td> Nome:</td><td><span id= 'nomeutente'><?php echo $this->_tpl_vars['admin']->username; ?>
</span> </td>
       </tr>
    </table>
    <?php endif; ?>

    <button id="redirect-utenti" class="redirect-utenti">Lista Utenti</button>
    </div>
</div>