<script type="text/javascript" src="templates/main/template/js/admin.js"></script>

<div class=content>

    <div class=form_settings>

    <div id="administrator">

    <h3>Citt&agrave; segnalata</h3>


        {if ($citta->idviaggio && $citta->nome)}
            <table id="administrator">
                <tr>
                    <td><h4>Idviaggio:</h4></td>
                    <td><h6><span id= 'idviaggio'>{$citta->idviaggio}<span></h6></td>
                </tr>
                <tr>
                    <td> Nome:</td>
                    <td><h6><span id= 'nomecitta'>{$citta->nome}</span></h6></td>
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
            </table>
            <button id="elimina-citta" class="elimina-citta" >Elimina Citta</button>
            <!--<button id="annulla" class="annulla" >Annulla Modifiche</button>-->
            <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
            <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
            <!--<button id="modifica" class="modifica">Modifica Citta</button>-->
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
</div>