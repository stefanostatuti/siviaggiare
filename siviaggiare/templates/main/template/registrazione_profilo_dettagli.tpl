<div class="content">
 <div class="form_settings">
 <script type="text/javascript" src="templates/main/template/js/modifica_profilo_info.js"></script>
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
        
  <div class="profilo">
   <div id="profilo" class="error" > {$errore}</div>
   
   
        <legend>Informazioni </legend>
        <form id="profilo">   
             
            
                <label for="nome">nome</label>
                <input type="text" name="nome" id="nome" value="{$profilo.nome}" class="info_profilo"/>
                <input type="button" name="modifica_nome" value="modifica" id="modifica_nome"/>
                <input type="button" name="salva_nome" value="salva" id="salva_nome"/>

                <label for="cognome">cognome</label>
                <input type="text" name="cognome" id="cognome" value="{$profilo.cognome}"  class="info_profilo"/>
                <input type="button" name="modifica_cognome" value="modifica" id="modifica_cognome"/>
                <input type="button" name="salva_cognome" value="salva" id="salva_cognome"/>


                <label for="lavoro">lavoro</label>
                <input type="text" name="lavoro" id="lavoro" value="{$profilo.lavoro}"  class="info_profilo"/>
                <input type="button" name="modifica_lavoro" value="modifica" id="modifica_lavoro"/>
                <input type="button" name="salva_lavoro" value="salva" id="salva_lavoro"/>


                <label for="nazione">nazione</label>
                <input type="text" name="nazione" id="nazione" value="{$profilo.nazione}"  class="info_profilo"/>
                <input type="button" name="modifica_nazione" value="modifica" id="modifica_nazione"/>
                <input type="button" name="salva_nazione" value="salva" id="salva_nazione"/>


                <label for="citta">citta</label>
                <input type="text" name="citta" id="citta" value="{$profilo.residenza}"  class="info_profilo"/>
                <input type="button" name="modifica_residenza" value="modifica" id="modifica_residenza"/>
                <input type="button" name="salva_residenza" value="salva" id="salva_residenza"/>


                <label>data nascita</label>
                <input type="text" name="data" id="data" value="{$profilo.datanascita}" class="info_profilo"/>
                <input type="button" name="modifica_data" value="modifica" id="modifica_data" />
                <input type="button" name="salva_data_nascita" value="salva" id="salva_data_nascita"/>


                <label>sesso</label>
                <select name="sesso" id="sesso" value="{$profilo.sesso}"  class="info_profilo">
                    <option value="maschile" {if $profilo.sesso == "maschile"}selected {/if}>maschile</option>
                    <option value="femminile" {if $profilo.sesso == "femminile"}selected {/if}>femminile</option>
                </select>
                <input type="button" name="modifica_sesso" value="modifica" id="modifica_sesso"/>
                <input type="button" name="salva_sesso" value="salva" id="salva_sesso"/>


                <label for="telefono">telefono-cell</label>
                <input type="tel" name="telefono" id="telefono" value="{$profilo.telefono}"  class="info_profilo"/>
                <input type="button" name="modifica_telefono" value="modifica" id="modifica_telefono" />
                <input type="button" name="salva_telefono" value="salva" id="salva_telefono"/>


                <label for="mail">e-mail</label>
                <input type="email" name="mail" id="mail" value="{$profilo.mail}"  class="info_profilo"/>
                <input type="button" name="modifica_mail" value="modifica" id="modifica_mail"/>
                <input type="button" name="salva_mail" value="salva" id="salva_mail"/>


            <input type="hidden" name="user" value={$profilo.usertpl} />
        </form>     
  </div>
</div> 
</div>  