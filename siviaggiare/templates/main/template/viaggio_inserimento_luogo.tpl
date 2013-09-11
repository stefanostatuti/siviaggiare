<div class="content">
    <div class="form_settings">
        <form method="post" action="index.php">
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
                        <td><input type="text" name="nome"/></td>
                    </tr>
                    <tr>
                        <td><h4>Citt&agrave;:</h4></td>
                        <td><input type="text" name="nomecitta"/></td>
                    </tr>
                    <tr>
                        <td><h4>Sito Web:</h4></td>
                        <td><input type="text" name="sitoweb""/></td>
                    </tr>
                    <tr>
                        <td><h4>Percorso:</h4></td>
                        <td><input type="text" name="percorso""/></td>
                    </tr>
                    <tr>
                        <td><h4>Costo del Biglietto:</h4></td>
                        <td><input type="text" name="costobiglietto""/></td>
                    </tr>
                    <tr>
                        <td><h4>Guida Turistica:</h4></td>
                        <td><input type="text" name="guida""/></td>
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
                        <td><input type="text" name="durata""/></td>
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