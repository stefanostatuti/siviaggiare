<div class="inserimento-commento">
    <br>
        <textarea id="testo" maxlength="1024" placeholder="Inserisci qui il tuo commento..."></textarea><span class="status"></span><br><br>
        <select id="voto">
            <option value="0"> Voto </option>
            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
            <option value="3"> 3 </option>
            <option value="4"> 4 </option>
            <option value="5"> 5 </option>
            <option value="6"> 6 </option>
            <option value="7"> 7 </option>
            <option value="8"> 8 </option>
            <option value="9"> 9 </option>
            <option value="10"> 10 </option>
        </select>
    <button id="salvacommento" idviaggio="{$luogo->idviaggio}" nomeluogo="{$luogo->nome}" nomecitta="{$luogo->nomecitta}">Invia</button>
</div>