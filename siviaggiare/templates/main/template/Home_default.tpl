<html>

<head>
    <title>YesYouTravel - Home</title>
</head>

<body>
<h1>Benvenuto index</h1>
<br>
<a id="anchor-login-4"></a>
    <div class="loginform">
        <p id="error">{$errore}</p>
        <br />
        <form method="post" action="index.php">
            <p><input type="hidden" name="rememberme" value="0" /></p>
            <p><input type="hidden" name="controller" value="registrazione" /></p>
            <p><input type="hidden" name="task" value="autentica" /></p>
            <fieldset>
                <h1 class="login">Login</h1>
                <p><label for="username" class="top">Nome utente:</label><br />
                    <input type="text" name="username" id="username" tabindex="1" class="field" value="" /></p>
                <p><label for="password" class="top">Password:</label><br />
                    <input type="password" name="password" id="password" tabindex="2" class="field" value="" /></p>
                <p><input type="checkbox" name="checkbox" id="checkbox" class="checkbox" tabindex="3" size="1" value="" /><label for="checkbox" class="right">Ricordati?</label></p>
                <p><input type="submit" name="cmdweblogin" class="button" value="LOGIN"  /></p>
                <p><a href="?controller=registrazione&task=recupera_password" id="forgotpsswd">Password dimenticata?</a></p>
            </fieldset>
    </div>
</div>
<div class="corner-subcontent-bottom"></div>
</form>

<form method="post"
      action="index.php">
    <fieldset>

        <tr>
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="registra" />
            <input type="submit" value="Registrami" />
        </tr>
    </fieldset>
</form>

</body>
</html>