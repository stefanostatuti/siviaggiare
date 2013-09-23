<div class=content>
    <div class=form_settings>
        <h3>luogo segnalato</h3>
        <h3>Luogo: {$luogo->id} </h3>
        <table>
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
                <td> Costo del Biglietto:</td><td> {$luogo->costobiglietto} </td>
            </tr>
            <tr>
                <td> Guida Turistica:</td><td> {$luogo->guida} </td>
            </tr>
            <tr>
                <td> Coda:</td><td> {$luogo->coda} </td>
            </tr>
            <tr>
                <td> Durata Visita:</td><td> {$luogo->durata} </td>
            </tr>
            <tr>
                <td> Commento Personale:</td><td> {$luogo->commentolibero} </td>
            </tr>
        </table>
        <form method="post"action="index.php" class="left">
            <input type="hidden" name="controller" value="amministrazione" />
            <input type="hidden" name="task" value="segnalazioni" />
            <input type="submit" value="Indietro" />
            <input type="submit" value="Modifica Luogo" /><!--non funziona-->
            <input type="submit" value="Elimina Luogo" /><!--non funziona-->
        </form>
    </div>
</div>