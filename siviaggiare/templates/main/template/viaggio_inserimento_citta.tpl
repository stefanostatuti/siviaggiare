<div class="content" id="form_journey_bis">
    <div class="form_settings">
        <script type="text/javascript" src="templates/main/template/js/datepicker.js"></script>
        <script type="text/javascript" src="templates/main/template/js/date.js"></script>
        <script type="text/javascript" src="templates/main/template/js/validation_citta.js"></script>
        <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />


        <form method="post" action="index.php" id="form_journey">

            <div class="error" > {$errore}</div>

            <legend id="form_journey"><h4>Nuova citt&agrave; : </h4></legend>

            <label for="autore">Autore :</label>{$autore}

            <br>
            <br>

            <fieldset >
                <legend id="date">Periodo* :</legend>
                <label>Inizio :</label>
                <input type="datetime-local" name="datainizio" id="datainizio" value="{$citta.datainizio}" class="data" />
                {if $messaggi.campodatainizio != false}
                    <p class="error">
                        {if $messaggi.campodatainizio != 'false'} {$messaggi.campodatainizio}  {/if}
                    </p>
                {/if}

                <label>Fine :</label>
                <input type="datetime-local" name="datafine" value="{$citta.datafine}" id="datafine" class="data" />
                {if $messaggi.date != false || $messaggi.campodatafine != false}
                    <p class="error">
                        {if $messaggi.campodatafine != 'false'} {$messaggi.campodatafine}  {/if}
                        {if $messaggi.date != 'false'} {$messaggi.date}  {/if}
                    </p>
                {/if}

            </fieldset>

            <label for="nome"> Nome Citt&agrave;* : </label>
            <input type="text" name="nome" id="nome" value="{$citta.citta}" {$readonly}/>
            {if $messaggi.citta != false  || $messaggi.campocitta != false }
                <p class="error">
                    {if $messaggi.citta != 'false'} {$messaggi.citta}  {/if}
                    {if $messaggi.campocitta != 'false'} {$messaggi.campocitta}  {/if}
                </p>
            {/if}

            <label for="stato"> Stato*: </label>
            <input type="text" name="stato" id="stato" value="{$citta.stato}"/>
            {if $messaggi.stato != false || $messaggi.campostato != false}
                <p class="error">
                    {if $messaggi.stato != 'false'} {$messaggi.stato}  {/if}
                    {if $messaggi.campostato != 'false'} {$messaggi.campostato}  {/if}
                </p>
            {/if}

            <label for="alloggio"> Tipo di alloggio: </label>
            <input type="text" name="tipoalloggio" id="alloggio" value="{$citta.tipoalloggio}"/>

            <label for="costoalloggio"> Costo per giorno:  </label>
            <input type="text" name="costoalloggio" id="costoalloggio" value="{$citta.costoalloggio}"/>
            <select name="valuta" value="{$citta.valuta}">
                <optgroup label="Scegli il tipo di valuta" >
                    <option value="Euro" {if $citta.valuta=="Euro"}selected {/if}> € </option>
                    <option value="Yen Giapponese" {if $citta.valuta=="Yen Giapponese"}selected {/if}> ¥ </option>
                    <option value="Dollaro US" {if $citta.valuta=="Dollaro US"}selected {/if}> $ USA </option>
                    <option value="Dollaro AU" {if $citta.valuta=="Dollaro AU"}selected {/if}> $ AUS </option>
                    <option value="HUF Ungheria" {if $citta.valuta=="HUF Ungheria"}selected {/if}> Ft HUF </option>
            </select>
            {if $messaggi.costoalloggio != false || $messaggi.costo_budget || $messaggi.campocostoalloggio }
                <p class="error">
                    {if $messaggi.costoalloggio != 'false'} {$messaggi.costoalloggio}  {/if}
                    {if $messaggi.costo_budget != 'false'} {$messaggi.costo_budget}  {/if}
                    {if $messaggi.campocostoalloggio != 'false'} {$messaggi.campocostoalloggio}  {/if}
                </p>
            {/if}

            <br>

            <label for="voto" >Voto alla citt&agrave;: </label>
            <select name="voto" value="{$citta.voto}">
                <option value="1" {if $citta.voto=="1"}selected {/if}> 1 </option>
                <option value="2" {if $citta.voto=="2"}selected {/if}> 2 </option>
                <option value="3" {if $citta.voto=="3"}selected {/if}> 3 </option>
                <option value="4" {if $citta.voto=="4"}selected {/if}> 4 </option>
                <option value="5" {if $citta.voto=="5"}selected {/if}> 5 </option>
                <option value="6" {if $citta.voto=="6"}selected {/if}> 6 </option>
                <option value="7" {if $citta.voto=="7"}selected {/if}> 7 </option>
                <option value="8" {if $citta.voto=="8"}selected {/if}> 8 </option>
                <option value="9" {if $citta.voto=="9"}selected {/if}> 9 </option>
                <option value="10" {if $citta.voto=="10"}selected {/if}> 10 </option>
            </select>


            <input type="hidden" name="controller" value= {$controller} />
            <input type="hidden" name="task" value= {$task} />
            <input type="submit" class="submit" name="submit" value="conferma" id="j_submit" />
            <input type="reset" name="cancella" value="cancella" id="j_reset" />
            <input type="hidden" name="idviaggio" value= "{$idviaggio}" />

            <br>
            <br>

            <div id="campo_obbligatorio">* Campo Obbligatorio</div>

        </form>
    </div>
</div>