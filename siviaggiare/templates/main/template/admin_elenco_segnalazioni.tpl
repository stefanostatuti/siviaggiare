<script type="text/javascript" src="templates/main/template/js/admin.js"></script>
<div class="content">
    <div class="form_settings">
        <div id="administrator">
        <h3>Lista segnalazioni ricevute:</h3>
        {if ($results)}
            <table id="administrator">
                <tr>
                    <td><h5>Autore</h5></td>
                    <td><h5>Utente Segnalato</h5></td>
                    <td><h5>IdViaggio</h5></td>
                    <td><h5>Citta</h5></td>
                    <td><h5>Luogo</h5></td>
                    <td><h5>IdCommento</h5></td>
                    <td><h5>Dettagli (link alla segnalazione)</h5></td>
                </tr>
                {section name=nr loop=$results}
                    <tr>
                        <td>
                            {$results[nr]->autore}
                        </td>
                        <td>
                            {$results[nr]->segnalato}
                        </td>
                        <td>
                            {$results[nr]->idviaggio}
                        </td>
                        <td>
                            {$results[nr]->citta}
                        </td>
                        <td>
                            {$results[nr]->luogo}
                        </td>
                        <td>
                            {$results[nr]->idcommento}
                        </td>
                        <td>
                            <a href="?controller=amministrazione&task=dettaglio_segnalazione&id={$results[nr]->id}">Vedi dettagli</a>
                        </td>
                    </tr>
                {/section}
            </table>
            {else}
            <td class="center">
                <h5> nessuna Segnalazione Ricevuta </h5>
            <td>
                {/if}
        </div>

    </div>

</div>