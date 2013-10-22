{literal}
    <!--<script type="text/javascript" src="//siviaggiare//script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
{/literal}

<div class=content>
    <h3>Citt&agrave; segnalata</h3>
    <div class=form_settings>

        {if ($citta->idviaggio && $citta->nome)}
        <table>
            <tr>
                <td><h4>Idviaggio:</h4></td>
                <td><h6><span id= 'idviaggio'>{$citta->idviaggio}<span></h6></td>
            </tr>
            <tr>
                <td> Nome:</td>
                <td><h4><span id= 'nomecitta'>{$citta->nome}</span></h4></td>
            </tr>
            <tr>
                <td> Stato:</td>
                <td><h6>{$citta->stato}</h6></td>
            </tr>
            <tr>
                <td><h4>Periodo</h4></td>
                <td>
                    <h6>Inizio: {$citta->datainizio} </h6>
                    <h6>Fine: {$citta->datafine} </h6>
                </td>
            </tr>
            <tr>
                <td> Tipo di alloggio:</td>
                <td><h6>{$citta->tipoalloggio}</h6></td>
            </tr>
            <tr>
                <td> Costo dell' alloggio:</td>
                <td><h6>{$citta->costoalloggio}</h6></td>
            </tr>
            <tr>
                <td> Voto: </td>
                <td><h6>{$citta->voto}</h6></td>
            </tr>
            <tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti&idviaggio={$citta->idviaggio}"<h5>Vedi i luoghi visitati(NON FUNZIONANTE)</h5></a></td>
            </tr>
        </table>
        <button id="elimina-citta" class="elimina-citta" >Elimina Citta</button>
        <button id="annulla" class="annulla" >Annulla Modifiche</button>
        <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
        <button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>
        <button id="modifica" class="modifica">Modifica Citta</button>
        {/if}

        {if !($citta->idviaggio && $citta->nome)}
            <br>
            Citta GIA RIMOSSA!<br><br>
            consiglio di eliminare la segnalazione
            <br>
            <br>
            <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>
        {/if}
    </div>
</div>