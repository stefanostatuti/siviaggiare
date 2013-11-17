<script type="text/javascript" src="templates/main/template/js/admin.js"></script>
<div class=content >

    <div class=form_settings>

    <div id="administrator">

    <h3>Viaggio Segnalato</h3>


        {if ($viaggio->id)}
            <table id="administrator">
                <tr>
                    <td><h4>IdViaggio:</h4></td>
                    <td><h6><span id= 'idviaggio'>{$viaggio->id}</span></h6></td>
                </tr>
                <tr>
                    <td><h4>Autore:</h4></td>
                    <td><h6>{$viaggio->utenteusername}</h6></td>
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
                <!--<tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_luoghi_inseriti&idviaggio={$viaggio->id}"<h5>Vedi i luoghi visitati(NON FUNZIONANTE)</h5></a></td>
            </tr>
            -->
            </table>

            <button id="elimina-viaggio" class="elimina-viaggio" >Elimina Viaggio</button>
            <!--<button id="annulla" class="annulla" >Annulla Modifiche</button>-->
            <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
            <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
            <!--<button id="modifica" class="modifica">Modifica Viaggio</button>-->
        {/if}


        {if !($viaggio->id)}
            <br>
            Viaggio RIMOSSO!<br><br>
            Consiglio di eliminare la segnalazione
            <br>
            <br>
            <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>
        {/if}
    </div>
    </div>
 </div>