<div class="sidebar">
<div class="form_settings">
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
        
  <div class="pre_profilo">
   <div id="profilo" class="error" > {$errore}</div>
    <a href="templates/main/template/images"><img id="foto" src="templates/main/template/images/foto.png" width="70" height="46" alt="Impossibile visualizzare" /img></a>
    <div id="nome">{$username}</div>
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