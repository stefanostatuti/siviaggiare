{literal}
    <!--<script type="text/javascript" src="//siviaggiare//script//jquery-2.0.3.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="script/admin.js"></script>
{/literal}

<div class="content">
    <h3>Dettagli Utente</h3>
    <div class=form_settings>

        {if ($utente->username)}
        <!--<h3>Utente: {$utente->username}</h3>-->
        <table>
            <tr>
                <td> Nome:</td><td><span id= 'nomeutente'>{$utente->username}</span> </td>
            </tr>
            <tr>
                <td> Cognome:</td><td> {$utente->cognome} </td>
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
                <td>Stato:</td><td> {$utente->stato} </td>
            </tr>
        </table>
        <button id="elimina-utente" class="elimina-utente" >Elimina Utente</button>
        <button id="annulla" class="annulla">Annulla Modifiche</button>
        <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
        <button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>
        <button id="modifica" class="modifica">Modifica Utente</button>
        {/if}



        {if !($utente->username)}
            <br>
            Utente GIA RIMOSSO!<br><br>
            <br>
            <br>
            <button id="redirect-utenti" class="redirect-utenti">Lista Utenti</button>

        {/if}
    </div>
    <!--<form method="post"action="index.php" class="left">
        <input type="hidden" name="controller" value="amministrazione" />
        <input type="hidden" name="task" value="gestione_utenti" />
        <input type="submit" value="Indietro" />
    </form>

    <button id="elimina-utente"  class="elimina-utente" >Elimina Utente</button>
    <button id="annulla" class="annulla" >Annulla Modifiche</button>
    <button id="avvertimento" class="avvertimento">Manda Avvertimento</button>
    <button id="salva-modifiche" class="salva-modifiche">Salva Modifiche</button>
    <button id="modifica" class="modifica">Modifica Utente</button>
    -->
</div>