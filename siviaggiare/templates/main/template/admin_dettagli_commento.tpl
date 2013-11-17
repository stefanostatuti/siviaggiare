<script type="text/javascript" src="templates/main/template/js/admin.js"></script>

<div class=content>

    <div class=form_settings>

    <div id="administrator">

    <h3>Dettagli commento segnalato:</h3>
        <!--<div class=form_settings>-->

            {if ($commento->id)}

                <table id="administrator">
                    <tr>
                        <td> ID del Commento </td><td><span id= 'idcommento'>{$commento->id}</span></td>
                    </tr>
                    <tr>
                        <td> ID del Viaggio </td><td>{$commento->idviaggio}</td>
                    </tr>
                    <tr>
                        <td> Autore del messaggio:</td><td> {$commento->autore} </td>
                    </tr>
                    <tr>
                        <td> Nome Luogo:</td><td> {$commento->nomeluogo} </td>
                    </tr>
                    <tr>
                        <td> Nome Citt&agrave;:</td><td> {$commento->nomecitta} </td>
                    </tr>
                    <tr>
                        <td> Testo:</td><td> {$commento->testo} </td>
                    </tr>
                    <tr>
                        <td> Voto:</td><td> {$commento->voto} </td>
                    </tr>
                </table>
                <button id="elimina-commento" class="elimina-commento" >Elimina Commento</button>
                <!--<button id="annulla" class="annulla" >Annulla Modifiche</button>-->
                <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
                <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
                <!--<button id="modifica" class="modifica">Modifica Commento</button>-->
            {/if}


            {if !($commento->id)}
                <br>
                Commento RIMOSSO!<br><br>
                Consiglio di eliminare la segnalazione
                <br>
                <br>
                <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>
            {/if}
        </div>
    </div>
 </div>