<div class="content">
 <div class="form_settings">
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
        
  <div class="profilo">
   <div id="profilo" class="error" > {$errore}</div>
   
   
        <legend><h4>Informazioni </h4></legend>
        <form id="profilo">   
             
            
             <label>nome</label>
             <input type="text" name="nome" id="nome" value="{$profilo.nome}" {$scope}/><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>
             
             <label>cognome</label>
             <input type="text" name="cognome" id="cognome" value="{$profilo.cognome}"  {$scope}/><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>
            
             <label>lavoro</label>
             <input type="text" name="lavoro" id="lavoro" value="{$profilo.lavoro}"  {$scope}/><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>
               
             <label>nazione</label>
             <input type="text" name="nazione" id="nazione" value="{$profilo.nazione}"  {$scope}/><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>  
                    
             <label>citta</label>
             <input type="text" name="citta" id="citta" value="{$profilo.residenza}"  {$scope}/><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>
                
             <label>data nascita</label> 
             <input type="text" name="data" id="data" value="{$profilo.datanascita}"  {$scope}/><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div> 
                    
             <label>sesso</label>  
             <select name="sesso" id="sesso" value="{$profilo.sesso}"  {$scope}>
                    <option value="maschile">maschile</option>
                    <option value="femminile">femminile</option>
             </select><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>
             
             <label>telefono-cell</label>
             <input type="text" name="telefono" id="telefono" value="{$profilo.telefono}"  {$scope}/><img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>
               
             <label>e-mail</label>          
             <input name="mail" id="mail" value="{$profilo.mail}"  {$scope}/> <img id="img" src="templates/main/template/images/modifica.png" width="30" height="20" alt="Impossibile visualizzare"/>
             <div ><a href="" id="modifica">modifica</a></div>
        </form>     
  </div>
</div> 
</div>  