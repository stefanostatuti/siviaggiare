<div class="content" id="form_journey_bis">
    <div class="form_settings">
        <script type="text/javascript" src="templates/main/template/js/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="templates/main/template/js/date.js"></script>
        <script type="text/javascript" src="templates/main/template/js/validation_viaggio.js"></script>


        <form method="post" action="index.php" id="form_journey">

            <div class="error" > {$errore}</div>

            <legend id="form_journey"><h4>Crea un nuovo viaggio : </h4></legend>

            <label for="autore">Autore :</label>{$autore}

            <fieldset>
                <legend id="date" >Periodo* :</legend>
                <label for="periodo">Inizio :</label>
                <input type="datetime-local" name="datainizio" id="datainizio" value="{$viaggio.datainizio}" class="data"/>
                {if  $messaggi.campodatainizio != false}
                    <p class="error">
                        {if $messaggi.campodatainizio != 'false'} {$messaggi.campodatainizio}  {/if}
                    </p>
                {/if}

                <label for="periodo">Fine :</label>
                <input type="datetime-local" name="datafine" id="datafine"  value="{$viaggio.datafine}" class="data" />
                {if $messaggi.date != false |  $messaggi.campodatafine != false}
                    <p class="error">
                        {if $messaggi.date != 'false'} {$messaggi.date}  {/if}
                        {if $messaggi.campodatafine != 'false'} {$messaggi.campodatafine}  {/if}
                    </p>
                {/if}
            </fieldset>


            <label for="mezzo"> Mezzo Di Trasporto: </label>
            <select name="mezzotrasporto" id="mezzotrasporto" class="left">
                <optgroup label="Scegli il tipo di trasporto" >
                    <option value="Autobus" {if $viaggio.mezzotrasporto=="Autobus"}selected {/if}> Autobus </option>
                    <option value="Macchina" {if $viaggio.mezzotrasporto=="Macchina"}selected {/if}> Macchina </option>
                    <option value="Aereo" {if $viaggio.mezzotrasporto=="Aereo"}selected {/if}> Aereo </option>
                    <option value="Nave" {if $viaggio.mezzotrasporto=="Nave"}selected {/if}> Nave </option>
                    <option value="Traghetto" {if $viaggio.mezzotrasporto=="Traghetto"}selected {/if}> Traghetto </option>
                    <option value="Moto" {if $viaggio.mezzotrasporto=="Moto"}selected {/if}> Moto </option>
                    <option value="Camper" {if $viaggio.mezzotrasporto=="Camper"}selected {/if}> Camper </option>
                    <option value="Bicicletta" {if $viaggio.mezzotrasporto=="Bicicletta"}selected {/if}> Bicicletta </option>
            </select>

            <br>

            <label for="costotrasporto">Costo Del Trasporto* : </label>
            <input type="text" name="costotrasporto" id="costotrasporto" value="{$viaggio.costotrasporto}"/>
            <select name="valutatrasporto" value="{$viaggio.valutatrasporto}">
                <optgroup label="Scegli il tipo di valuta" >
                    <option value="Euro" {if $viaggio.valutatrasporto=="Euro"}selected {/if}> € </option>
                    <option value="Yen Giapponese" {if $viaggio.valutatrasporto=="Yen Giapponese"}selected {/if}> ¥ </option>
                    <option value="Dollaro US" {if $viaggio.valutatrasporto=="Dollaro US"}selected {/if}> $ USA </option>
                    <option value="Dollaro AU" {if $viaggio.valutatrasporto=="Dollaro AU"}selected {/if}> $ AUS </option>
                    <option value="HUF Ungheria" {if $viaggio.valutatrasporto=="HUF Ungheria"}selected {/if}> Ft HUF </option>
            </select>
            {if $messaggi.costotrasporto != false  ||  $messaggi.campocostotras != false}
                <p class="error">
                    {if $messaggi.costotrasporto != 'false'} {$messaggi.costotrasporto}  {/if}
                    {if $messaggi.campocostotras != 'false'} {$messaggi.campocostotras}  {/if}
                </p>
            {/if}

            <label for="budget">Budget Della Vacanza* : </label>
            <input type="text" name="budget" id="budget" value="{$viaggio.budget}"/>
            <select name="valutabudget" value="{$viaggio.valutabudget}">
                <optgroup label="Scegli il tipo di valuta" >
                    <option value="Euro" {if $viaggio.valutabudget=="Euro"}selected {/if}> € </option>
                    <option value="Yen Giapponese" {if $viaggio.valutabudget=="Yen Giapponese"}selected {/if}> ¥ </option>
                    <option value="Dollaro US" {if $viaggio.valutabudget=="Dollaro US"}selected {/if}> $ USA </option>
                    <option value="Dollaro AU" {if $viaggio.valutabudget=="Dollaro AU"}selected {/if}> $ AUS </option>
                    <option value="HUF Ungheria" {if $viaggio.valutabudget=="HUF Ungheria"}selected {/if}> Ft HUF </option>
            </select>
            {if $messaggi.budget != false || $messaggi.costo_budget != false  ||  $messaggi.campobudget != false}
                <p class="error">
                    {if $messaggi.budget != 'false'} {$messaggi.budget}  {/if}
                    {if $messaggi.costo_budget != 'false'} {$messaggi.costo_budget}  {/if}
                    {if $messaggi.campobudget != 'false'} {$messaggi.campobudget}  {/if}
                </p>
            {/if}

            </fieldset>

            <input type="hidden" name="controller" value={$controller} />
            <input type="hidden" name="task" value={$task} />
            <input type="submit" class="submit" name="submit" value="conferma" id="j_submit" />
            <input type="reset" name="cancella" value="cancella" id="j_reset" />

            <br>
            <br>

            <div id="campo_obbligatorio">* Campo Obbligatorio</div>

        </form>
    </div>
</div>