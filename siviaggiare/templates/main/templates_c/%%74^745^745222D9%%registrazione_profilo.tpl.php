<?php /* Smarty version 2.6.26, created on 2013-11-15 14:21:34
         compiled from registrazione_profilo.tpl */ ?>
<div class="sidebar">
<div class="form_settings">
  <script type="text/javascript" src='templates/main/template/js/jquery.elevatezoom.js'></script>
  <script type="text/javascript" src='templates/main/template/js/zoom_foto.js'></script>
  <script type="text/javascript" src='templates/main/template/js/ajaxfotoprofilo.js'></script>

        
  <div class="pre_profilo">
      <div id="profilo" class="error" > <?php echo $this->_tpl_vars['errore']; ?>
</div>

    <?php if ($this->_tpl_vars['foto'] != ""): ?>
    <img id="foto" src="templates/main/template/images/foto_profilo/<?php echo $this->_tpl_vars['foto']; ?>
"  data-zoom-image="templates/main/template/images/foto_profilo/<?php echo $this->_tpl_vars['foto']; ?>
" width="70" height="46"  /img></a>
    <?php endif; ?>
    <div id="nome"><?php echo $this->_tpl_vars['username']; ?>
</div>
    <br>
    <ul>
      <li><div><a href="?controller=profilo&task=visualizza">Info</a></div></li>
    <br>
      <li><div><a href="?controller=profilo&task=galleria">Galleria</a></div></li>
    <br>
      <li><div><a href="?controller=profilo&task=modifica_foto_profilo">Modifica foto profilo</a></div></li>
    </ul>
    <form id="logout_button" metod="post" action="index.php">
        <input type="submit" name="submit" id="logout_button" class="submit" value="LOGOUT" />
        <input type="hidden" name="controller" value="registrazione" />
        <input type="hidden" name="task" value="esci" />
    </form>

  </div>
 </div>
</div>