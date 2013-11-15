<script type="text/javascript" src="templates/main/template/js/admin.js"></script>

<div class="content">

    <div class="form_settings">

        <div id="administrator">

        <h3>Lista Utenti:</h3>
        {if ($utente)}
        <table id="administrator">
            <tr>
                <td><h5>Username</h5></td>
                <td><h5>Mail</h5></td>
                <td><h5>Cod_attivazione</h5></td>
                <td><h5>Stato</h5></td>
                <td><h5>Avvertimenti</h5></td>
                <td><h5>Dettagli (link al profilo)</h5></td>
            </tr>
            {section name=nr loop=$utente}
                <tr>

                    <td>
                        {$utente[nr]->username}
                    </td>
                    <td>
                        {$utente[nr]->mail}
                    </td>
                    <td>
                        {$utente[nr]->cod_attivazione}
                    </td>
                    <td>
                        {$utente[nr]->stato}
                    </td>
                    <td>
                        <span id='numeroavvertimenti'>{$utente[nr]->avvertimenti}</span>
                    </td>
                    <td>
                        <a href="?controller=amministrazione&task=dettaglio_utente&username={$utente[nr]->username}">Vedi dettagli</a>
                    </td>
                </tr>
            {/section}
        </table>
        {else}
        <td class="center">
            <h5> Nessun Utente !! c'è un errore :D</h5>
        <td>
            {/if}
    </div>
</div>
</div>