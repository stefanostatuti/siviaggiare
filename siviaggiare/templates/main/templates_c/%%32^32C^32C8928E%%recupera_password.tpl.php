<?php /* Smarty version 2.6.26, created on 2013-09-02 11:01:08
         compiled from registrazione_recupero_password.tpl */ ?>
<div class="content">
    <form method="post" action="index.php">
    <h3>Recupero Password:</h3>
    <h4>Inserisci l'username e la password con cui ti sei registrato</h4>
        <table>

            <tr>
                <td align="right"> Username: </td>
                <td> <input type="text" name="username"/></td>
            </tr>

            <td align="right"> Email: </td>
            <td> <input type="text" name="mail"/> </td>
            </tr>
        </table>
        <input type="hidden" name="controller" value="registrazione" />
        <input type="hidden" name="task" value="verifica_dati" />
        <input type="submit" value="Invio" />
        </form>
</div>