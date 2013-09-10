<a id="anchor-contact-1"></a>
<div class="corner-content-1col-top"></div>
<div class="content-1col-nobox">
    <h1 class="Nuova Citta">Modulo di registrazione Nuova Citta</h1>
    <div class="contactform">
        <form method="post" action="index.php">
            <fieldset>
                <legend>&nbsp;Crea Nuova Citta&nbsp;</legend>

                <p><label for="autore" class="left">Autore: {$autore}</label>
                <p><label for="data" class="left">Periodo</label>
                    <br>
                    data inizio : <input type="datetime-local" name="datainizio" id="datainizio"/></p>
                    data fine:  <input type="datetime" name="datafine" id="datafine"/></p>

                <p><label for="citta" class="left">Citta Visitata: </label>
                    <input type="text" name = "citta" id= "citta"/></p>

                <p><label for="stato" class="left">Stato: </label>
                    <input type="text" name = "stato" id= "stato"/></p>

                <p><label for="tipoalloggio" class="left">Tipo di alloggio: </label>
                    <input type="text" name="tipoalloggio" id="tipoalloggio"/>
                </p>

                <p><label for="costo" class="left">Costo per giorno: </label>
                    <input type="text" name="costo" id="costo"/></p>

                <p><label for="voto" class="left">Voto alla città: </label>
                    <select name="voto" id="voto" style="width:100px">
                        <optgroup label="Voto che dai alla Citta">
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
                    </select></p>
                <p>
            </fieldset>
            <input type="hidden" name="controller" value="aggiunta_citta" />
            <input type="hidden" name="task" value="salva_citta" />
            <p><input type="submit" name="submit" id="submit_1" class="button" value="Avanti" /></p>
            </fieldset>
        </form>
    </div>
</div>
<div class="corner-content-1col-bottom"></div>