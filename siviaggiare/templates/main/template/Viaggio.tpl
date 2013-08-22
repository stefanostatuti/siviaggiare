<a id="anchor-contact-1"></a>
<div class="corner-content-1col-top"></div>
<div class="content-1col-nobox">
    <h1 class="Nuovo Viaggio">Modulo di registrazione Nuovo Viaggio</h1>
    <div class="contactform">
        <form method="post" action="index.php">
            <fieldset>
                <legend>&nbsp;Crea Nuovo Viaggio&nbsp;</legend>

                <p><label for="autore" class="left">Autore: {$autore}</label>
                <p><label for="data" class="left">Periodo</label>
                    <br>
                    data inizio : <input type="datetime-local" name="datainizio" id="datainizio"/></p>
                    data fine:  <input type="datetime" name="datafine" id="datainizio"/></p>
                <p><label for="mezzotrasporto" class="left">Mezzo di trasporto: </label>
                   <select name="mezzotrasporto" id="mezzotrasporto" style="width:100px">
                        <optgroup label="Tipo di trasporto">
                        <option value="Autobus"> Autobus </option>
                        <option value="Macchina"> Macchina </option>
                        <option value="Aereo"> Aereo </option>
                        <option value="Nave"> Nave </option>
                        <option value="Traghetto"> Traghetto </option>
                        <option value="Moto"> Moto </option>
                        <option value="Camper"> Camper </option>
                        <option value="Bicicletta"> Bicicletta </option>
                        <option value="Astronave"> Astronave </option>
                   </select></p>
                <p>
                    <label for="costotrasporto" class="left">Costo del trasporto: </label>
                    <input type="text" name="costotrasporto" id="costotrasporto"/>
                </p>


                <p><label for="budget" class="left">Budget: </label>
                    <input type="text" name="budget" id="budget"/></p>
            </fieldset>
                <input type="hidden" name="controller" value="aggiunta_viaggio" />
                <input type="hidden" name="task" value="salvaviaggio" />
                <p><input type="submit" name="submit" id="submit_1" class="button" value="Avanti" /></p>
            </fieldset>
        </form>
    </div>
</div>
<div class="corner-content-1col-bottom"></div>