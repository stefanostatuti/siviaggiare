<div class="content">
  <div class="form_settings" >
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
   <div id="foto_profilo" class="error" > {$errore}</div>
  <div class="foto_profilo">

      <label for="foto">Seleziona una foto: </label>
      <form action="index.php?controller=profilo&task=salva_foto" method="post" enctype="multipart/form-data">
          <input type="file" name="foto_profilo" id="foto_profilo" />
          <input type="submit" name="carica" value="Carica" id="carica"/>
      </form>
  </div>
 </div>
</div>