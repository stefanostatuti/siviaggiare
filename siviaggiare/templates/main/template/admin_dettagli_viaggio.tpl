<div class=content>
    <div class=form_settings>
        <h3>Viaggio Segnalato</h3>
        <table>
            <tr>
                <td><h4>Autore:</h4></td>
                <td><h6>{$viaggio->utenteusername}</h6></td>
            </tr>
            <tr>
                <td><h4>Periodo</h4></td>
                <td>
                    <h6>Inizio: {$viaggio->datainizio} </h6>
                    <h6>Fine: {$viaggio->datafine} </h6>
                </td>
            </tr>
            <tr>
                <td> Mezzo di trasporto:</td>
                <td><h6>{$viaggio->mezzotrasporto}</h6></td>
            </tr>
            <tr>
                <td> Costo del trasporto:</td>
                <td><h6>{$viaggio->costotrasporto}</h6></td>
            </tr>
            <tr>
                <td> Budget:</td>
                <td><h6>{$viaggio->budget}<h6></td>
            </tr>
            <tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti&idviaggio={$viaggio->id}"<h5>Vedi i luoghi visitati(NON FUNZIONANTE)</h5></a></td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione"/>
            <input type="hidden" name="task" value="segnalazioni" />
            <input type="submit" value="Indietro" />
            <input type="submit" value="Modifica Viaggio" /><!--non funziona-->
            <input type="submit" value="Elimina Viaggio" /><!--non funziona-->
        </form>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione"/>
            <input type="hidden" name="task" value="mandaAvvertimento" />
            <input type="submit" value="Manda Avvertimento" />
        </form>
    </div>
</div>