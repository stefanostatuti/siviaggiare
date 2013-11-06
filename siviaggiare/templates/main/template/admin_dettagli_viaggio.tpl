{literal}
    <!--<script type="text/javascript" src="//siviaggiare//script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
{/literal}

<div class=content>
    <h3>Viaggio Segnalato</h3>
    <div class=form_settings>

        {if ($viaggio->id)}
        <table>
            <tr>
                <td><h4>IdViaggio:</h4></td>
                <td><h6>
                <span id='idviaggio'>{$viaggio->id}</span></h6></td>
            </tr>
            <tr>
                <td><h4>Autore:</h4></td>
                <td><h6>
                <a href="?controller=amministrazione&task=dettaglio_utente&username={$viaggio->utenteusername}">{$viaggio->utenteusername}</a></h6></td>
            </tr>
            <tr>
                <td><h4>Periodo</h4></td>
                <td>
                    <h6>Inizio: {$viaggio->datainizio} </h6>
                    <h6>Fine: {$viaggio->datafine} </h6>
                </td>
            </tr>
            <tr>
                <td> Mezzo di trasporto:</td>
                <td><h6>{$viaggio->mezzotrasporto}</h6></td>
            </tr>
            <tr>
                <td> Costo del trasporto:</td>
                <td><h6>{$viaggio->costotrasporto}</h6></td>
            </tr>
            <tr>
                <td> Budget:</td>
                <td><h6>{$viaggio->budget}</h6></td>
            </tr>
        </table>

    <button id="elimina-viaggio" class="elimina-viaggio" >Elimina Viaggio</button>
    <button id="annulla" class="annulla" >Annulla Modifiche</button>
    <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
    <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
    <button id="modifica" class="modifica">Modifica Viaggio</button>
    {/if}


    {if !($viaggio->id)}
        <br>
        Viaggio GIA RIMOSSO!<br><br>
        consiglio di eliminare la segnalazione
        <br>
        <br>
        <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>

    {/if}
</div>
</div>