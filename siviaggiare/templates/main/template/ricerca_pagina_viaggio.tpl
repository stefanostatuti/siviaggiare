<div class="dettaglio-viaggio-ext">
    <h2>Informazioni sul viaggio</h2>
        <div>
            <table>
                <tr>
                    <td><h6>Autore:</h6></td>
                    {if $autenticato!=false && $viaggio->utenteusername==$autenticato}
                        <td><a href="index.php?controller=profilo&task=visualizza"><h6>{$viaggio->utenteusername}</h6></a></td>
                    {elseif $autenticato!=false}
                        <td><a class="button-profilo" href="javascript:void(0)" utente="{$viaggio->utenteusername}" pagina="2"><h6>{$viaggio->utenteusername}</h6></a></td>
                    {else}
                        <td><h6>{$viaggio->utenteusername}</h6></td>
                    {/if}
                </tr>
                <tr>
                    <td><h6>Periodo:</h6></td>   <td><h6>Dal: {$viaggio->datainizio}</h6> <h6>Al: {$viaggio->datafine}</h6></td>
                </tr>
                <tr>
                    <td><h6>Spesa totale:</h6></td>   <td><h6>{$viaggio->budget}</h6></td>
                </tr>
                <tr>
                    <td><h6>Mezzo di trasporto:</h6></td>   <td><h6>{$viaggio->mezzotrasporto}</h6></td>
                </tr>
                <tr>
                    <td><h6>Costo:</h6></td>   <td><h6>{$viaggio->costotrasporto}</h6></td>
                </tr>
                {if $autenticato!=false && $viaggio->utenteusername!=$autenticato}
                <tr>
                    <td><a class="button-segnalazione-viaggio" href="javascript:void(0)" utente="{$autenticato}" idviaggio="{$viaggio->id}"><h6>Invia segnalazione</h6></a></td>
                    <div id="SegnalazioneViaggio" title="Esprimi una motivazione:" hidden="">
                        <textarea placeholder="Inserisci qui il tuo commento..." maxlength="1024" id="ViaggioCommentoSegnalazione"></textarea>
                    </div>
                </tr>
                {/if}
            </table>
        </div>
    <h2>Citt&agrave; visitate</h2>
    <div class="citta-visitate">
        {section name=citta loop=$viaggio->_elenco_citta}
            <div id="{$viaggio->_elenco_citta[citta]->nome|regex_replace:"/[\ \']/":''}">
        <h3>{$viaggio->_elenco_citta[citta]->nome}</h3>
        <div class="citta-visitate-int">
        <h4>Informazioni sulla citt&agrave;</h4>
        <div>
            <table>
                <tr>
                    <td><h6>Stato:</h6></td>    <td><h6>{$viaggio->_elenco_citta[citta]->stato}</h6></td>
                </tr>
                <tr>
                    <td><h6>Periodo:</h6></td>   <td><h6>Dal: {$viaggio->_elenco_citta[citta]->datainizio}</h6> <h6>Al: {$viaggio->_elenco_citta[citta]->datafine}</h6></td>
                </tr>
                <tr>
                    <td><h6>Tipo di alloggio:</h6></td>   <td><h6>{$viaggio->_elenco_citta[citta]->tipoalloggio}</h6></td>
                </tr>
                <tr>
                    <td><h6>Costo dell'alloggio:</h6></td>   <td><h6>{$viaggio->_elenco_citta[citta]->costoalloggio}</h6></td>
                </tr>
                <tr>
                    <td><h6>Voto dell'utente:</h6></td>   <td><h6>{$viaggio->_elenco_citta[citta]->voto}</h6></td>
                </tr>
                <tr>
                    <td><h6>Feedback:</h6></td>   <td><span class="feedback-citta"><h6>{$viaggio->_elenco_citta[citta]->feedback}</h6></span></td>
                    {if $autenticato!=false && $rilasciato_citta[citta]==false && $autenticato!=$viaggio->utenteusername}
                        <td><a id="{$viaggio->_elenco_citta[citta]->nome|regex_replace:"/[\ \']/":''}" class="aggiungi-feedback-citta" href="javascript:void(0)" idviaggio="{$viaggio->id}" citta="{$viaggio->_elenco_citta[citta]->nome}" stato="{$viaggio->_elenco_citta[citta]->stato}"><h6>Aggiungi un feedback</h6></a></td>
                    {/if}
                {if $autenticato!=false && $viaggio->utenteusername!=$autenticato}
                    <tr>
                        <td><a id="{$viaggio->_elenco_citta[citta]->nome|regex_replace:"/[\ \']/":''}" class="button-segnalazione-citta" href="javascript:void(0)" utente="{$autenticato}" idviaggio="{$viaggio->id}" nomecitta="{$viaggio->_elenco_citta[citta]->nome}"><h6>Invia segnalazione</h6></a></td>

                        <div id="{$viaggio->_elenco_citta[citta]->nome|regex_replace:"/[\ \']/":''}" class="SegnalazioneCitta" title="Esprimi una motivazione:" hidden="">
                            <textarea placeholder="Inserisci qui il tuo commento..." maxlength="1024"></textarea>
                        </div>
                    </tr>
                {/if}
                </tr>
                </table>
        </div>
                <h4>Luoghi visitati</h4>
                <div class="luoghi-visitati-int">
                    {section name=nr loop=$viaggio->_elenco_citta[citta]->_elenco_luoghi}
                        <h5>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->nome}</h5>
                        <div>
                            <table>
                                <tr>
                                    <td><h6>Sito Web:</h6></td> <td><h6>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->sitoweb}</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Come raggiungerlo:</h6></td> <td><h6>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->percorso}</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Costo biglietto:</h6></td> <td><h6>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->costobiglietto}</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Guida Turistica:</h6></td> <td><h6>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->guida}</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Coda all'entrata:</h6></td> <td><h6>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->coda}</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Durata della visita:</h6></td> <td><h6>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->durata}</h6></td>
                                </tr>
                                <tr>
                                    <td><h6>Feedback:</h6></td> <td><span class="feedback-luogo">{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->feedback}</span></td>
                                </tr>
                                <td><a class="loadCommento" href="javascript:void(0)" idviaggio="{$viaggio->id}" citta="{$viaggio->_elenco_citta[citta]->nome}" luogo="{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->nome}"><h6>Vedi i commenti</h6></a></td>
                                </tr>
                            </table>
                        </div>
                    {/section}
                </div>
            </div>
        </div>
    {/section}
    </div>
</div>

<br><br>

    <div class="ricerca-navigazione2">
        <button id="prev">Indietro</button><button id="home">Home</button><button id="next">Avanti</button>
    </div>