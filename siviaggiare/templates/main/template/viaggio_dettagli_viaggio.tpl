<div class=content  id="form_journey">
    <div class=form_settings>
        <h3>Viaggio</h3>
        <table id="form_journey">
            <tr>
                <td>Autore:</td>
                <td><h6>{$viaggio->utenteusername}</h6></td>
            </tr>
            <tr>
                <td>Periodo</td>
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
                <td><h6>{$viaggio->costotrasporto} {$viaggio->valutatrasporto}</h6></td>
            </tr>
            <tr>
                <td> Budget:</td>
                <td><h6>{$viaggio->budget} {$viaggio->valutabudget}<h6></td>
            </tr>
            <tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_citta_inserite&idviaggio={$viaggio->id}"<h5>Vedi le citt&agrave; visitate</h5></a></td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="visualizza_viaggi_inseriti" />
            <input type="submit" class="submit" value="Indietro" id="j_submit" />
        </form>
        <div class="modifica"><a href="?controller=modifica&task=modifica_viaggio&idviaggio={$viaggio->id}">modifica</a></div>
        <br>
        <br>
        <div class="modifica"><a href="?controller=modifica&task=elimina_viaggio&idviaggio={$viaggio->id}">elimina</a></div>
    </div>
</div>