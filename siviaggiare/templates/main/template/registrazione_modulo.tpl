<div class="content">
    <div class="form_settings">
        <div class="error">{$errore}
            <legend><h4>Inserisci i seguenti dati: </h4></legend>

            <table>
                <form method="post" action="index.php">
                    <tr>
                        <td> Username: </td>
                        <td> <input type="text" name="username"  maxlength="20" value="{$persona.user}"/> </td>
                        {if $messaggi !=false || $messaggi.userdata !=false }
                            <td class="error">
                                {if $messaggi != 'false'} {$messaggi.user}  {/if}
                                {if $messaggi.userdata != 'false'} {$messaggi.userdata}  {/if}
                            </td>
                        {/if}
                    </tr>
                    <tr>
                        <td> Cognome: </td>
                        <td> <input type="text" name="cognome" maxlength="20" value="{$persona.cognome}"/> </td>
                        {if $messaggi.cognome != false}
                        <td class="error">
                            {$messaggi.cognome}
                        </td>
                            {/if}
                    </tr>
                    <tr>
                        <td > Nome: </td>
                        <td> <input type="text" name="nome" maxlength="20" value="{$persona.nome}"/></td>
                        {if $messaggi.nome != false}
                        <td class="error">
                            {$messaggi.nome}
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td> Citt&agrave: </td>
                        <td> <input type="text" name="residenza" maxlength="20" value="{$persona.residenza}"/></td>
                        {if $messaggi.residenza != false}
                        <td class="error">
                            {$messaggi.residenza}
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td> Nazione: </td>
                        <td> <input type="text" name="nazione" maxlength="20" value="{$persona.nazione}"/></td>
                        {if $messaggi.nazione != false}
                        <td class="error">
                            {$messaggi.nazione}
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td> Email: </td>
                        <td> <input type="text" name="mail" maxlength="30" value="{$persona.mail}" /></td>
                        {if $messaggi.mail != false}
                        <td class="error">
                            {$messaggi.mail}
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td> Password: </td>
                        <td> <input type="password" name="password" maxlength="20" value="{$persona.password}" /></td>
                        {if $messaggi.password != false}
                        <td class="error">
                            {$messaggi.password}
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td> Conferma Password: </td>
                        <td> <input type="password" name="password_1" maxlength="20" value="{$persona.password_1}" /></td>
                        {if $messaggi.password != false || $messaggi.password2 != false}
                        <td class="error">
                            {if $messaggi.password != 'false'} {$messaggi.password}  {/if}
                            {if $messaggi.password2 != 'false'} {$messaggi.password2}  {/if}
                        </td>
                            {/if}
                    </tr>
            </table>
            <input type="hidden" name="controller" value="registrazione" />
            <input type="hidden" name="task" value="salva" />
            <input type="submit" class="submit" value="invia dati" />
            </form>
        </div>
    </div>
</div>