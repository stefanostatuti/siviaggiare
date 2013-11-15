<div class="profilo-ext">
    <div class="profilo-int">
        <h4>{$profilo->username}</h4>
        <div>
            <table>
                <tr>
                    <td><h6>Nome</h6></td> <td><h6>{$profilo->nome}</h6></td>
                </tr>
                <tr>
                    <td><h6>Cognome</h6></td> <td><h6>{$profilo->cognome}</h6></td>
                </tr>
                <tr>
                    <td><h6>Lavoro</h6></td> <td><h6>{$profilo->lavoro}</h6></td>
                </tr>
                <tr>
                    <td><h6>Nazione</h6></td> <td><h6>{$profilo->nazione}</h6></td>
                </tr>
                <tr>
                    <td><h6>Citta</h6></td> <td><h6>{$profilo->residenza}</h6></td>
                </tr>
                <tr>
                    <td><h6>Data nascita</h6></td><td><h6>{$profilo->datanascita}</h6></td>
                </tr>
                <tr>
                    <td><h6>Sesso</h6></td><td><h6>{$profilo->sesso}</h6></td>
                </tr>
                <tr>
                    <td><h6>Telefono</h6></td><td><h6>{$profilo->telefono}</h6></td>
                </tr>
                <tr>
                    <td><h6>E-mail</h6></td><td><h6>{$profilo->mail}</h6></td>
                </tr>
            </table>
        </div>
    </div>
</div>
    <br><br>
    <div class="ricerca-navigazione4">
    <button id="prev" pagina={$pagina}>Indietro</button><button id="home">Home</button>
</div>
