<?php /* Smarty version 2.6.26, created on 2013-09-09 17:27:02
         compiled from registrazione_modulo.tpl */ ?>
<div class="content">
    <div class="form_settings">
        <div class="error"><?php echo $this->_tpl_vars['errore']; ?>

            <legend><h4>Inserisci i seguenti dati: </h4></legend>

            <table>
                <form method="post" action="index.php">
                    <tr>
                        <td> Username: </td>
                        <td> <input type="text" name="username"  maxlength="20" value="<?php echo $this->_tpl_vars['persona']['user']; ?>
"/> </td>
                        <?php if ($this->_tpl_vars['messaggi'] != false || $this->_tpl_vars['messaggi']['userdata'] != false): ?>
                            <td class="error">
                                <?php if ($this->_tpl_vars['messaggi'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['user']; ?>
  <?php endif; ?>
                                <?php if ($this->_tpl_vars['messaggi']['userdata'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['userdata']; ?>
  <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td> Cognome: </td>
                        <td> <input type="text" name="cognome" maxlength="20" value="<?php echo $this->_tpl_vars['persona']['cognome']; ?>
"/> </td>
                        <?php if ($this->_tpl_vars['messaggi']['cognome'] != false): ?>
                        <td class="error">
                            <?php echo $this->_tpl_vars['messaggi']['cognome']; ?>

                        </td>
                            <?php endif; ?>
                    </tr>
                    <tr>
                        <td > Nome: </td>
                        <td> <input type="text" name="nome" maxlength="20" value="<?php echo $this->_tpl_vars['persona']['nome']; ?>
"/></td>
                        <?php if ($this->_tpl_vars['messaggi']['nome'] != false): ?>
                        <td class="error">
                            <?php echo $this->_tpl_vars['messaggi']['nome']; ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Citt&agrave: </td>
                        <td> <input type="text" name="residenza" maxlength="20" value="<?php echo $this->_tpl_vars['persona']['residenza']; ?>
"/></td>
                        <?php if ($this->_tpl_vars['messaggi']['residenza'] != false): ?>
                        <td class="error">
                            <?php echo $this->_tpl_vars['messaggi']['residenza']; ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Nazione: </td>
                        <td> <input type="text" name="nazione" maxlength="20" value="<?php echo $this->_tpl_vars['persona']['nazione']; ?>
"/></td>
                        <?php if ($this->_tpl_vars['messaggi']['nazione'] != false): ?>
                        <td class="error">
                            <?php echo $this->_tpl_vars['messaggi']['nazione']; ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Email: </td>
                        <td> <input type="text" name="mail" maxlength="30" value="<?php echo $this->_tpl_vars['persona']['mail']; ?>
" /></td>
                        <?php if ($this->_tpl_vars['messaggi']['mail'] != false): ?>
                        <td class="error">
                            <?php echo $this->_tpl_vars['messaggi']['mail']; ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Password: </td>
                        <td> <input type="password" name="password" maxlength="20" value="<?php echo $this->_tpl_vars['persona']['password']; ?>
" /></td>
                        <?php if ($this->_tpl_vars['messaggi']['password'] != false): ?>
                        <td class="error">
                            <?php echo $this->_tpl_vars['messaggi']['password']; ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Conferma Password: </td>
                        <td> <input type="password" name="password_1" maxlength="20" value="<?php echo $this->_tpl_vars['persona']['password_1']; ?>
" /></td>
                        <?php if ($this->_tpl_vars['messaggi']['password'] != false || $this->_tpl_vars['messaggi']['password2'] != false): ?>
                        <td class="error">
                            <?php if ($this->_tpl_vars['messaggi']['password'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['password']; ?>
  <?php endif; ?>
                            <?php if ($this->_tpl_vars['messaggi']['password2'] != 'false'): ?> <?php echo $this->_tpl_vars['messaggi']['password2']; ?>
  <?php endif; ?>
                        </td>
                            <?php endif; ?>
                    </tr>
            </table>
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="salva" />
            <input type="submit" class="submit" value="invia dati" />
            </form>
        </div>
    </div>
</div>