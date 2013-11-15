<?php /* Smarty version 2.6.26, created on 2013-11-15 14:08:57
         compiled from registrazione_admin_autenticato.tpl */ ?>
<div class="sidebar">
    <span id="logout_button">
        <p id="error"><?php echo $this->_tpl_vars['errore']; ?>
</p>
        <h3 class="center">Benvenuto <?php echo $this->_tpl_vars['username']; ?>
</h3>
        <form method="post" action="index.php">
            <input type="submit" name="submit" id="logout_button" class="submit" value="LOGOUT"/>
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="esci" />
        </form>
    </span>
</div>

<div class="sidebar">
    <h3>Menu Amministratore</h3>
    <ul>

        <li><a href="?controller=amministrazione&task=segnalazioni">Segnalazioni Ricevute</a></li>
        <li><a href="?controller=amministrazione&task=gestione_utenti">Gestione Utenti</a></li>
        <li><a href="?controller=amministrazione&task=       ">Opzione 3</a></li>
    </ul>
</div>