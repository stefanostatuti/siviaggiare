<div class="content">
    <div class="form_settings">
        <script type="text/javascript" src="templates/main/template/js/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="templates/main/template/js/date.js"></script>
        <script type="text/javascript" src="templates/main/template/js/validation_viaggio.js"></script>



        <form method="post" action="index.php" id="form_journey">
            <div id="form_journey" class="error" > {$errore}</div>


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
            <select name="mezzotrasporto"  id="mezzotrasporto" class="left">
                <optgroup label="Scegli il tipo di trasporto" >
                    <option value="Autobus"> Autobus </option>
                    <option value="Macchina"> Macchina </option>
                    <option value="Aereo"> Aereo </option>
                    <option value="Nave"> Nave </option>
                    <option value="Traghetto"> Traghetto </option>
                    <option value="Moto"> Moto </option>
                    <option value="Camper"> Camper </option>
                    <option value="Bicicletta"> Bicicletta </option>
            </select>

            <br>

            <label for="costotrasporto">Costo Del Trasporto* : </label>
            <input type="text" name="costotrasporto" id="costotrasporto" value="{$viaggio.costotrasporto}"/>
            <select name="valutatrasporto" value="{$viaggio.valutatrasporto}">
                <optgroup label="Scegli il tipo di valuta" >
                    <option value="Euro"> € </option>
                    <option value="Yen Giapponese"> ¥ </option>
                    <option value="Dollaro US"> $ USA </option>
                    <option value="Dollaro AU"> $ AUS </option>
                    <option value="HUF Ungheria"> Ft HUF </option>
            </select>
            {if $messaggi.costotrasporto != false  ||  $messaggi.campocostotras != false}
                <p class="error">
                    {if $messaggi.costotrasporto != 'false'} {$messaggi.costotrasporto}  {/if}
                    {if $messaggi.campocostotras != 'false'} {$messaggi.campocostotras}  {/if}
                </p>
            {/if}

            <label for="budget">Budget Della Vacanza* : </label>
            <input type="text" name="budget" id="budget" value="{$viaggio.budget}"/>
            <select name="valutabudget" value="{$viaggio.valuta}">
                <optgroup label="Scegli il tipo di valuta" >
                    <option value="Euro"> € </option>
                    <option value="Yen Giapponese"> ¥ </option>
                    <option value="Dollaro US"> $ USA </option>
                    <option value="Dollaro AU"> $ AUS </option>
                    <option value="HUF Ungheria"> Ft HUF </option>
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

        </form>
    </div>
</div>