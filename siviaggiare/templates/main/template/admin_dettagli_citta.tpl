<div class=content>
    <div class=form_settings>
        <h3>Citt&agrave; segnalata</h3>
        <table>
            <tr>
                <td><h4>Idviaggio:</h4></td>
                <td><h6>{$citta->idviaggio}</h6></td>
            </tr>
            <tr>
                <td> Nome:</td>
                <td><h6>{$citta->nome}</h6></td>
            </tr>
            <tr>
                <td> Stato:</td>
                <td><h6>{$citta->stato}</h6></td>
            </tr>
            <tr>
                <td><h4>Periodo</h4></td>
                <td>
                    <h6>Inizio: {$citta->datainizio} </h6>
                    <h6>Fine: {$citta->datafine} </h6>
                </td>
            </tr>
            <tr>
                <td> Tipo di alloggio:</td>
                <td><h6>{$citta->tipoalloggio}</h6></td>
            </tr>
            <tr>
                <td> Costo dell' alloggio:</td>
                <td><h6>{$citta->costoalloggio}</h6></td>
            </tr>
            <tr>
                <td> Voto: </td>
                <td><h6>{$citta->voto}</h6></td>
            </tr>
            <tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti&idviaggio={$citta->idviaggio}"<h5>Vedi i luoghi visitati(NON FUNZIONANTE)</h5></a></td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione" />
            <input type="hidden" name="task" value="segnalazioni" />
            <input type="submit" value="Indietro" />
            <input type="submit" value="Modifica Citta" /><!--non funziona-->
            <input type="submit" value="Elimina Citta" /><!--non funziona-->
        </form>
    </div>
</div>