<div class="luoghi-panoramica-ext">
    <h2>Luoghi Trovati:</h2>
    <div class="luoghi-panoramica-int">
        {section name=nr loop=$luoghi}
            <h3>{$luoghi[nr]->nome}, {$luoghi[nr]->nomecitta}<span class="feedback-luogo">{$luoghi[nr]->feedback}</span></h3>
            <div>
                <table>
                    <tr>
                        <td><h5>Citt&agrave;:</h5></td>  <td><h5>{$luoghi[nr]->nomecitta}</h5></td>
                    </tr>
                    <tr>
                        <td><h5>Data:</h5></td>  <td><h5>{$data[nr]}</h5></td>
                    </tr>
                    <tr>
                        <td><button class="button-dettaglio-viaggio" citta="{$luoghi[nr]->nomecitta}" luogo="{$luoghi[nr]->nome}" value={$luoghi[nr]->idviaggio}>Visualizza intero viaggio</button></td>
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
                        <td><h4>Stato:</h4></td>  <td><h4>{$citta[nr]->stato}</h4></td>
                    </tr>
                    <tr>
                        <td><h4>Data:</h4></td>  <td><h4>{$citta[nr]->datafine}</h4></td>
                    </tr>
                    <tr>
                        <td><button class="button-dettaglio-viaggio" citta="{$citta[nr]->nome}" value={$citta[nr]->idviaggio}>Visualizza intero viaggio</button></td>
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