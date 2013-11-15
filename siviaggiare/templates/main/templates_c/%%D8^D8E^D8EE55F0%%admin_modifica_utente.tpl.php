<?php /* Smarty version 2.6.26, created on 2013-11-15 14:19:06
         compiled from admin_modifica_utente.tpl */ ?>
<script type="text/javascript" src="templates/main/template/js/admin.js"></script>
<div class="content">
    <div class="form_settings">
        <div id="administrator_modifiche">

                <fieldset>
                    <label>Username:</label>
                    <input type="text" name="username" readonly id="adm_user" maxlength="20" value="<?php echo $this->_tpl_vars['utente']->username; ?>
" />

                    <label>Cognome :</label>
                    <input type="text" name="cognome" id="adm_cognome" maxlength="40" value="<?php echo $this->_tpl_vars['utente']->cognome; ?>
" />

                    <label>Nome :</label>
                    <input type="text" name="nome" id="adm_nome" maxlength="20" value="<?php echo $this->_tpl_vars['utente']->nome; ?>
"/>

                    <label>Residenza:</label>
                    <input type="text" name="citta" id="adm_citta" maxlength="20" value="<?php echo $this->_tpl_vars['utente']->residenza; ?>
" />

                    <label>Nazione :</label>
                    <input type="text" name="nazione" id="adm_nazione" maxlength="20" value="<?php echo $this->_tpl_vars['utente']->nazione; ?>
" />

                    <label>Email :</label>
                    <input type="text" name="mail" id="adm_email" maxlength="30" value="<?php echo $this->_tpl_vars['utente']->mail; ?>
"/>

                    <label>Codice Attivazione :</label>
                    <input type="text" name="cod_attivazione" id="adm_codattivazione" maxlength="10" value="<?php echo $this->_tpl_vars['utente']->cod_attivazione; ?>
"/>

                    <label>Password :</label>
                    <input type="password" id="adm_password" name="password"  maxlength="20" value="<?php echo $this->_tpl_vars['utente']->password; ?>
" />

                    <label>Lavoro :</label>
                    <input type="text" id="adm_lavoro" name="lavoro"  maxlength="20" value="<?php echo $this->_tpl_vars['utente']->lavoro; ?>
" />

                    <label>Telefono :</label>
                    <input type="text" id="adm_telefono" name="telefono"  maxlength="20" value="<?php echo $this->_tpl_vars['utente']->telefono; ?>
" />

                    <label>Avvertimenti :</label>
                    <input type="text" id="adm_avvertimenti" name="avvertimenti"  maxlength="1" value="<?php echo $this->_tpl_vars['utente']->avvertimenti; ?>
" />

                    <label>Sesso :</label>
                    <input type="text" id="adm_sesso" name="sesso"  maxlength="20" value="<?php echo $this->_tpl_vars['utente']->sesso; ?>
" />

                    <label>Data Nascita :</label>
                    <input type="text" id="adm_data" name="datanascita"  maxlength="20" value="<?php echo $this->_tpl_vars['utente']->datanascita; ?>
" />

                    <label>Stato Iscrizione:</label>

                    <select name="stato" id="adm_stato" value="<?php echo $this->_tpl_vars['utente']->stato; ?>
">
                        <option value="attivo" <?php if ($this->_tpl_vars['utente']->stato == 'attivo'): ?>selected <?php endif; ?>>Attivo</option>
                        <option value="non_attivo" <?php if ($this->_tpl_vars['utente']->stato == 'non_attivo'): ?>selected <?php endif; ?>>Non Attivo</option>
                        <option value="admin" <?php if ($this->_tpl_vars['utente']->stato == 'admin'): ?>selected <?php endif; ?>>Admin</option>
                    </select>

                </fieldset>
                <button id="salva_modifiche" class="salva_modifiche">Salva</button>
                <button id="annulla_modifiche" class="annulla_modifiche">Annulla</button>
        </div>
    </div>
</div>