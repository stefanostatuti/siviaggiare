<div class="sidebar">
    <span class="login_form">
        <p class="error">{$errore}</p>
        <form method="post" action="index.php">
            <h3>Login</h3>
            <h4>Nome utente:</h4>
            <input type="text" name="username" id="username" tabindex="1"value="" />
            <h4>Password:</h4>
            <input type="password" name="password" id="password" tabindex="2" class="field" value="" />
            <input type="submit" name="submit" class="submit" value="LOGIN"  />
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="autentica" />
            <br>
            <a href="?controller=registrazione&task=recupera_password" id="forgotpsswd">Password dimenticata?</a>
        </form>
    </span>
</div>