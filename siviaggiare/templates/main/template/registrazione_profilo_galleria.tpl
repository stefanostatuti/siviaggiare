<div class="content">
 <div class="form_settings">
  <script type="text/javascript" src="templates/main/template/js/jquery.cycle.js"></script>
  <script type="text/javascript" src="templates/main/template/js/galleria.js"></script>
  <script type="text/javascript" src='templates/main/template/js/ajaxgalleria.js'></script>
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
  <div id="galleria_profilo" class="error" > {$errore}</div>
  <div class="galleria_profilo">
  
     <legend><h4>Galleria foto</h4></legend>

      <div id="photos">

          {section name=nr loop=$foto}
                <div><img src=templates/main/template/images/galleria/{$foto[nr]}  /></div>
          {sectionelse}
                <h5> nessun risultato </h5>
          {/section}

      </div>
      <label for="foto">Seleziona le foto: </label>
      <form action="index.php?controller=profilo&task=aggiungi_foto_galleria" method="post" enctype="multipart/form-data">
          <input type="file" name="foto" id="immagine" />
          <input type="submit" name="carica" value="Carica" id="carica_galleria"/>
      </form>
      <form action="index.php?controller=profilo&task=elimina_galleria" method="post" enctype="multipart/form-data">
          <input type="submit" name="cancella_galleria" value="Elimina foto" id="cancella_galleria"/>
      </form>



  </div>
</div> 
</div>  