<?php /* Smarty version 2.6.26, created on 2013-10-30 13:04:31
         compiled from registrazione_profilo.tpl */ ?>
<div class="sidebar">
<div class="form_settings">
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
        
  <div class="pre_profilo">
   <div id="profilo" class="error" > <?php echo $this->_tpl_vars['errore']; ?>
</div>
    <a href="templates/main/template/images"><img id="foto" src="templates/main/template/images/foto.png" width="70" height="46" alt="Impossibile visualizzare" /img></a>
    <div id="nome"><?php echo $this->_tpl_vars['username']; ?>
</div>
    <br>
    <ul>
      <li><div><a href="?controller=profilo&task=visualizza">Info</a></div></li>
    <br>
      <li><div><a href="?controller=profilo&task=messaggi">Messaggi</a></div></li>
    <br>
      <li><div><a href="?controller=profilo&task=galleria">Galleria</a></div></li>

  </div>
 </div>
</div>