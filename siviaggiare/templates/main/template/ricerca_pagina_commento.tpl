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
                        <td><a class="button-profilo" href="javascript:void(0)" utente="{$utente}" pagina="3"><h6>{$utente}</h6></a></td>
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
                    {if $autenticato!=false && $rilasciato_luogo==false && $autenticato!=$utente}
                        <td><a class="aggiungi-feedback-luogo" href="javascript:void(0)" idviaggio="{$luogo->idviaggio}" citta="{$luogo->nomecitta}" luogo="{$luogo->nome}"><h6>Aggiungi un feedback</h6></a></td>
                    {/if}
                </tr>
                </table>
            <table>
            {if $luogo->commentolibero!='' }
                    <tr>
                        <td><h6>Commento dell'autore:</h6></td>
                    </tr>
                <tr>
                    <td><fieldset><h6>{$luogo->commentolibero}</h6></fieldset></td>
                </tr>
                    {/if}
                    {if $luogo->immagini != ''}
                        <tr>
                            <td><img id="immagine_luogo" src="templates/main/template/images/foto_luogo/{$luogo->immagini}"></td>
                        </tr>
                    {/if}
                    {if $autenticato!=false && $utente!=$autenticato}
                        <tr>
                            <td><a class="button-segnalazione-luogo" href="javascript:void(0)" nomeutente="{$autenticato}" idviaggio="{$luogo->idviaggio}" nomecitta="{$luogo->nomecitta}" nomeluogo="{$luogo->nome}"><h6>Invia segnalazione</h6></a></td>
                            <div id="SegnalazioneLuogo" title="Esprimi una motivazione:" hidden="">
                                <textarea placeholder="Inserisci qui il tuo commento..." maxlength="1024" id="LuogoCommentoSegnalazione"></textarea>
                            </div>
                        </tr>

                    {/if}
            </table>
        </div>
    </div>
    <br><br>
    <div class="commenti-utenti-ext">
        {section name=commenti loop=$luogo->_elenco_commenti}
            <div class="commenti-utenti" id="{$luogo->_elenco_commenti[commenti]->id}">
                <h4>{$luogo->_elenco_commenti[commenti]->autore} ha scritto:</h4>
                <h6>{$luogo->_elenco_commenti[commenti]->testo}</h6>
                <h5>Voto: {$luogo->_elenco_commenti[commenti]->voto}</h5>
                {if $autenticato!=false && $luogo->_elenco_commenti[commenti]->autore!=$autenticato}
                     <a id="{$luogo->_elenco_commenti[commenti]->id}" class="button-segnalazione-commento" href="javascript:void(0)" nomeutente="{$autenticato}" idcommento="{$luogo->_elenco_commenti[commenti]->id}" autorecommento="{$luogo->_elenco_commenti[commenti]->autore}"><h6>Invia segnalazione</h6></a>
                        <div id="{$luogo->_elenco_commenti[commenti]->id}" class="SegnalazioneCommento" title="Esprimi una motivazione:" hidden="">
                            <textarea placeholder="Inserisci qui il tuo commento..." maxlength="1024"></textarea>
                        </div>
                {/if}
            </div>
            <br>
        {/section}
    </div>
    <div id="commento-inserito"></div>
        {$inserimento_commento}
</div>

<br><br>

<div class="ricerca-navigazione3">
    <button id="prev">Indietro</button><button id="home">Home</button>
</div>