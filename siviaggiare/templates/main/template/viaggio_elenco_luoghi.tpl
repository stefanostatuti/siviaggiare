<div class="content" id="form_journey">
     <div class="form_settings">
        <h3>Luoghi inseriti:</h3>
         {if $results}
            <table id="form_journey">
            <tr>
            <td><h5>Nome Luogo</h5></td>
                <td><h5>Citt&agrave;</h5></td>
                <td><h5></h5></td>
            </tr>
                {/if}
            {section name=nr loop=$results}
            <tr>
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
         <form method="post"action="index.php" class="left">
             <input type="hidden" name="controller" value="aggiunta_viaggio" />
             <input type="hidden" name="task" value="visualizza_citta" />
             <input type="hidden" name="idviaggio" value="{$idviaggio}"/>
             <input type="hidden" name="nomecitta" value="{$nomecitta}"/>
             <input type="submit" class="submit" value="Indietro" id="j_submit"/>
         </form>
     </div>
</div>