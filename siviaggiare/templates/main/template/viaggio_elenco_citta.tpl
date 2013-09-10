<div class="content">
    <div class="form_settings">
        <h3>Citta inserite da te:</h3>
        <table>
            <tr>
                <td><h5>IdViaggio</h5></td>
                <td><h5>Nome Citta</h5></td>
                <td><h5>Stato</h5></td>
                <td><h5>Data Inizio</h5></td>
                <td><h5>Data Fine</h5></td>
                <td><h5></h5></td>
            </tr>
            {section name=nr loop=$results}
                <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>
                    <td>
                        {$results[nr]->idviaggio}
                    </td>
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
                        <a href="?controller=aggiunta_viaggio&task=visualizza_citta&idviaggio={$results[nr]->idviaggio}&nome={$results[nr]->nome}">Vedi dettagli</a>
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