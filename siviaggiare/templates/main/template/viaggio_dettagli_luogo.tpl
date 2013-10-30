<div class=content id="form_journey">
    <div class=form_settings>
        <h3>Luogo: </h3>
        <table id="form_journey">
            <tr>
                <td> Nome:</td><td>{$luogo->nome} </td>
            </tr>
            <tr>
                <td> Citt&agrave;:</td><td> {$luogo->nomecitta} </td>
            </tr>
            <tr>
                <td> Sito Web:</td><td> {$luogo->sitoweb} </td>
            </tr>
            <tr>
                <td> Percorso:</td><td> {$luogo->percorso} </td>
            </tr>
            <tr>
                <td> Costo del Biglietto:</td><td> {$luogo->costobiglietto} {$luogo->valuta} </td>
            </tr>
            <tr>
                <td> Guida Turistica:</td><td> {$luogo->guida} </td>
            </tr>
            <tr>
                <td> Coda:</td><td> {$luogo->coda} </td>
            </tr>
            <tr>
                <td> Durata Visita:</td><td> {$luogo->durata} minuti </td>
            </tr>
            <tr>
                <td> Commento Personale:</td><td> {$luogo->commentolibero} </td>
            </tr>
            <tr>
                <td><a href="?controller=aggiunta_viaggio&task=visualizza_commenti_inseriti&idviaggio={$luogo->idviaggio}&nomecitta={$luogo->nomecitta}&nome={$luogo->nome}"<h5>Vedi i commenti degli altri utenti</h5></a></td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="aggiunta_viaggio" />
            <input type="hidden" name="task" value="visualizza_luoghi_inseriti" />
            <input type="hidden" name="idviaggio" value="{$luogo->idviaggio}" />
            <input type="hidden" name="nome" value="{$luogo->nomecitta}" />
            <input type="submit" class="submit" value="Indietro" id="j_submit"/>
        </form>

        <div class="modifica"><a href="?controller=modifica&task=modifica_luogo&idviaggio={$luogo->idviaggio}&nomecitta={$luogo->nomecitta}&nomeluogo={$luogo->nome}">modifica</a></div>
        <br>
        <br>
        <div class="modifica"><a href="?controller=modifica&task=elimina_luogo&idviaggio={$luogo->idviaggio}&nomecitta={$luogo->nomecitta}&nomeluogo={$luogo->nome}">elimina</a></div>
    </div>
</div>