<?php /* Smarty version 2.6.26, created on 2013-08-23 15:44:00
         compiled from ricerca_dettagli_viaggio.tpl */ ?>
 <div class="corner-content-1col-top"></div>
    <div class="content-1col-nobox">
        <fieldset>
          <h5><b>Autore:</b> <?php echo $this->_tpl_vars['username']; ?>
</h5>
          <?php if ($this->_tpl_vars['datainizio'] != false && $this->_tpl_vars['datainizio'] != "0000-00-00"): ?>
            <p><b>Vacanza dal</b>   <?php echo $this->_tpl_vars['datainizio']; ?>
</p>
          <?php else: ?>
             <p><b>la data è invalida-----> eccola</b> <?php echo $this->_tpl_vars['datainizio']; ?>
</p>
          <?php endif; ?>


          <?php if ($this->_tpl_vars['datafine'] != false && $this->_tpl_vars['datafine'] != "0000-00-00"): ?>
            <p><b>Vacanza al</b> <?php echo $this->_tpl_vars['datafine']; ?>
</p>
          <?php else: ?>
              <p><b>la data è invalida -----> eccola</b> <?php echo $this->_tpl_vars['datafine']; ?>
</p>
          <?php endif; ?>

          <p><b>Mezzo di trasporto:</b> <?php echo $this->_tpl_vars['mezzotrasporto']; ?>
</p>


          <?php if ($this->_tpl_vars['costotrasporto'] == false || $this->_tpl_vars['costotrasporto'] == '0' || $this->_tpl_vars['costotrasporto'] >= '10000'): ?>
                <p><b>Costo del trasporto:</b> costo non inserito o non valido! eccolo <?php echo $this->_tpl_vars['costotrasporto']; ?>
 Euro</p>
          <?php else: ?>
              <p><b>Costo del trasporto il costo è:</b> <?php echo $this->_tpl_vars['costotrasporto']; ?>
 Euro</p>
          <?php endif; ?>


            <?php if ($this->_tpl_vars['budget'] == false || $this->_tpl_vars['budget'] == '0' || $this->_tpl_vars['budget'] >= '10000'): ?>
                <p><b>Il Budget:</b> costo non inserito o non valido! eccolo <?php echo $this->_tpl_vars['budget']; ?>
 Euro</p>
            <?php else: ?>
                <p><b>Il Budget:</b> il costo è:</b> <?php echo $this->_tpl_vars['budget']; ?>
 Euro</p>
            <?php endif; ?>
          </fieldset>
    </div>
<div class="corner-content-1col-bottom"></div>