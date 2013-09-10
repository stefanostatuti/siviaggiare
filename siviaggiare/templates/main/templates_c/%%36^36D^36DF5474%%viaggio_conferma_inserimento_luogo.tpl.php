<?php /* Smarty version 2.6.26, created on 2013-09-02 12:15:45
         compiled from viaggio_conferma_inserimento_luogo.tpl */ ?>
<div class="content">
    <div class="form_settings">
        <h3>Il luogo &egrave; stato inserito</h3>
        <br>
        <form method="post" action="index.php">
            <h4>Se vuoi inserire un altro luogo visitato:</h4>
            <br>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="inserimento_luogo" />
            <input type="submit" class="submit"value="Altro Luogo" />
        </form>
        <br>
        <h5>Oppure torna alla <a href>Home</a></h5>
    </div>
</div>