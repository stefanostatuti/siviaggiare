
DA COMINCIARE!!!!


<div class="content">
    <div class="form_settings">
        <form method="post" action="index.php">
            <p class="error" > {$errore}</p>
            <h2>Crea Nuova Citta</h2>
            <table>
                <tr>
                    <td><h4>Autore:</h4></td><td><h5>{$autore}</h5></td>
                </tr>
                <tr>
                    <td><h4>IdViaggio:</h4></td>
                    <td><h5>{$idviaggio}</h5></td>
                </tr>
                <tr>
                    <td><h4>Periodo</h4></td>
                    <td>
                        <h6>Inizio:</h6><input type="datetime-local" name="datainizio" id="datainizio" value="{$citta.datainizio}"/>
                        <h6>fine:</h6> <input type="datetime" name="datafine" id="datainizio" value="{$citta.datafine}"/>
                        {if $messaggi.datainizio != false || $messaggi.datafine != false || $messaggi.date != false }
                    <td class="error">
                        {if $messaggi.datainizio != 'false'} {$messaggi.datainizio}  {/if}
                        {if $messaggi.datafine != 'false'} {$messaggi.datafine}  {/if}
                        {if $messaggi.date != 'false'} {$messaggi.date}  {/if}
                    </td>
                    {/if}
                </tr>
                <tr>
                    <td>
                        <h4>Citt&agrave; visitata: </h4></td>
                    <td>
                        <input type="text" name="nome" value="{$citta.nome}"/>
                    </td>
                    {if $messaggi.nome != false}
                        <td class="error">
                            {if $messaggi.nome != 'false'} {$messaggi.nome}  {/if}
                        </td>
                    {/if}
                </tr>
                <tr>
                    <td>
                        <h4>Stato: </h4></td>
                    <td>
                        <input type="text" name="stato" value="{$citta.stato}"/>
                    </td>
                    {if $messaggi.stato != false}
                        <td class="error">
                            {if $messaggi.stato != 'false'} {$messaggi.stato}  {/if}
                        </td>
                    {/if}
                </tr>
                <tr>
                    <td>
                        <h4>Tipo di alloggio: </h4></td>
                    <td>
                        <input type="text" name="tipoalloggio" value="{$citta.tipoalloggio}"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Costo per giorno: </h4></td>
                    <td>
                        <input type="text" name="costo" value="{$citta.costoalloggio}"/>
                    </td>
                    {if $messaggi.costoalloggio != false || $messaggi.costo_budget }
                        <td class="error">
                            {if $messaggi.costoalloggio != 'false'} {$messaggi.costoalloggio}  {/if}
                            {if $messaggi.costo_budget != 'false'} {$messaggi.costo_budget}  {/if}
                        </td>
                    {/if}
                </tr>
                <tr>
                    <td><h4>Voto alla citt&agrave;: </h4></td>
                    <td>
                        <select name="voto">
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
                    </td>
                </tr>
            </table>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="salva_citta" />
            <input type="submit" class="submit" name="submit" value="conferma" />
        </form>
    </div>
</div>