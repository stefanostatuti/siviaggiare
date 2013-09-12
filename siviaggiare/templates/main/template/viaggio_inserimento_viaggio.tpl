<div class="content">
    <div class="form_settings">
        <form method="post" action="index.php">
            <p class="error" > {$errore}</p>
            <h2>Crea un nuovo viaggio</h2>
            <table>
                <tr>
                    <td><h4>Autore:</h4></td><td><h5>{$autore}</h5></td>
                </tr>
                <tr>
                    <td><h4>Periodo</h4></td>
                    <td>
                        <h6>Inizio:</h6><input type="datetime-local" name="datainizio" id="datainizio" value="{$viaggio.datainizio}"/>
                        <br>
                        <br>
                        <h6>Fine:</h6> <input type="datetime" name="datafine" id="datainizio" value="{$viaggio.datafine}"/>
                    {if $messaggi.datainizio!= false || $messaggi.datafine!= false || $messaggi.date != false }
                    <td class="error">
                        {if $messaggi.datainizio != 'false'} {$messaggi.datainizio}  {/if}
                        {if $messaggi.datafine != 'false'} {$messaggi.datafine}  {/if}
                        {if $messaggi.date != 'false'} {$messaggi.date}  {/if}
                    </td>
                    {/if}
                </tr>
                <tr>
                    <td><h4>Mezzo di trasporto: </h4></td>
                    <td>
                        <select name="mezzotrasporto" class="left">
                            <optgroup label="Tipo di trasporto" >
                                <option value="Autobus"> Autobus </option>
                                <option value="Macchina"> Macchina </option>
                                <option value="Aereo"> Aereo </option>
                                <option value="Nave"> Nave </option>
                                <option value="Traghetto"> Traghetto </option>
                                <option value="Moto"> Moto </option>
                                <option value="Camper"> Camper </option>
                                <option value="Bicicletta"> Bicicletta </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Costo del trasporto: </h4></td>
                    <td>
                        <input type="text" name="costotrasporto" value="{$viaggio.costotrasporto}"/>
                    </td>
                    {if $messaggi.costotrasporto != false}
                    <td class="error">
                        {if $messaggi.costotrasporto != 'false'} {$messaggi.costotrasporto}  {/if}
                    </td>
                    {/if}
                </tr>
                <tr>
                    <td>
                        <h4>Budget: </h4>
                    </td>
                    <td>
                        <input type="text" name="budget" value="{$viaggio.budget}"/>
                    </td>
                    {if $messaggi.budget != false || $messaggi.costo_budget != false}
                    <td class="error">
                        {if $messaggi.budget != 'false'} {$messaggi.budget}  {/if}
                        {if $messaggi.costo_budget != 'false'} {$messaggi.costo_budget}  {/if}
                    </td>
                    {/if}
                </tr>
            </table>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="salva_viaggio" />
            <input type="submit" class="submit" name="submit" value="conferma" />
        </form>
    </div>
</div>