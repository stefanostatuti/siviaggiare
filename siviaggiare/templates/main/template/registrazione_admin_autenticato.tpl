<div class="sidebar">
    <span id="logout_button">
        <p id="error">{$errore}</p>
        <h3 class="center">Benvenuto {$username}</h3>
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