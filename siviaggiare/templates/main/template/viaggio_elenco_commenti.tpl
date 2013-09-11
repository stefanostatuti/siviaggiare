<div class="content">
    <div class="form_settings">
        <h3>Commenti inseriti da te:</h3>
        <table>
            <tr>
                <td><h5>IdCommento</h5></td>
                <td><h5>IdViaggio</h5></td>
                <td><h5>Nome Luogo</h5></td>
                <td><h5>Citta</h5></td>
                <td><h5>Autore</h5></td>
                <td><h5>Testo</h5></td>
                <td><h5>Voto</h5></td>
            </tr>
    {section name=nr loop=$results}
        <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>
            <td>
                {$results[nr]->idcommento}
            </td>
            <td>
                {$results[nr]->idviaggio}
            </td>
            <td>
                {$results[nr]->nomeluogo}
            </td>
            <td>
                {$results[nr]->nomecitta}
            </td>
            <td>
                {$results[nr]->autore}
            </td>
            <td>
                {$results[nr]->testo}
            </td>
            <td>
                {$results[nr]->voto}
            </td>
            <td>
                <p><a href="?controller=aggiunta_viaggio&task=visualizza_commento&idcommento={$results[nr]->idcommento}">Vedi commento</a></p>
            </td>
        </tr>
            {sectionelse}
                <tr>
                <td  class="center">
                    <h5> nessun risultato </h5>
                <td>
                </tr>
            {/section}
        </table>
    </div>
</div>
