<html>
<body>
<title>YesYouTravel - Visualizzazione Citta inserite(Table)</title>

<br>
altra prova
<b>Citta inseriti da te:</b>
<br><br>

<table cellpadding=1 cellspacing=0 border=2 width=60%>
    <tr bgcolor="#6495ed">
        <td><b>IdViaggio</b></td>
        <td><b>Nome Citta</b></td>
        <td><b>Stato</b></td>
        <td><b>Data Inizio</b></td>
        <td><b>Data Fine</b></td>
        <td><b></b></td>
    </tr>
    {section name=nr loop=$results}
        <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>
            <td>
                {$results[nr]->idviaggio}
            </td>
            <td>
                {$results[nr]->nome}
            </td>
            <td>
                {$results[nr]->stato}
            </td>
            <td>
                {$results[nr]->datainizio}
            </td>
            <td>
                {$results[nr]->datafine}
            </td>
            <td>
                <p><a href="?controller=aggiunta_viaggio&task=visualizza_citta&idviaggio={$results[nr]->idviaggio}&nomecitta={$results[nr]->nome}">Vedi citta</a></p>
            </td>
        </tr>

        {sectionelse}
        <tr>
            <td align="center">
                <b> nessun risultato </b>
            <td>
        </tr>
    {/section}

</table>

</body>
</html> 