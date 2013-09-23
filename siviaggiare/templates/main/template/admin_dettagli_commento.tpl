<div class=content>
    <h3>Dettagli commento segnalato</h3>
        <div class=form_settings>
                <h3>ID del Viaggio {$commento->idviaggio}</h3>
                 <table>
                     <tr>
                         <td> Autore del messaggio:</td><td> {$commento->autore} </td>
                     </tr>
                    <tr>
                            <td> Nome Luogo:</td><td> {$commento->nomeluogo} </td>
                        </tr>
                    <tr>
                            <td> Nome Citt&agrave;:</td><td> {$commento->nomecitta} </td>
                        </tr>
                    <tr>
                            <td> Testo:</td><td> {$commento->testo} </td>
                        </tr>
                    <tr>
                            <td> Voto:</td><td> {$commento->voto} </td>
                        </tr>
                </table>
                    <form method="post"action="index.php" class="left">
                        <input type="hidden" name="controller" value="amministrazione" />
                        <input type="hidden" name="task" value="segnalazioni" />
                        <input type="submit" value="Indietro" />
                        <input type="submit" value="Modifica Commento" /><!--non funziona-->
                        <input type="submit" value="Elimina Commento" /><!--non funziona-->
                    </form>
            </div>
    </div>