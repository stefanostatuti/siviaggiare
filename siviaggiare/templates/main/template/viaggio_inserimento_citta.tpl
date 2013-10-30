<div class="content">
    <div class="form_settings">
        <script type="text/javascript" src="templates/main/template/js/datepicker.js"></script>
        <script type="text/javascript" src="templates/main/template/js/date.js"></script>
        <script type="text/javascript" src="templates/main/template/js/validation_citta.js"></script>
        <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
        <form method="post" action="index.php" id="form_journey">
            <div id="form_journey" class="error" > {$errore}</div>
            <legend id="form_journey"><h4>Nuova citt&agrave; : </h4></legend>

            <label for="autore">Autore :</label>{$autore}

            <label for="IdViaggio">IdViaggio :</label>{$idviaggio}


            <br>
            <br>

            <fieldset class="data">
                <legend >Periodo* :</legend>
                <label>Inizio :</label>
                <input type="datetime-local" name="datainizio" id="datainizio" value="{$citta.datainizio}" class="data" />
                {if $messaggi.datainizio != false || $messaggi.campodatainizio != false}
                    <p class="error">
                        {if $messaggi.datainizio != 'false'} {$messaggi.datainizio}  {/if}
                        {if $messaggi.campodatainizio != 'false'} {$messaggi.campodatainizio}  {/if}
                    </p>
                {/if}

                <label>Fine :</label>
                <input type="datetime-local" name="datafine" value="{$citta.datafine}" id="datafine" class="data" />
                {if $messaggi.datafine != false || $messaggi.campodatafine != false || $messaggi.dateviaggio != false}
                    <p class="error">
                        {if $messaggi.datafine != 'false'} {$messaggi.datafine}  {/if}
                        {if $messaggi.campodatafine != 'false'} {$messaggi.campodatafine}  {/if}
                        {if $messaggi.dateviaggio != 'false'} {$messaggi.dateviaggio}  {/if}
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
                    <option value="Euro"> € </option>
                    <option value="Yen Giapponese"> ¥ </option>
                    <option value="Dollaro US"> $ USA </option>
                    <option value="Dollaro AU"> $ AUS </option>
                    <option value="HUF Ungheria"> Ft HUF </option>
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
            <select name="voto" value="{$citta.voto}>
                            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
            <option value="3"> 3 </option>
            <option value="4"> 4 </option>
            <option value="5"> 5 </option>
            <option value="6"> 6 </option>
            <option value="7"> 7 </option>
            <option value="8"> 8 </option>
            <option value="9"> 9 </option>
            <option value="10"> 10 </option>
            </select>


            <input type="hidden" name="controller" value= {$controller} />
            <input type="hidden" name="task" value= {$task} />
            <input type="submit" class="submit" name="submit" value="conferma" id="j_submit" />
            <input type="reset" name="cancella" value="cancella" id="j_reset" />
            <input type="hidden" name="idviaggio" value= "{$idviaggio}" />

        </form>
    </div>
</div>