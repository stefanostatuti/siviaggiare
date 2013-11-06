{literal}
    <!--<script type="text/javascript" src="//siviaggiare//script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
{/literal}

<div class="content">
    <h3>Dettaglio segnalazione {$segnalazione->id} di {$segnalazione->autore}:</h3>
    <div class="form_settings">

        {if ($segnalazione->id)}
        <table>
            <tr>
                <td><h4>IdSegnalazione</h4></td>
                <td><h6><span id='idsegnalazione'>{$segnalazione->id}</span></h6></td>
            </tr>
            <tr>
                <td><h4>Autore</h4></td>
                <td><h6><!--{$segnalazione->autore}</h6>-->
                <a href="?controller=amministrazione&task=dettaglio_utente&username={$segnalazione->autore}">{$segnalazione->autore}</a></h6>
                </td>
            </tr>
            <tr>
                <td><h4>Utente Segnalato</h4></td>
                <td><h6>
                <a href="?controller=amministrazione&task=dettaglio_utente&username={$segnalazione->autore}">{$segnalazione->segnalato}</a></h6>
                </td>
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
                    <td><h4>Luogo accoppiata Luogo con IdViaggio e Citta</h4></td>
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

            <button id="elimina-segnalazione"  class="elimina-segnalazione" >Elimina Segnalazione</button>
        {/if}

        {if !($segnalazione->id)}
            <br>
            Segnalazione RIMOSSA!<br><br>
            <br>
            <br>
            <button id="redirect" class="redirect">Vai alla lista Segnalazioni</button>

        {/if}
    </div>
</div>