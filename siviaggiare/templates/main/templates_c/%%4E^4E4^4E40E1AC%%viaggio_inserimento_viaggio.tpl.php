<?php /* Smarty version 2.6.26, created on 2013-09-09 17:42:53
         compiled from viaggio_inserimento_viaggio.tpl */ ?>
<div class="content">
    <div class="form_settings">
        <form method="post" action="index.php">
            <p class="error" > <?php echo $this->_tpl_vars['errore']; ?>
</p>
            <h2>Crea un nuovo viaggio</h2>
            <table>
                <tr>
                    <td><h4>Autore:</h4></td><td><h5><?php echo $this->_tpl_vars['autore']; ?>
</h5></td>
                </tr>
                <tr>
                    <td><h4>Periodo</h4></td>
                    <td>
                        <h6>Inizio:</h6><input type="datetime-local" name="datainizio" id="datainizio" value="<?php echo $this->_tpl_vars['viaggio']['datainizio']; ?>
"/>
                        <h6>fine:</h6> <input type="datetime" name="datafine" id="datainizio" value="<?php echo $this->_tpl_vars['viaggio']['datafine']; ?>
"/>
                    <?php if ($this->_tpl_vars['messaggi']['datainizio'] != false || $this->_tpl_vars['messaggi']['datafine'] != false || $this->_tpl_vars['messaggi']['date'] != false): ?>
                    <td class="error">
                        <?php if ($this->_tpl_vars['messaggi']['datainizio'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['datinizio']; ?>
  <?php endif; ?>
                        <?php if ($this->_tpl_vars['messaggi']['datafine'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['datafine']; ?>
  <?php endif; ?>
                        <?php if ($this->_tpl_vars['messaggi']['date'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['date']; ?>
  <?php endif; ?>
                    </td>
                    <?php endif; ?>
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
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Costo del trasporto: </h4></td>
                    <td>
                        <input type="text" name="costotrasporto" value="<?php echo $this->_tpl_vars['viaggio']['costotrasporto']; ?>
"/>
                    </td>
                    <?php if ($this->_tpl_vars['messaggi']['costotrasporto'] != false): ?>
                    <td class="error">
                        <?php if ($this->_tpl_vars['messaggi']['costotrasporto'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['costotrasporto']; ?>
  <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td>
                        <h4>Budget: </h4>
                    </td>
                    <td>
                        <input type="text" name="budget" value="<?php echo $this->_tpl_vars['viaggio']['budget']; ?>
"/>
                    </td>
                    <?php if ($this->_tpl_vars['messaggi']['budget'] != false || $this->_tpl_vars['messaggi']['costo_budget'] != false): ?>
                    <td class="error">
                        <?php if ($this->_tpl_vars['messaggi']['budget'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['budget']; ?>
  <?php endif; ?>
                        <?php if ($this->_tpl_vars['messaggi']['costo_budget'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['costo_budget']; ?>
  <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
            </table>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="salva_viaggio" />
            <input type="submit" class="submit" name="submit" value="conferma" />
        </form>
    </div>
</div>