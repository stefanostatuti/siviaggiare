<div class="content" id="form_journey">
    <div class="form_settings">
        <h3>Citta inserite:</h3>
        {if $results}
            <table id="form_journey">
            <tr>
                <td><h5>Nome Citta</h5></td>
                <td><h5>Stato</h5></td>
                <td><h5>Data Inizio</h5></td>
                <td><h5>Data Fine</h5></td>
                <td><h5></h5></td>
            </tr>
            {/if}
            {section name=nr loop=$results}
                <tr>
                    <td>
                        {$results[nr]->nome}
                    </td>
                    <td>
                        {$results[nr]->stato}
                    </td>
                    <td>
                        {$results[nr]->datainizio}
                    </td>
                    <td>
                        {$results[nr]->datafine}
                    </td>
                    <td>
                        <p><a href="?controller=aggiunta_viaggio&task=visualizza_citta&idviaggio={$results[nr]->idviaggio}&nome={$results[nr]->nome}">Vedi dettagli</a></p>
                    </td>
                </tr>
                {sectionelse}
                </table>
                        <h5> nessun risultato </h5>
            {/section}
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="visualizza_viaggio" />
            <input type="hidden" name="idviaggio" value="{$idviaggio}"/>
            <input type="submit" class="submit" value="Indietro" id="j_submit" />
        </form>
    </div>
</div>