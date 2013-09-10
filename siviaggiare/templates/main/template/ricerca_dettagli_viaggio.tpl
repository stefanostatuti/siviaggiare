 <div class="corner-content-1col-top"></div>
    <div class="content-1col-nobox">
        <fieldset>
          <h5><b>Autore:</b> {$username}</h5>
          {if $datainizio !=false && $datainizio != "0000-00-00"}
            <p><b>Vacanza dal</b>   {$datainizio}</p>
          {else}
             <p><b>la data è invalida-----> eccola</b> {$datainizio}</p>
          {/if}


          {if $datafine != false && $datafine != "0000-00-00"}
            <p><b>Vacanza al</b> {$datafine}</p>
          {else}
              <p><b>la data è invalida -----> eccola</b> {$datafine}</p>
          {/if}

          <p><b>Mezzo di trasporto:</b> {$mezzotrasporto}</p>


          {if $costotrasporto==false || $costotrasporto=="0" || $costotrasporto >= "10000" }
                <p><b>Costo del trasporto:</b> costo non inserito o non valido! eccolo {$costotrasporto} Euro</p>
          {else}
              <p><b>Costo del trasporto il costo è:</b> {$costotrasporto} Euro</p>
          {/if}


            {if $budget==false || $budget=="0" || $budget >= "10000" }
                <p><b>Il Budget:</b> costo non inserito o non valido! eccolo {$budget} Euro</p>
            {else}
                <p><b>Il Budget:</b> il costo è:</b> {$budget} Euro</p>
            {/if}
          </fieldset>
    </div>
<div class="corner-content-1col-bottom"></div>
