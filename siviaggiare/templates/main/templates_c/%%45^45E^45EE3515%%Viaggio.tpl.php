<?php /* Smarty version 2.6.26, created on 2013-08-30 18:05:57
         compiled from viaggio_inserimento_viaggio.tpl */ ?>
<div class="content">
    <h1>Modulo di registrazione Nuovo Viaggio</h1>
    <div class="form_settings">
        <form method="post" action="index.php">
        <h3>Crea Nuovo Viaggio</h3>
            <table>
                <tr>
                <td><label for="autore" class="left">Autore:</td><td><?php echo $this->_tpl_vars['autore']; ?>
</td>
                </tr>
                <p><label for="data" class="left">Periodo</label>
                    <br>
                    data inizio : <input type="datetime-local" name="datainizio" id="datainizio"/></p>
                    data fine:  <input type="datetime" name="datafine" id="datainizio"/></p>
                <p><label for="mezzotrasporto" class="left">Mezzo di trasporto: </label>
                   <select name="mezzotrasporto" id="mezzotrasporto" style="width:100px">
                        <optgroup label="Tipo di trasporto">
                        <option value="Autobus"> Autobus </option>
                        <option value="Macchina"> Macchina </option>
                        <option value="Aereo"> Aereo </option>
                        <option value="Nave"> Nave </option>
                        <option value="Traghetto"> Traghetto </option>
                        <option value="Moto"> Moto </option>
                        <option value="Camper"> Camper </option>
                        <option value="Bicicletta"> Bicicletta </option>
                        <option value="Astronave"> Astronave </option>
                   </select></p>
                <p>
                    <label for="costotrasporto" class="left">Costo del trasporto: </label>
                    <input type="text" name="costotrasporto" id="costotrasporto"/>
                </p>


                <p><label for="budget" class="left">Budget: </label>
                    <input type="text" name="budget" id="budget"/></p>
            </table>
                <input type="hidden" name="controller" value="aggiunta_viaggio" />
                <input type="hidden" name="task" value="salvaviaggio" />
                <p><input type="submit" name="submit" id="submit_1" class="button" value="Avanti" /></p>
        </form>
    </div>
</div>
