<div class="sidebar">
<div class="form_settings">
  <script type="text/javascript" src='templates/main/template/js/jquery.elevatezoom.js'></script>
  <script type="text/javascript" src='templates/main/template/js/zoom_foto.js'></script>
  <script type="text/javascript" src='templates/main/template/js/ajaxfotoprofilo.js'></script>

        
  <div class="pre_profilo">
      <div id="profilo" class="error" > {$errore}</div>

    {if $foto != ""}
    <img id="foto" src="templates/main/template/images/foto_profilo/{$foto}"  data-zoom-image="templates/main/template/images/foto_profilo/{$foto}" width="70" height="46"  /img></a>
    {/if}
    <div id="nome">{$username}</div>
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