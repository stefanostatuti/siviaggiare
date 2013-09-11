<html>
<body>
<title>YesYouTravel - Visualizzazione Commenti inseriti(Table)</title>

<br>


<b>DA SISTEMARE I CSS!!!!!!!!!!!!!!!<b/>
<b>Commenti inseriti da te:</b>
<br><br>

<table cellpadding=1 cellspacing=0 border=2 width=60%>
    <tr bgcolor="#6495ed">
        <td><b>IdCommento</b></td>
        <td><b>IdViaggio</b></td>
        <td><b>Nome Luogo</b></td>
        <td><b>Citta</b></td>
        <td><b>Autore</b></td>
        <td><b>Testo</b></td>
        <td><b>Voto</b></td>
    </tr>
    {section name=nr loop=$results}
        <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>
            <td>
                {$results[nr]->idcommento}
            </td>
            <td>
                {$results[nr]->idviaggio}
            </td>
            <td>
                {$results[nr]->nomeluogo}
            </td>
            <td>
                {$results[nr]->nomecitta}
            </td>
            <td>
                {$results[nr]->autore}
            </td>
            <td>
                {$results[nr]->testo}
            </td>
            <td>
                {$results[nr]->voto}
            </td>
            <td>
                <p><a href="?controller=aggiunta_viaggio&task=visualizza_commento&idcommento={$results[nr]->idcommento}">Vedi commento</a></p>
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