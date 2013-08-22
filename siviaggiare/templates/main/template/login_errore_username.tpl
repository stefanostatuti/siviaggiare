<html>
<head>
    <title>YesYouTravel - Login Username Errato</title>

</head>
<body>

<form method="post" action="index.php">
    <p><input type="hidden" name="rememberme" value="0" /></p>
    <p><input type="hidden" name="controller" value="registrazione" /></p>
    <p><input type="hidden" name="task" value="autentica" /></p>

    <fieldset>
        <legend>Login Errato:</legend>
        <h4>username errato: Riprova</h4>
        <br>
        <table cellpadding="5">

            <tr>
                <td align="right"> Username: </td>
                <td> <input type="text" name="username" size=10 style="width:100px"/></td>
            </tr>

            <td align="right"> Password: </td>
            <td> <input type="password" name="password" size=5 style="width:100px"/> </td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend>Invio Dati:</legend>
        <table cellpadding="5">
            <tr>
                <input type="hidden" name="controller" value="registrazione" />
                <input type="hidden" name="task" value="autentica" />
                <td> <input type="submit" value="invia dati" /> </td>
                <td> <input type="reset" value = "reset" /> </td>
            </tr>
        </table>
    </fieldset>
</form>
    <form method="post" action="index.php">
        <fieldset>
            <legend>Torna alla Home:</legend>
            <tr>
                <input type="submit" value="Home" />
                <input type="hidden" name="controller" value="false" />
                <input type="hidden" name="task" value="false" />
            </tr>
        </fieldset>
    </form>

</body>
</html>
