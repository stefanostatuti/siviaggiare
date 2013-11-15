<?php /* Smarty version 2.6.26, created on 2013-11-15 14:45:37
         compiled from registrazione_profilo_galleria.tpl */ ?>
<div class="content">
 <div class="form_settings">
  <script type="text/javascript" src="templates/main/template/js/jquery.cycle.js"></script>
  <script type="text/javascript" src="templates/main/template/js/galleria.js"></script>
  <script type="text/javascript" src='templates/main/template/js/ajaxgalleria.js'></script>
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
  <div id="galleria_profilo" class="error" > <?php echo $this->_tpl_vars['errore']; ?>
</div>
  <div class="galleria_profilo">
  
     <legend><h4>Galleria foto</h4></legend>

      <div id="photos">

          <?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['foto']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nr']['show'] = true;
$this->_sections['nr']['max'] = $this->_sections['nr']['loop'];
$this->_sections['nr']['step'] = 1;
$this->_sections['nr']['start'] = $this->_sections['nr']['step'] > 0 ? 0 : $this->_sections['nr']['loop']-1;
if ($this->_sections['nr']['show']) {
    $this->_sections['nr']['total'] = $this->_sections['nr']['loop'];
    if ($this->_sections['nr']['total'] == 0)
        $this->_sections['nr']['show'] = false;
} else
    $this->_sections['nr']['total'] = 0;
if ($this->_sections['nr']['show']):

            for ($this->_sections['nr']['index'] = $this->_sections['nr']['start'], $this->_sections['nr']['iteration'] = 1;
                 $this->_sections['nr']['iteration'] <= $this->_sections['nr']['total'];
                 $this->_sections['nr']['index'] += $this->_sections['nr']['step'], $this->_sections['nr']['iteration']++):
$this->_sections['nr']['rownum'] = $this->_sections['nr']['iteration'];
$this->_sections['nr']['index_prev'] = $this->_sections['nr']['index'] - $this->_sections['nr']['step'];
$this->_sections['nr']['index_next'] = $this->_sections['nr']['index'] + $this->_sections['nr']['step'];
$this->_sections['nr']['first']      = ($this->_sections['nr']['iteration'] == 1);
$this->_sections['nr']['last']       = ($this->_sections['nr']['iteration'] == $this->_sections['nr']['total']);
?>
                <div><img src=templates/main/template/images/galleria/<?php echo $this->_tpl_vars['foto'][$this->_sections['nr']['index']]; ?>
  /></div>
          <?php endfor; else: ?>
                <h5> nessun risultato </h5>
          <?php endif; ?>

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