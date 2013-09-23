<div class="content">
    <div class="form_settings">
        <h3>Dettaglio segnalazione {$segnalazione->idsegnalazione} di {$segnalazione->autore}:</h3>
        <table>
            <tr>
                <td><h4>IdSegnalazione</h4></td>
                <td><h6>{$segnalazione->idsegnalazione}</h6></td>
            </tr>
            <tr>
                <td><h4>Autore</h4></td>
                <td><h6>{$segnalazione->autore}</h6></td>
            </tr>
            <tr>
                <td><h4>Utente Segnalato</h4></td>
                <td><h6>{$segnalazione->segnalato}</h6></td>
            </tr>
            {if ($segnalazione->idviaggio) && !($segnalazione->citta)} <!-- verifica che non ci sia nome città-->
                <tr>
                    <td><h4>IdViaggio</h4></td>
                    <td><h6>{$segnalazione->idviaggio}</h6></td>
                </tr>
            {/if}
            {if ($segnalazione->citta)&& !($segnalazione->luogo)}<!-- verifica che non ci sia nome città-->
                <tr>
                    <td><h4>Citta (accoppiata Citta con IDVIAGGIO)</h4></td>

                        <td><h6>citta={$segnalazione->citta}</h6></td>
                        <td><h6>idviaggio={$segnalazione->idviaggio}</h6></td>
                </tr>
            {/if}
            {if ($segnalazione->idluogo)}
                <tr>
                    <td><h4>Luogo accoppiata Luogo con IDVIAGGIO e Citta</h4></td>
                    <table>
                        <td><h6>{$segnalazione->idviaggio}</h6></td>
                        <td><h6>{$segnalazione->citta}</h6></td>
                        <td><h6>{$segnalazione->luogo}</h6></td>
                    </table>
                </tr>
            {/if}
            {if ($segnalazione->idcommento)}
                <tr>
                <td><h4>IdCommento</h4></td>
                <td><h6>{$segnalazione->idcommento}</h6></td>
                <tr>
            {/if}
             <tr>
                <td><h4>Motivo segnalazione</h4></td>
                <td><h6>{$segnalazione->motivo}</h6></td>
             </tr>

             <tr>
                <td><h4>Dettagli (link alla segnalazione)</h4></td>

                <!-----qua metto il link a seconda del tipo di segnalazione-->
                    {if ($segnalazione->idviaggio) && !($segnalazione->citta)}
                    <td>
                        <a href="?controller=amministrazione&task=dettaglio_segnalazione_viaggio&idviaggio={$segnalazione->idviaggio}">Vedi dettagli</a>
                    </td>
                    {/if}
                    {if ($segnalazione->citta)&& !($segnalazione->luogo)}
                        <td>
                            <a href="?controller=amministrazione&task=dettaglio_segnalazione_citta&idviaggio={$segnalazione->idviaggio}&nomecitta={$segnalazione->citta}" >Vedi dettagli</a>
                        </td>
                    {/if}
                    {if ($segnalazione->luogo)}
                        <td>
                            <a href="?controller=amministrazione&task=dettaglio_segnalazione_luogo&idviaggio={$segnalazione->idviaggio}&nomecitta={$segnalazione->citta}&nome={$segnalazione->luogo}">Vedi dettagli</a>
                        </td>
                    {/if}
                    {if ($segnalazione->idcommento)}
                        <td>
                            <a href="?controller=amministrazione&task=dettaglio_segnalazione_commento&idcommento={$segnalazione->idcommento}">Vedi dettagli</a>
                        </td>
                    {/if}
                    <!-- ----------------------------FINE------------------------------------------>
                </tr>
        </table>
    </div>
</div>