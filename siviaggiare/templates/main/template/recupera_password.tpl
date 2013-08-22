<html>
<head>
    <title>YesYouTravel - Recupero Password</title>

</head>
<body>

<form method="post" action="index.php">

    <fieldset>
        <legend>Recupero Password:</legend>
        <h4>Inserisci l'username e la password con cui ti sei registrato</h4>
            <br>
            <table cellpadding="5">

                <tr>
                    <td align="right"> Username: </td>
                    <td> <input type="text" name="username" size=10 style="width:100px"/></td>
                </tr>

                    <td align="right"> Email: </td>
                    <td> <input type="text" name="mail" size=5 style="width:100px"/> </td>
                </tr>
            </table>
    </fieldset>

    <fieldset>
            <legend>Invio Dati:</legend>
            <table cellpadding="5">
                <tr>
                    <input type="hidden" name="controller" value="registrazione" />
                    <input type="hidden" name="task" value="verifica_dati" />
                    <td> <input type="submit" value="invia dati" /> </td>
                    <td> <input type="reset" value = "reset" /> </td>
                </tr>
            </table>
    </fieldset>
</form>

<p><a href="?controller=false&task=false">Torna alla Home</a></p>

</body>
</html>
