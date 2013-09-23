<div class="content">
    <div class="form_settings">
        <h3>Lista Utenti:</h3>
        {if ($utente)}
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css" />
        {literal}
                <script>
                $(function() {
                    var availableTags = [
                        "ActionScript",
                        "AppleScript",
                        "Asp",
                        "BASIC",
                        "C",
                        "C++",
                        "Clojure",
                        "COBOL",
                        "ColdFusion",
                        "Erlang",
                        "Fortran",
                        "Groovy",
                        "Haskell",
                        "Java",
                        "JavaScript",
                        "Lisp",
                        "Perl",
                        "PHP",
                        "Python",
                        "Ruby",
                        "Scala",
                        "Scheme"
                    ];
                    $( "#tags" ).autocomplete({
                        source: availableTags
                    });
                });
            </script>
        {/literal}
        <div class="ui-widget">
            <label for="tags">Ricerca Utente DA FINIRE: </label>
            <input id="tags" />
        </div>

        <table>
            <tr>
                <td><h5>Username</h5></td>
                <!--<td><h5>Nome</h5></td>-->
                <!--<td><h5>Cognome</h5></td>-->
                <!--<td><h5>Residenza</h5></td>-->
                <!--<td><h5>Nazione</h5></td>-->
                <td><h5>Mail</h5></td>
                <!--<td><h5>Password</h5></td>-->
                <td><h5>Cod_attivazione</h5></td>
                <td><h5>Stato</h5></td>
                <td><h5>Dettagli (link al profilo)</h5></td>
            </tr>
            {section name=nr loop=$utente}
                <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>

                    <td>
                        {$utente[nr]->username}
                    </td>
                    <!--
                    <td>
                        {$utente[nr]->nome}
                    </td>
                    -->
                    <!--
                    <td>
                        {$utente[nr]->cognome}
                    </td>
                    -->
                    <!--
                    <td>
                        {$utente[nr]->residenza}
                    </td>
                    -->
                    <!--
                    <td>
                        {$utente[nr]->nazione}
                    </td>
                    -->
                    <td>
                        {$utente[nr]->mail}
                    </td>
                    <!--
                    <td>
                        {$utente[nr]->password}
                    </td>
                    -->
                    <td>
                        {$utente[nr]->cod_attivazione}
                    </td>
                    <td>
                        {$utente[nr]->stato}
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