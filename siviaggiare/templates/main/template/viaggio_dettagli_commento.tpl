<div class=content>
    <div class=form_settings>
        <h3>Viaggio {$commento->idviaggio}</h3>
         <table>
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
                <input type="submit" class="submit" value="Indietro" />
            </form>
    </div>
</div>