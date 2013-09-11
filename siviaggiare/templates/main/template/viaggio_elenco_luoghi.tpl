<div class="content">
     <div class="form_settings">
        <h3>Luoghi inseriti da te:</h3>
            <table>
            <tr>
            <td><h5>IdViaggio</h5></td>
            <td><h5>Nome Luogo</h5></td>
                <td><h5>Citt&agrave;</h5></td>
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
                    {$results[nr]->nomecitta}
                </td>
                <td>
                <a href="?controller=aggiunta_viaggio&task=visualizza_luogo&idviaggio={$results[nr]->idviaggio}&nome={$results[nr]->nome}&nomecitta={$results[nr]->nomecitta}">Vedi luogo</a>
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