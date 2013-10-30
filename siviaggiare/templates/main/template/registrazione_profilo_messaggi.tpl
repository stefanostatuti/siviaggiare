<div class="content">
 <div class="form_settings">
  <link rel="stylesheet" href="templates/main/template/css/jquery-ui.css" />
        
  <div class="messaggi_profilo">
  
     <legend><h4>I tuoi messaggi </h4></legend>

   <div id="messaggi_profilo" class="error" > {$errore}</div>
        <table id="messaggi_profilo">
          {section name=nr loop=$messaggi}
                <tr {if $smarty.section.nr.iteration is odd}  {/if}>
                    <td>
                        {$messaggi[nr]}
                    </td>
                    
                {sectionelse}
                <tr>
                    <td >
                        <h5> nessun messaggio </h5>
                    <td>
                </tr>
                {/section}
         </table>       
      
  </div>
</div> 
</div>  
