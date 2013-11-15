<?php /* Smarty version 2.6.26, created on 2013-11-15 11:38:35
         compiled from admin_dettagli_utente_promosso_degradato.tpl */ ?>
<script type="text/javascript" src="templates/main/template/js/admin.js"></script>
<div class="content" id="administrator">
    <!--questa mi verra caricata quando si passerà un utente(quindi è passato da admin a utente)-->
    <?php if (( $this->_tpl_vars['utente']->username )): ?>
    <h3>UTENTE DEGRADATO</h3>
    <table id="administrator">
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