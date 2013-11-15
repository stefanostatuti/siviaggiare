<script type="text/javascript" src="templates/main/template/js/admin.js"></script>

<div class="content" >
    <div id="administrator">
    <!--questa mi verra caricata quando si passerà un utente(quindi è passato da admin a utente)-->
    {if ($utente->username)}
    <h3>UTENTE DEGRADATO</h3>
    <table id="administrator">
        <tr>
            <td> Nome:</td><td><span id= 'nomeutente'>{$utente->username}</span> </td>
        </tr>
    </table>
    {/if}

    <!--questa mi verra caricata quando si passerà un admin (quindi è passato da utente a admin)-->
    {if ($admin->username)}
    <h3>UTENTE PROMOSSO</h3>
    <table>
       <tr>
           <td> Nome:</td><td><span id= 'nomeutente'>{$admin->username}</span> </td>
       </tr>
    </table>
    {/if}

    <button id="redirect-utenti" class="redirect-utenti">Lista Utenti</button>
    </div>
</div>