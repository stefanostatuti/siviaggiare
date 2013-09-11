<html>
<head>
    <title>YesYouTravel - Visualizzazione Commento</title>

</head>
<body>
<fieldset>
<legend>Viaggio {$idviaggio} </legend>
<table cellpadding="5">

    <tr>
        <td> Nome: {$nomeluogo} </td>
    </tr>
    <tr>
        <td> Citt&agrave;: {$nomecitta} </td>
    </tr>
    <tr>
        <td> Testo: {$testo} </td>
    </tr>
    <tr>
        <td> Voto: {$voto} </td>
    </tr>
    </table>
    </fieldset>
<br>
<br>
    <table>
        <tr>
            <td>
                <form method="post"action="index.php">
                <input type="hidden" name="controller" value="aggiunta_viaggio" />
                <input type="hidden" name="task" value="visualizza_commenti_inseriti" />
                <input type="submit" value="Indietro" />
                </form>
            </td>
            <td></td>
            <td>
                <form method="post" action="index.php">
                <input type="submit" value="Home" />
                </form>
            </td>
        </tr>
    </table>
</body>
</html>