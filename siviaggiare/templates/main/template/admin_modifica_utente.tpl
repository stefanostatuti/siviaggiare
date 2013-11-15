<script type="text/javascript" src="templates/main/template/js/admin.js"></script>
<div class="content">
    <div class="form_settings">
        <div id="administrator_modifiche">

                <fieldset>
                    <label>Username:</label>
                    <input type="text" name="username" readonly id="adm_user" maxlength="20" value="{$utente->username}" />

                    <label>Cognome :</label>
                    <input type="text" name="cognome" id="adm_cognome" maxlength="40" value="{$utente->cognome}" />

                    <label>Nome :</label>
                    <input type="text" name="nome" id="adm_nome" maxlength="20" value="{$utente->nome}"/>

                    <label>Residenza:</label>
                    <input type="text" name="citta" id="adm_citta" maxlength="20" value="{$utente->residenza}" />

                    <label>Nazione :</label>
                    <input type="text" name="nazione" id="adm_nazione" maxlength="20" value="{$utente->nazione}" />

                    <label>Email :</label>
                    <input type="text" name="mail" id="adm_email" maxlength="30" value="{$utente->mail}"/>

                    <label>Codice Attivazione :</label>
                    <input type="text" name="cod_attivazione" id="adm_codattivazione" maxlength="10" value="{$utente->cod_attivazione}"/>

                    <label>Password :</label>
                    <input type="password" id="adm_password" name="password"  maxlength="20" value="{$utente->password}" />

                    <label>Lavoro :</label>
                    <input type="text" id="adm_lavoro" name="lavoro"  maxlength="20" value="{$utente->lavoro}" />

                    <label>Telefono :</label>
                    <input type="text" id="adm_telefono" name="telefono"  maxlength="20" value="{$utente->telefono}" />

                    <label>Avvertimenti :</label>
                    <input type="text" id="adm_avvertimenti" name="avvertimenti"  maxlength="1" value="{$utente->avvertimenti}" />

                    <label>Sesso :</label>
                    <input type="text" id="adm_sesso" name="sesso"  maxlength="20" value="{$utente->sesso}" />

                    <label>Data Nascita :</label>
                    <input type="text" id="adm_data" name="datanascita"  maxlength="20" value="{$utente->datanascita}" />

                    <label>Stato Iscrizione:</label>

                    <select name="stato" id="adm_stato" value="{$utente->stato}">
                        <option value="attivo" {if $utente->stato == "attivo"}selected {/if}>Attivo</option>
                        <option value="non_attivo" {if $utente->stato == "non_attivo"}selected {/if}>Non Attivo</option>
                        <option value="admin" {if $utente->stato == "admin"}selected {/if}>Admin</option>
                    </select>

                </fieldset>
                <button id="salva_modifiche" class="salva_modifiche">Salva</button>
                <button id="annulla_modifiche" class="annulla_modifiche">Annulla</button>
        </div>
    </div>
</div>