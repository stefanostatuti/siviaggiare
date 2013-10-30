<div class="commento-ext">
    <div class="commento-int">
        <h4>{$luogo->nome}</h4>
        <div>
            <table>
                <tr>
                    <td><h6>Sito Web:</h6></td> <td><h6>{$luogo->sitoweb}</h6></td>
                </tr>
                <tr>
                    <td><h6>Come raggiungerlo:</h6></td> <td><h6>{$luogo->percorso}</h6></td>
                </tr>
                <tr>
                    <td><h6>Costo biglietto:</h6></td> <td><h6>{$luogo->costobiglietto}</h6></td>
                </tr>
                <tr>
                    <td><h6>Guida Turistica:</h6></td> <td><h6>{$luogo->guida}</h6></td>
                </tr>
                <tr>
                    <td><h6>Coda all'entrata:</h6></td> <td><h6>{$luogo->coda}</h6></td>
                </tr>
                <tr>
                    <td><h6>Durata della visita:</h6></td> <td><h6>{$luogo->durata}</h6></td>
                </tr>
                <tr>
                    <td><span class="feedback-luogo">{$luogo->feedback}</span></td>
                </tr>
                <tr>
                    <td><h6>Commento dell'autore:</h6></td>
                </tr>
                <tr>
                    <td><h6>{$luogo->commentolibero}</h6></td>
                </tr>
            </table>
        </div>
    </div>
    <br><br>
        {section name=commenti loop=$luogo->_elenco_commenti}
            <div class="commenti-utenti">
                <h4>{$luogo->_elenco_commenti[commenti]->autore} ha scritto:</h4>
                <h6>{$luogo->_elenco_commenti[commenti]->testo}</h6>
                <h5>Voto: {$luogo->_elenco_commenti[commenti]->voto}</h5>
            </div>
            <br>
        {/section}
    <div id="commento-inserito"></div>
        {$inserimento_commento}
</div>

<br><br>

<div class="ricerca-navigazione3">
    <button id="prev">Indietro</button><button id="home">Home</button>
</div>