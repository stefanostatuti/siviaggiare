<div class="content" id="form_journey_bis">
    <div class="form_settings">
        <script type="text/javascript" src="templates/main/template/js/validation_luogo.js"></script>


        <form method="post" action="index.php" id="form_journey" enctype="multipart/form-data">

            <div> {$errore}</div>


            <legend id="form_journey"><h4>Nuovo Luogo : </h4></legend>

            <label for="autore">Autore :</label>{$autore}

            <label for="nome">Nome Luogo* :</label>
            <input type="text" name="nome" id="nome" value="{$luogo.luogo}" {$readonly} />
            {if $messaggi.luogo != false || $messaggi.campoluogo }
                <p class="error">
                    {if $messaggi.luogo != 'false'} {$messaggi.luogo}  {/if}
                    {if $messaggi.campoluogo != 'false'} {$messaggi.campoluogo}  {/if}
                </p>
            {/if}

            <label for="sitoweb">Sito Web : </label>
            <input type="text" name="sitoweb" id="sitoweb" value="{$luogo.sitoweb}"/>
            {if $messaggi.sitoweb != false}
                <p class="error">
                    {if $messaggi.sitoweb != 'false'} {$messaggi.sitoweb}  {/if}
                </p>
            {/if}

            <label>Percorso :</label>
            <input type="text" name="percorso" id="percorso" value="{$luogo.percorso}"/>

            <label for="costobiglietto" >Costo Del Biglietto :</label>
            <input type="text" name="costobiglietto" id="costobiglietto" value="{$luogo.costobiglietto}"/>
            <select name="valuta" value="{$luogo.valuta}">
                <optgroup label="Scegli il tipo di valuta" >
                    <option value="Euro" {if $luogo.valuta=="Euro"}selected {/if}> € </option>
                    <option value="Yen Giapponese" {if $luogo.valuta=="Yen Giapponese"}selected {/if}> ¥ </option>
                    <option value="Dollaro US" {if $luogo.valuta=="Dollaro US"}selected {/if}> $ USA </option>
                    <option value="Dollaro AU" {if $luogo.valuta=="Dollaro AU"}selected {/if}> $ AUS </option>
                    <option value="HUF Ungheria" {if $luogo.valuta=="HUF Ungheria"}selected {/if}> Ft HUF </option>
            </select>
            {if $messaggi.costobiglietto != false || $messaggi.biglietto_budget }
                <p class="error">
                    {if $messaggi.costobiglietto != 'false'} {$messaggi.costobiglietto}  {/if}
                    {if $messaggi.biglietto_budget != 'false'} {$messaggi.biglietto_budget}  {/if}
                </p>
            {/if}

            <label for="guida">Guida Turistica :</label>
            <input type="text" name="guida" id="guida" value="{$luogo.guidaturistica}"/>
            {if $messaggi.guidaturistica != false}
                <p class="error">
                    {if $messaggi.guidaturistica != 'false'} {$messaggi.guidaturistica}  {/if}
                </p>
            {/if}

            <label>Coda :</label>
            <select name="coda" value="{$luogo.coda}">
                <option value="minima" {if $luogo.coda=="minima"}selected {/if}> minima </option>
                <option value="media" {if $luogo.coda=="media"}selected {/if}> media </option>
                <option value="alta" {if $luogo.coda=="alta"}selected {/if}> alta </option>
            </select>

            <label for="durata">Durata Della Visita :</label>
            <input type="text" name="durata" id="durata" value="{$luogo.duratavisita}"/>
            {if $messaggi.duratavisita != false}
                <p class="error">
                    {if $messaggi.duratavisita != 'false'} {$messaggi.duratavisita}  {/if}
                </p>
            {/if}

            <label for="commentolibero">Commento :</label>
            <textarea name="commentolibero" id="commentolibero" value="{$luogo.commento}"/>{if isset($luogo.commento)}{$luogo.commento}{/if}</textarea>

            {$inserimento_foto}

            {$immagine_luogo}

            <input type="hidden" name="controller" value= {$controller}  />
            <input type="hidden" name="task" value= {$task}  />
            <input type="submit" name="submit" class="submit" value="conferma" id="j_submit" />
            <input type="reset"  name="cancella" value="cancella" id="j_reset" />
            <input type="hidden" name="idviaggio" value= "{$idviaggio}" />
            <input type="hidden" name="nomecitta" value= "{$nomecitta}" />

            <br>
            <br>

            <div id="campo_obbligatorio">* Campo Obbligatorio</div>

        </form>
    </div>
</div>