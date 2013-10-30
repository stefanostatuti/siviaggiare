<div class=content id="form_journey">
    <div class=form_settings>
        <h3>Citt&agrave;</h3>
        <table id="form_journey">
            <tr>
                <td>Idviaggio:</td>
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
                <td>Periodo</td>
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
                <td><h6>{$citta->costoalloggio} {$citta->valuta} </h6></td>
            </tr>
            <tr>
                <td> Voto: </td>
                <td><h6>{$citta->voto}</h6></td>
            </tr>
            <tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti&idviaggio={$citta->idviaggio}&nomecitta={$citta->nome}"<h5>Vedi i luoghi visitati</h5></a></td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="visualizza_citta_inserite" />
            <input type="hidden" name="idviaggio" value="{$citta->idviaggio}" />
            <input type="submit" class="submit" value="Indietro"  id="j_submit"/>
        </form>
        <div class="modifica"><a href="?controller=modifica&task=modifica_citta&idviaggio={$citta->idviaggio}&nomecitta={$citta->nome}">modifica</a></div>
        <br>
        <br>
        <div class="modifica"><a href="?controller=modifica&task=elimina_citta&idviaggio={$citta->idviaggio}&nomecitta={$citta->nome}">elimina</a></div>
    </div>
</div>