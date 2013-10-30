<div class="dettaglio-viaggio-ext">
    <h2>Informazioni sul viaggio</h2>
        <div>
            <table>
                <tr>
                    <td><h6>Utente:</h6></td>   <td><h6>{$viaggio->utenteusername}</h6></td>
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
            </table>
        </div>
    <h2>Citt&agrave; visitate</h2>
    <div class="citta-visitate">
        {section name=citta loop=$viaggio->_elenco_citta}
            <div id={$viaggio->_elenco_citta[citta]->nome}>
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
                    <td><span class="feedback-citta">{$viaggio->_elenco_citta[citta]->feedback}</span></td>
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
                                    <td><span class="feedback-luogo">{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->feedback}</span></td>
                                </tr>
                                <tr>
                                    <td><h6>Commento dell'autore:</h6></td> <td><h6>{$viaggio->_elenco_citta[citta]->_elenco_luoghi[nr]->commentolibero}</h6></td>
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