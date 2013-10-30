<div class="content" id="form_journey">
    <div class="form_settings">
        <h3>Viaggi inseriti da te:</h3>
        {if $results}
        <table id="form_journey">
            <tr>
                <td><h5>IdViaggio</h5></td>
                <td><h5>Utente</h5></td>
                <td><h5>Data Inizio</h5></td>
                <td><h5>Data Fine</h5></td>
                <td><h5></h5></td>
            </tr>
            {/if}
            {section name=nr loop=$results}
                <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>
                    <td>
                        {$results[nr]->id}
                    </td>
                    <td>
                        {$results[nr]->utenteusername}
                    </td>
                    <td>
                        {$results[nr]->datainizio}
                    </td>
                    <td>
                        {$results[nr]->datainizio}
                    </td>
                    <td>
                        <a href="?controller=aggiunta_viaggio&task=visualizza_viaggio&id={$results[nr]->id}">Vedi dettagli</a>
                    </td>
                </tr>
                {sectionelse}
                </table>
                        <h5> nessun risultato </h5>
                    <td>
                </tr>
            {/section}
        </table>
    </div>
</div>