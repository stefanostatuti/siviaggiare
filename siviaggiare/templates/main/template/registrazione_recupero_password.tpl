<div class="content">
    <div class="form_settings">
        <div id="password_dimenticata">
        <form method="post" action="index.php">
            <p class="error">{$errore}</p>
            <h3>Recupero Password:</h3>
            <h4>Inserisci l'username e la password con cui ti sei registrato</h4>
            <table>
                <tr>
                    <td> Username: </td>
                    <td> <input type="text" name="username"/></td>
                </tr>
                <tr>
                    <td> Email: </td>
                    <td> <input type="text" name="mail"/> </td>
                </tr>
            </table>
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="verifica_dati" />
            <input type="submit" class="submit" value="invia dati" />
        </form>
    </div>
</div>
</div>