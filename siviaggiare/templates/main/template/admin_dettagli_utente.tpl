<div class=content>
    <div class=form_settings>
        <h3>Dettagli Utente</h3>
        <h3>Utente: {$utente->username} </h3>
        <table>
            <tr>
                <td> Nome:</td><td>{$utente->username} </td>
            </tr>
            <tr>
                <td> Cognome:</td><td> {$utente->cognome} </td>
            </tr>
            <tr>
                <td>Residenza:</td><td> {$utente->residenza} </td>
            </tr>
            <tr>
                <td>Nazione:</td><td> {$utente->nazione} </td>
            </tr>
            <tr>
                <td>Mail:</td><td> {$utente->mail} </td>
            </tr>
            <tr>
                <td>Password:</td><td> {$utente->password} </td>
            </tr>
            <tr>
                <td>Codice attivazione:</td><td> {$utente->cod_attivazione} </td>
            </tr>
            <tr>
                <td>Numero Avvertimenti:</td><td> {$utente->avvertimenti} </td>
            </tr>
            <tr>
                <td>Stato:</td><td> {$utente->stato} </td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione" />
            <input type="hidden" name="task" value="gestione_utenti" />
            <input type="submit" value="Indietro" />
        </form>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione" />
            <input type="hidden" name="task" value="promuovi_utente"/>
            <input type="submit" value="Promuovi Utente"/>
        </form>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione" />
            <input type="hidden" name="task" value="modifica_utente"/>
            <input type="submit" value="Modifica Utente" /><!--non funziona-->
        </form>
        </form>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione" />
            <input type="hidden" name="task" value="elimina_utente"/>
            <input type="submit" value="Elimina Utente"/>
        </form>
    </div>
</div>