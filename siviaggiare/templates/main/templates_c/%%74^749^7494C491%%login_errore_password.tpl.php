<?php /* Smarty version 2.6.26, created on 2013-08-23 15:15:37
         compiled from login_errore_password.tpl */ ?>
<html>
<head>
    <title>YesYouTravel - Login Password Errato</title>

</head>
<body>

<form method="post" action="index.php">

    <fieldset>
        <legend>Login Errato:</legend>
        <h4>Password errata: Riprova</h4>
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