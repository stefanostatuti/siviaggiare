<?php /* Smarty version 2.6.26, created on 2013-09-02 11:32:48
         compiled from viaggio_inserimento_viaggio.tpl */ ?>
<div class="content">
    <div class="form_settings">
        <form method="post" action="index.php">
        <h2>Crea un nuovo viaggio</h2>
            <table>
                <tr>
                <td><h4>Autore:</h4></td><td><h5><?php echo $this->_tpl_vars['autore']; ?>
</h5></td>
                </tr>
                <tr>
                <td><h4>Periodo</h4></td>
                <td>
                    <h6>Inizio:</h6><input type="datetime-local" name="datainizio" id="datainizio"/>
                    <h6>fine:</h6> <input type="datetime" name="datafine" id="datainizio"/>
                </td>
                </tr>
                <tr>
                <td><h4>Mezzo di trasporto: </h4></td>
                <td>
                   <select name="mezzotrasporto" class="left">
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
                   </select>
                </td>
                </tr>
                <tr>
                    <td>
                    <h4>Costo del trasporto: </h4></td>
                    <td>
                    <input type="text" name="costotrasporto"/>
                    </td>
                </tr>
                <tr>
                    <td>
                    <h4>Budget: </h4>
                    </td>
                    <td>
                    <input type="text" name="budget"/>
                    </td>
                </tr>
                </table>
                <input type="hidden" name="controller" value="aggiunta_viaggio" />
                <input type="hidden" name="task" value="salvaviaggio" />
                <input type="submit" class="submit" name="submit" value="conferma" />
        </form>
    </div>
</div>
