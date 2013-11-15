<div class="content">
    <div class="form_settings">
        <script type="text/javascript" src="templates/main/template/js/validation_reg.js"></script>
        <form method="post" action="index.php" id="form_register">
            <div id="form_register" class="error">{$errore}
            

                <legend id="form_register"><h4>Inserisci i seguenti dati : </h4></legend>



                <fieldset>
                    <label for="reg_user">Username* :</label>
                    <input type="text" name="username" id="reg_user" maxlength="20" value="{$persona.user}" />
                    {if $messaggi.user != false || $messaggi.userdata != false || $messaggi.campouser != false }
                        <p class="error">
                            {if $messaggi.user != 'false'} {$messaggi.user}  {/if}
                            {if $messaggi.userdata != 'false'} {$messaggi.userdata}  {/if}
                            {if $messaggi.campouser != 'false'} {$messaggi.campouser}  {/if}
                        </p>
                    {/if}

                    <label for="reg_cognome">Cognome* :</label>
                    <input type="text" name="cognome" id="reg_cognome" maxlength="20" value="{$persona.cognome}" />
                    {if $messaggi.cognome != false || $messaggi.campocognome != false}
                        <p class="error">
                            {if $messaggi.cognome != 'false'} {$messaggi.cognome} {/if}
                            {if $messaggi.campocognome != 'false'} {$messaggi.campocognome}  {/if}
                        </p>
                    {/if}

                    <label for="reg_nome">Nome* :</label>
                    <input type="text" name="nome" id="reg_nome" maxlength="20" value="{$persona.nome}"/>
                    {if $messaggi.nome != false || $messaggi.camponome != false}
                    <p class="error">
                        {if $messaggi.nome != 'false'} {$messaggi.nome} {/if}
                        {if $messaggi.camponome != 'false'} {$messaggi.camponome}  {/if}
                        {/if}
                    </p>

                    <label for="reg_residenza">Citt&agrave* :</label>
                    <input type="text" name="residenza" id="reg_citta" maxlength="20" value="{$persona.residenza}" />
                    {if $messaggi.residenza != false || $messaggi.camporesidenza != false}
                    <p class="error">
                        {if $messaggi.residenza != 'false'} {$messaggi.residenza} {/if}
                        {if $messaggi.camporesidenza != 'false'} {$messaggi.camporesidenza}  {/if}
                        {/if}
                    </p>

                    <label for="reg_nazione">Nazione* :</label>
                    <input type="text" name="nazione" id="reg_nazione" maxlength="20" value="{$persona.nazione}" />
                    {if $messaggi.nazione != false || $messaggi.camponazione != false}
                    <p class="error">
                        {if $messaggi.nazione != 'false'} {$messaggi.nazione} {/if}
                        {if $messaggi.camponazione != 'false'} {$messaggi.camponazione}  {/if}
                        {/if}
                    </p>

                    <label for="reg_email">Email* :</label>
                    <input type="text" name="mail" id="reg_email" maxlength="30" value="{$persona.mail}"/>
                    {if $messaggi.mail != false || $messaggi.campomail != false}
                    <p class="error">
                        {if $messaggi.mail != 'false'} {$messaggi.mail} {/if}
                        {if $messaggi.campomail != 'false'} {$messaggi.campomail}  {/if}
                        {/if}
                    </p>


                    <label for="reg_pass1">Password* :</label>
                    <input type="password" class="reg_pass1" name="password"  maxlength="20" value="{$persona.password}" />
                    {if $messaggi.password != false || $messaggi.campopassword != false}
                    <p class="error">
                        {if $messaggi.password != 'false'} {$messaggi.password} {/if}
                        {if $messaggi.campopassword != 'false'} {$messaggi.campopassword}  {/if}
                        {/if}
                    </p>

                    <label for="reg_pass1">Conferma Password* :</label>
                    <input type="password" class="reg_pass1" name="password_1" maxlength="20" value="{$persona.password_1}" />
                    {if $messaggi.password != false || $messaggi.password2 != false || $messaggi.campo != false}
                        <p class="error">
                            {if $messaggi.password != 'false'} {$messaggi.password}  {/if}
                            {if $messaggi.password2 != 'false'} {$messaggi.password2}  {/if}
                            {if $messaggi.campopassword != 'false'} {$messaggi.campopassword}  {/if}
                        </p>
                    {/if}


                            <input type="hidden" name="controller" value="registrazione" />
                            <input type="hidden" name="task" value="salva" />
                            <input type="submit" name="register" class="submit" value="invia dati" id="reg_submit" />
                            <input type="reset" name="cancella" value="cancella" id="reg_reset" />
                </fieldset>
                
                <br>
                <br>

                <h3>* Campo Obbligatorio</h3>

        </form>
    </div>
</div>
</div>