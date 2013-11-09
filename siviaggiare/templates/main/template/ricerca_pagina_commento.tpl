<script type="text/javascript" src="templates/main/template/js/show_char_limit.js"></script>
<div class="commento-ext">
    <div class="commento-int">
        <h4>{$luogo->nome}</h4>
        <div>
            <table>
                <tr>
                    <td><h6>Autore:</h6></td>
                    {if $autenticato!=false && $utente==$autenticato}
                        <td><a href="index.php?controller=profilo&task=visualizza"><h6>{$utente}</h6></a></td>
                    {elseif $autenticato!=false}
                        <td><a class="button-profilo" href="javascript:void(0)" utente="{$utente}"><h6>{$utente}</h6></a></td>
                    {else}
                        <td><h6>{$utente}</h6></td>
                    {/if}
                </tr>
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
                    <td><h6>Feedback:</h6></td><td><span class="feedback-luogo"><h6>{$luogo->feedback}</h6></span></td>
                    {if $autenticato!=false}
                        <td><a class="aggiungi-feedback-luogo" href="javascript:void(0)" idviaggio="{$luogo->idviaggio}" citta="{$luogo->nomecitta}" luogo="{$luogo->nome}"><h6>Aggiungi un feedback</h6></a></td>
                    {/if}
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