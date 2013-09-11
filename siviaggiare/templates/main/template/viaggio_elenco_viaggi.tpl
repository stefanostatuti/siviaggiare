<div class="content">
     <div class="form_settings">
        <h3>Viaggi inseriti da te:</h3>
            <table>
            <tr>
            <td><h5>IdViaggio</h5></td>
            <td><h5>Utente</h5></td>
                <td><h5>Data Inizio;</h5></td>
                <td><h5>Data Fine;</h5></td>
                <td><h5></h5></td>
            </tr>
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
                <tr>
                <td class="center">
                    <h5> nessun risultato </h5>
                <td>
                </tr>
            {/section}
            </table>
     </div>
</div>