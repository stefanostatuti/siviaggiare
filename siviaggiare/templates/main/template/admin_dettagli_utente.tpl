<script type="text/javascript" src="templates/main/template/js/admin.js"></script>


<div class="content" id="danascondere">

    <div class=form_settings>

        <div id="administrator">

        <h3>Dettagli Utente</h3>

        {if ($utente->username)}
        <!--<h3>Utente: {$utente->username}</h3>-->
            <table id="administrator">
                <tr>
                    <td>Username:</td><td><span id= 'nomeutente'>{$utente->username}</span> </td>
                </tr>
                <tr>
                    <td>Nome:</td><td> {$utente->nome}</td>
                </tr>
                <tr>
                    <td>Cognome:</td><td> {$utente->cognome} </td>
                </tr>
                <tr>
                    <td>Residenza:</td><td> {$utente->residenza} </td>
                </tr>
                <tr>
                    <td>Nazione:</td><td> {$utente->nazione} </td>
                </tr>
                <tr>
                    <td>Mail:</td><td> {$utente->mail} </td>
                </tr>
                <tr>
                    <td>Password:</td><td> {$utente->password} </td>
                </tr>
                <tr>
                    <td>Codice attivazione:</td><td> {$utente->cod_attivazione} </td>
                </tr>
                <tr>
                    <td>Numero Avvertimenti:</td><td><span id='numeroavvertimenti'>{$utente->avvertimenti}</span> </td>
                </tr>
                <tr>
                    <td>Stato:</td><td><span id='stato'>{$utente->stato}</span></td>
                </tr>
            </table>
            <button id="elimina-utente" class="elimina-utente" >Elimina Utente</button>
            <button id="annulla" class="annulla">Annulla Modifiche</button>
            <button id="gestisci-utente" class="gestisci-utente">Gestisci Utente</button>
            <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
            <button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>
            <button id="modifica" class="modifica">Modifica Utente</button>
        {/if}



            {if !($utente->username)}
                <br>
                Utente <b>RIMOSSO</b> con successo!<br><br>
                <br>
                <br>
                <button id="redirect-utenti" class="redirect-utenti">Lista Utenti</button>

            {/if}
        </div>
    </div>
</div>