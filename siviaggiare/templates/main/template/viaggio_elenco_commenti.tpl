<div class="content" id="form_journey">
    <div class="form_settings">
        <h3>Commenti inseriti:</h3>
        {if $results}
        <table id="form_journey">
            <tr>
                <td><h5>IdCommento</h5></td>
                <td><h5>IdViaggio</h5></td>
                <td><h5>Nome Luogo</h5></td>
                <td><h5>Citta</h5></td>
                <td><h5>Autore</h5></td>
                <td><h5>Voto</h5></td>
            </tr>
            {/if}
    {section name=nr loop=$results}
        <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>
            <td>
                {$results[nr]->id}
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
                {$results[nr]->voto}
            </td>
            <td>
                <p><a href="?controller=aggiunta_viaggio&task=visualizza_commento&idcommento={$results[nr]->id}">Vedi commento</a></p>
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
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="visualizza_luogo" />
            <input type="hidden" name="idviaggio" value="{$idviaggio}"/>
            <input type="hidden" name="nomecitta" value="{$nomecitta}"/>
            <input type="hidden" name="nomeluogo" value="{$nomeluogo}"/>
            <input type="submit" class="submit" value="Indietro" id="j_submit" />
        </form>
        </table>
    </div>
</div>