<?php /* Smarty version 2.6.26, created on 2013-08-30 17:13:49
         compiled from registrazione_modulo.tpl */ ?>
<div class="content">
    <div class="form_settings">
        <p id="error"><?php echo $this->_tpl_vars['errore']; ?>
</p>
        <legend><h4>Inserisci i seguenti dati:</h4></legend>
            <table>
                <form method="post" action="index.php">
                <tr>
                    <td> Username: </td>
                    <td> <input type="text" name="username"/></td>
                </tr>
                <tr>
                    <td> Cognome: </td>
                    <td> <input type="text" name="cognome"/></td>
                </tr>
                <tr>
                    <td > Nome: </td>
                    <td> <input type="text" name="nome"/> </td>
                </tr>
                <tr>
                    <td> Citt&agrave: </td>
                    <td> <input type="text" name="residenza"/> </td>
                </tr>
                <tr>
                    <td> Nazione: </td>
                    <td> <input type="text" name="nazione"/> </td>
                </tr>
                <tr>
                    <td> Email: </td>
                    <td> <input type="text" name="mail"/> </td>
                </tr>
                <tr>
                    <td> Password: </td>
                    <td> <input type="password" name="password"/> </td>
                </tr>
                <tr>
                    <td> Conferma Password: </td>
                    <td> <input type="password" name="password_1"> </td>
                </tr>
            </table>
                    <input type="hidden" name="controller" value="registrazione" />
                    <input type="hidden" name="task" value="salva" />
                    <input type="submit" class="submit" value="invia dati" />
                </form>
        </div>
    </div>