<div class="content">
    <div class="form_settings">
        <script type="text/javascript" src="templates/main/template/js/validation_luogo.js"></script>
        <form method="post" action="index.php" id="form_journey">
            <div id="form_journey" class="error" > {$errore}</div>


            <legend id="form_journey"><h4>Nuovo Luogo : </h4></legend>

            <label for="autore">Autore :</label>{$autore}

            <label for="IdViaggio">IdViaggio :</label>{$idviaggio}

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
                    <option value="Euro"> € </option>
                    <option value="Yen Giapponese"> ¥ </option>
                    <option value="Dollaro US"> $ USA </option>
                    <option value="Dollaro AU"> $ AUS </option>
                    <option value="HUF Ungheria"> Ft HUF </option>
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
                <option value="minima"> minima </option>
                <option value="media"> media </option>
                <option value="alta"> alta </option>
            </select>

            <label for="durata">Durata Della Visita :</label>
            <input type="text" name="durata" id="durata" value="{$luogo.duratavisita}"/>
            {if $messaggi.duratavisita != false}
                <p class="error">
                    {if $messaggi.duratavisita != 'false'} {$messaggi.duratavisita}  {/if}
                </p>
            {/if}

            <label for="commentolibero">Commento :</label>
            <textarea name="commentolibero" id="commentolibero" value="{$luogo.commento}"/></textarea>


            <input type="hidden" name="controller" value= {$controller}  />
            <input type="hidden" name="task" value= {$task}  />
            <input type="submit" name="submit" class="submit" value="conferma" id="j_submit" />
            <input type="reset"  name="cancella" value="cancella" id="j_reset" />
            <input type="hidden" name="idviaggio" value= "{$idviaggio}" />

        </form>
    </div>
</div>