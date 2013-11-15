<script type="text/javascript" src="templates/main/template/js/admin.js"></script>

<div class=content>
    <div class=form_settings>
        <div id="administrator">
        risultato cancellazione {$cancellato}
        utente eliminato
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione" />
            <input type="hidden" name="task" value="gestione_utenti" />
            <input type="submit" value="Indietro" />
        </form>
    </div>
</div>