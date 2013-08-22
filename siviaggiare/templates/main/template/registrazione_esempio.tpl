<html>
<head>
    <title>Registrazione YesYouTravel</title>

</head>
<body>

<form method="post"
      action="index.php">

    <fieldset>
        <legend>Form:</legend>

        <fieldset>
            <legend>Dati Personali:</legend>
            <table cellpadding="5">

                <tr>
                    <td align="right"> Username: </td>
                    <td> <input type="text" name="username" size=10 style="width:100px"/></td>
                </tr>
                <tr>
                    <td align="right"> Cognome: </td>
                    <td> <input type="text" name="cognome" size=10 style="width:100px"/></td>
                </tr>
                <tr>
                    <td align="right"> Nome: </td>
                    <td> <input type="text" name="nome" size=10 style="width:100px"/> </td>
                </tr>
                <tr>
                    <td align="right"> Citt&agrave: </td>
                    <td> <input type="text" name="residenza" size=5 style="width:100px"/> </td>
                </tr>
                <tr>
                    <td align="right"> Nazione: </td>
                    <td> <input type="text" name="nazione" size=5 style="width:100px"/> </td>
                </tr>
                <tr>
                    <td align="right"> Email: </td>
                    <td> <input type="text" name="mail" size=5 style="width:100px"/> </td>
                </tr>
                <tr>
                    <td align="right"> Password: </td>
                    <td> <input type="password" name="password" size=5 style="width:100px"/> </td>
                </tr>
                <tr>
                    <td align="right"> Conferma Password: </td>
                    <td> <input type="password" name="password_1" size=5 style="width:100px"/> </td>
                </tr>

            </table>
        </fieldset>
        <fieldset>
            <legend>Invio Dati:</legend>
            <table cellpadding="5">
                <tr>
                    <input type="hidden" name="controller" value="registrazione" />
                    <input type="hidden" name="task" value="salva" />
                    <td> <input type="submit" value="invia dati" /> </td>
                    <td> <input type="reset" value = "reset" /> </td>
                </tr>

            </table>
        </fieldset>

</body>
</html>
