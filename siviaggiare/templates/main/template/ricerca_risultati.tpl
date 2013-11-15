<div class="luoghi-panoramica-ext">
    <h2>Luoghi Trovati:</h2>
    <div class="luoghi-panoramica-int">
        {section name=nr loop=$luoghi}
            <h3>{$luoghi[nr]->nome}, {$luoghi[nr]->nomecitta}<span class="feedback-luogo">{$luoghi[nr]->feedback}</span></h3>
            <div>
                <table>
                    <tr>
                        <td><h5>Autore:</h5></td>
                        {if isset($utente_luogo_logged) && $utente_luogo_logged[nr]==$utente_sessione}
                            <td><a href="index.php?controller=profilo&task=visualizza"><h5>{$utente_luogo_logged[nr]}</h5></a></td>
                        {elseif isset($utente_luogo_logged)}
                            <td><a class="button-profilo" href="javascript:void(0)" utente="{$utente_luogo_logged[nr]}" pagina="1"><h5>{$utente_luogo_logged[nr]}</h5></a></td>
                            {else}
                            <td><h5>{$utente_luogo[nr]}</h5></td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h5>Citt&agrave;:</h5></td>  <td><h5>{$luoghi[nr]->nomecitta}</h5></td>
                    </tr>
                    <tr>
                        <td><h5>Data:</h5></td>  <td><h5>{$data[nr]}</h5></td>
                    </tr>
                    <tr>
                        <td><a class="link-dettaglio-viaggio" href="javascript:void(0)" citta="{$luoghi[nr]->nomecitta|regex_replace:"/[\ \']/":''}" luogo="{$luoghi[nr]->nome|regex_replace:"/[\ \']/":''}" idviaggio="{$luoghi[nr]->idviaggio}"><h5>Visualizza viaggio</h5></a></td>
                    </tr>
                </table>
            </div>
            {sectionelse}
            <h5> nessun risultato </h5>
        {/section}
    </div>
</div>

<br><br>

<div class="citta-panoramica-ext">
    <h2>Citt&agrave; Trovate:</h2>
    <div class="citta-panoramica-int">
        {section name=nr loop=$citta}
            <h3>{$citta[nr]->nome}, {$citta[nr]->stato}<span class="feedback-citta">{$citta[nr]->feedback}</span></h3>
            <div>
                <table>
                    <tr>
                        <td><h5>Autore:</h5></td>
                        {if isset($utente_citta)}
                            <td><h5>{$utente_citta[nr]}</h5></td>
                        {elseif isset($utente_citta_logged)}
                            <td><a href="""><h5>{$utente_citta_logged[nr]}</h5></a></td>
                        {/if}
                    </tr>
                    <tr>
                        <td><h5>Stato:</h5></td>  <td><h5>{$citta[nr]->stato}</h5></td>
                    </tr>
                    <tr>
                        <td><h5>Data:</h5></td>  <td><h5>{$citta[nr]->datafine}</h5></td>
                    </tr>
                    <tr>
                        <td><a class="link-dettaglio-viaggio" href="javascript:void(0)" citta="{$citta[nr]->nome|regex_replace:"/[\ \']/":''}" idviaggio={$citta[nr]->idviaggio}><h5>Visualizza viaggio</h5></a></td>
                    </tr>
                </table>
            </div>
            {sectionelse}
            <h5> nessun risultato </h5>
        {/section}
    </div>
</div>

<br><br>

<div class="ricerca-navigazione1">
    <button id="prev">Indietro</button><button id="home">Home</button><button id="next">Avanti</button>
</div>