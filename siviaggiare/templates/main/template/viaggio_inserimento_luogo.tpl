<div class="content">
    <div class="form_settings">
        <form method="post" action="index.php">
            <p class="error" > {$errore}</p>
            <h3>Inserimento Luogo</h3>
                <table>
                    <tr>
                        <td><h4>Autore:</h4></td>
                        <td><h4>{$autore}</h4></td>
                    </tr>
                    <tr>
                        <td><h4>IdViaggio:</h4></td>
                        <td><h4>{$idviaggio}</h4></td>
                    </tr>
                    <tr>
                        <td><h4>Nome:</h4></td>
                        <td><input type="text" name="nome" value="{$luogo.nome}"/></td>
                        {if $messaggi.nome != false}
                            <td class="error">
                                {if $messaggi.nome != 'false'} {$messaggi.nome}  {/if}
                            </td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h4>Citt&agrave;:</h4></td>
                        <td><input type="text" name="nomecitta" value="{$luogo.citta}"/></td>
                        {if $messaggi.citta != false}
                            <td class="error">
                                {if $messaggi.citta != 'false'} {$messaggi.citta}  {/if}
                            </td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h4>Sito Web:</h4></td>
                        <td><input type="text" name="sitoweb" value="{$luogo.sito}"/></td>
                        {if $messaggi.sito != false}
                            <td class="error">
                                {if $messaggi.sito != 'false'} {$messaggi.sito}  {/if}
                            </td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h4>Percorso:</h4></td>
                        <td><input type="text" name="percorso"/></td>
                    </tr>
                    <tr>
                        <td><h4>Costo del Biglietto:</h4></td>
                        <td><input type="text" name="costobiglietto" value="{$luogo.costobiglietto}"/></td>
                        {if $messaggi.costobiglietto != false}
                            <td class="error">
                                {if $messaggi.costobiglietto != 'false'} {$messaggi.costobiglietto}  {/if}
                            </td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h4>Guida Turistica:</h4></td>
                        <td><input type="text" name="guida" value="{$luogo.guidaturistica}"/></td>
                        {if $messaggi.guidaturistica != false}
                            <td class="error">
                                {if $messaggi.guidaturistica != 'false'} {$messaggi.guidaturistica}  {/if}
                            </td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h4>Coda:</h4></td>
                        <td><select name="coda">
                                <option value="minima"> minima </option>
                                <option value="media"> media </option>
                                <option value="alta"> alta </option>
                        </td>
                    </tr>
                    <tr>
                        <td><h4>Durata della visita:</h4></td>
                        <td><input type="text" name="durata" value="{$luogo.duratavisita}"/></td>
                        {if $messaggi.duratavisita != false}
                            <td class="error">
                                {if $messaggi.duratavisita != 'false'} {$messaggi.duratavisita}  {/if}
                            </td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h4>Commento:</h4></td>
                        <td><textarea name="commento""/></textarea></td>
                    </tr>
                </table>
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="salva_luogo" />
            <input type="submit" name="submit" class="submit" value="Ok" />
        </form>
    </div>
</div>