<?php /* Smarty version 2.6.26, created on 2013-08-27 10:57:52
         compiled from viaggio_inserimento_luogo.tpl */ ?>
<a id="anchor-contact-1"></a>
<div class="corner-content-1col-top"></div>
<div class="content-1col-nobox">
    <h1 class="Nuovo Viaggio">Inserimento Luogo</h1>
    <div class="contactform">
        <form method="post" action="index.php">
            <fieldset>
                <legend>&nbsp;Inserisci un nuovo luogo d'interesse:&nbsp;</legend>
                <table>
                    <tr>
                    <td>
                    <p><label for="autore" class="left">Autore: <?php echo $this->_tpl_vars['autore']; ?>
</label>
                    <p><label for="idviaggio" class="left">IdViaggio: <?php echo $this->_tpl_vars['idviaggio']; ?>
</label>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <label for="nome" class="nome">Nome: </label>
                    <input type="text" name="nome" id="nome"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <label for="nomecitta" class="left">Citt&agrave;: </label>
                    <input type="text" name="nomecitta" id="nomecitta"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <label for="sitoweb" class="sitoweb">Sito Web: </label>
                    <input type="text" name="sitoweb" id="sitoweb"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                <label for="percorso" class="left">Percorso: </label>
                <input type="text" name="percorso" id="percorso"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                <label for="costobiglietto" class="left">Costo del Biglietto: </label>
                <input type="text" name="costobiglietto" id="costobiglietto"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                <label for="guida" class="left">Guida Turistica: </label>
                <input type="text" name="guida" id="guida"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <label for="coda"> Coda: </label>
                        <td align="right"> <select name="coda" style="width:100px">
                                    <option value="minima"> minima </option>
                                    <option value="media"> media </option>
                                    <option value="alta"> alta </option>
                    </td>
                    </tr>
                    <tr>
                    <td>
                <label for="durata" class="left">Durata della visita: </label>
                <input type="text" name="durata" id="durata"/>
                    </td>
                    </tr>
                    <tr>
                    <td>
                <label for="commentolibero" class="left">Commento: </label>
                <input type="text-area" name="commentolibero" id="commentolibero"/>
                    </td>
                    </tr>
                </table>
            </fieldset>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="salva_luogo" />
            <p><input type="submit" name="submit" id="submit_1" class="button" value="Avanti" /></p>
            </fieldset>
        </form>
    </div>
</div>
<div class="corner-content-1col-bottom"></div>