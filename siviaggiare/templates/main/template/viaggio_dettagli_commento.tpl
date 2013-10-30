<div class=content id="form_journey">
        <div class=form_settings>
                <h3>Commento</h3>
                 <table id="form_journey">
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
                            <input type="hidden" name="controller" value="aggiunta_viaggio" />
                            <input type="hidden" name="task" value="visualizza_commenti_inseriti" />
                            <input type="hidden" name="idviaggio" value="{$commento->idviaggio}" />
                            <input type="hidden" name="nomecitta" value="{$commento->nomecitta}" />
                            <input type="hidden" name="nomeluogo" value="{$commento->nomeluogo}" />
                            <input type="submit" class="submit" value="Indietro" id="j_submit" />
                        </form>
            </div>
    </div>