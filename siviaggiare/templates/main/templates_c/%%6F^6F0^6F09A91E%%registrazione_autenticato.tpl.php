<?php /* Smarty version 2.6.26, created on 2013-09-02 16:24:29
         compiled from registrazione_autenticato.tpl */ ?>
<div class="sidebar">
    <span id="logout_button"">
        <p id="error"><?php echo $this->_tpl_vars['errore']; ?>
</p>
        <h3 class="center">Benvenuto <?php echo $this->_tpl_vars['username']; ?>
</h3>
        <form method="post" action="index.php">
            <input type="submit" name="submit" id="logout_button" class="submit" value="LOGOUT"  />
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="esci" />
        </form>
    </span>
</div>

<div class="sidebar">
    <h3>Menu</h3>
    <ul>
        <li><a href="?controller=aggiunta_viaggio&task=inserimento_viaggio">Inserisci nuovo viaggio</a></li>
        <li><a href="?controller=aggiunta_viaggio&task=visualizza_viaggi_inseriti">I tuoi viaggi</a></li>
        <li><a href="#">Le tue citt&agrave;</a></li>
        <li><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti">I tuoi luoghi</a></li>
    </ul>
</div>