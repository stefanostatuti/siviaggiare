{literal}
    <!--<script type="text/javascript" src="script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
{/literal}

<div class=content>
    <h3>luogo segnalato</h3>
    <div class=form_settings>


        {if ($luogo->idviaggio && $luogo->nome && $luogo->nomecitta)}
        <table>

            <tr>
                <td><h3>IDViaggio:</h3></td><td><span id='idviaggio'>{$luogo->idviaggio}</span></td>
            </tr>

            <tr>
                <td> Nome:</td><td><span id= 'nomeluogo'>{$luogo->nome}<span> </td>
            </tr>
            <tr>
                <td> Citt&agrave;:</td><td><span id= 'nomecitta'>{$luogo->nomecitta}<span></td>
            </tr>
            <tr>
                <td> Sito Web:</td><td> {$luogo->sitoweb} </td>
            </tr>
            <tr>
                <td> Percorso:</td><td> {$luogo->percorso} </td>
            </tr>
            <tr>
                <td> Costo del Biglietto:</td><td> {$luogo->costobiglietto} </td>
            </tr>
            <tr>
                <td> Guida Turistica:</td><td> {$luogo->guida} </td>
            </tr>
            <tr>
                <td> Coda:</td><td> {$luogo->coda} </td>
            </tr>
            <tr>
                <td> Durata Visita:</td><td> {$luogo->durata} </td>
            </tr>
            <tr>
                <td> Commento Personale:</td><td> {$luogo->commentolibero} </td>
            </tr>
        </table>

        <button id="elimina-luogo" class="elimina-luogo" >Elimina Luogo</button>
        <button id="annulla" class="annulla" >Annulla Modifiche</button>
        <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
        <!--<button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>-->
        <button id="modifica" class="modifica">Modifica Luogo</button>
        {/if}

        {if !($luogo->idviaggio && $luogo->nome && $luogo->nomecitta)}
            <br>
            Luogo GIA RIMOSSO!<br><br>
            consiglio di eliminare la segnalazione
            <br>
            <br>
            <button id="redirect-segnalazione" class="redirect-segnalazione">Vai alla Segnalazione</button>
        {/if}
    </div>
</div>