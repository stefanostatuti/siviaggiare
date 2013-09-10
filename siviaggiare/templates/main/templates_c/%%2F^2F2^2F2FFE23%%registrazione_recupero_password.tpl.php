<?php /* Smarty version 2.6.26, created on 2013-09-09 17:57:43
         compiled from registrazione_recupero_password.tpl */ ?>
<div class="content">
    <div class="form_settings">
        <form method="post" action="index.php">
            <p class="error"><?php echo $this->_tpl_vars['errore']; ?>
</p>
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