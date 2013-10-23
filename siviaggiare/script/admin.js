$(document).ready(function()
{
    $("#modifica").on('click', function(){
        $('#avvertimento').show('fast');
        $('#elimina').show('fast');
        $('#annulla').show('fast');
        $('#salva-modifiche').show('fast');

        $('#indietro').hide('fast');
        $('#modifica').hide('fast');
    });

    $('#annulla').on('click', function(){
        $('#avvertimento').hide('fast');
        $('#elimina').hide('fast');
        $('#annulla').hide('fast');
        $('#salva-modifiche').hide('fast');

        $('#indietro').show('fast');
        $('#modifica').show('fast');
        alert("annullate modifiche");
    });

    $('#elimina-segnalazione').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare la segnalazione?");
        if (r==true)
        {
            alert("OK! ELIMINO");

            $.ajax({
                type: 'GET',
                url: 'index.php?controller=amministrazione&task=elimina_segnalazione',
                data: "idsegnalazione="+getIDSegnalazione(),
                success: function(response)
                {
                    alert("Tutto OK!");
                    AggiornaPagina();
                }
            });

            /* vecchia versione
            xmlhttp =new XMLHttpRequest();
            xmlhttp.open("GET","index.php?controller=amministrazione&task=elimina_segnalazione&id="+ getIDSegnalazione(),true); //devo passargli l'id della segnalazione
            xmlhttp.send();
            */
            alert("FINE!");
        }
        else
        {
            alert("You pressed Cancel!");
        }

    });//ok

    $('#elimina-viaggio').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare il viaggio?");
        if (r==true)
        {
            alert("OK! ELIMINO");
            $.ajax({
                type: 'GET',
                url: 'index.php?controller=amministrazione&task=elimina_viaggio',
                data: "idviaggio="+getIDViaggio(),
                success: function(response){
                    alert("tutto OK");
                    AggiornaPagina();
                }
            })
            alert("FINE!");
        }
        else
        {
            alert("You pressed Cancel!");
        }

    });//ok

    $('#elimina-citta').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare la citta?");
        if (r==true)
        {
            alert("OK! ELIMINO");
            $.ajax({
                type: 'GET',
                url: 'index.php?controller=amministrazione&task=elimina_citta',
                //data: {"idviaggio":getIDViaggio(),"nomecitta":getNomeCitta()},
                data: {"nomecitta":getNomeCitta(),"idviaggio":getIDViaggio()},
                success: function(response){
                    alert("tutto OK");
                    AggiornaPagina();
                }
            })
            alert("FINE!");
        }
        else
        {
            alert("You pressed Cancel!");
        }

    });//OK

    $('#elimina-luogo').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare il Luogo?");
        if (r==true)
        {
            alert("OK! ELIMINO");

            $.ajax({
                type: 'GET',
                url: 'index.php?controller=amministrazione&task=elimina_luogo',
                data: {"nomecitta":getNomeCitta(),"idviaggio":getIDViaggio(),"nomeluogo":getNomeLuogo()},
                success: function(response)
                {
                    AggiornaPagina();
                    //alert("Cancello anche la segnalazione! DA FARE!!!!");
                    // alert("Redirect to home Segnalazioni!");
                    //RedirectToHomeSegnalazioni();
                }
            });

            /* vecchia versione
             xmlhttp =new XMLHttpRequest();
             xmlhttp.open("GET","index.php?controller=amministrazione&task=elimina_segnalazione&id="+ getIDSegnalazione(),true); //devo passargli l'id della segnalazione
             xmlhttp.send();
             */
            alert("FINE!");
        }
        else
        {
            alert("You pressed Cancel!");
        }

    });//ok

    $('#elimina-commento').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare il commmento?");
        if (r==true)
        {
            alert("OK! ELIMINO");

            $.ajax({
                type: 'GET',
                url: 'index.php?controller=amministrazione&task=elimina_commento',
                data: "idcommento="+getIDCommento(),
                success: function(response)
                {
                    AggiornaPagina();
                   //alert("Cancello anche la segnalazione! DA FARE!!!!");
                   // alert("Redirect to home Segnalazioni!");
                   //RedirectToHomeSegnalazioni();
                }
            });
            alert("FINE!");
        }
        else
        {
            alert("You pressed Cancel!");
        }

    });//ok

    $('#elimina-utente').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare l'utente?");
        if (r==true)
        {
            alert("OK! ELIMINO");
            $.ajax({
                type: 'GET',
                processData: false, //obbligatorio se si spedisce del testo
                url: 'index.php?controller=amministrazione&task=elimina_utente',
                data: "nomeutente="+getNomeUtente(),
                success: function(response){
                    AggiornaPagina();
                    alert("tutto OK");
                }
            })
            alert("FINE!");
        }
        else
        {
            alert("You pressed Cancel!");
        }

    }); //ok

    $('#avvertimento').on('click', function(){
        var r=confirm("Sei sicuro di voler mandare l'avvertimento?");
        if (r==true)
        {
            alert("OK! mando l'avvertimento");
            $.ajax({
                type: 'GET',
                processData: false, //obbligatorio se si spedisce del testo???
                url: 'index.php?controller=amministrazione&task=manda_avvertimento',
                data: "nomeutente="+getNomeUtente(),
                success: function(response){
                    AggiornaPagina();
                    alert("tutto OK");
                }
            })
            alert("FINE!");
        }
        else
        {
            alert("You pressed Cancel!");
        }

    });

     $( document ).ready(function(){
        //alert("entro nella Funzione");
        ColoraCasella();
    }) //colora in automatico la casella degli avvertimenti

    $('#redirect').on('click',function(){RedirectToHomeSegnalazioni();});//ok

    $('#redirect-utenti').on('click',function(){RedirectToUtenti();});//ok

    $('#redirect-segnalazione').on('click',function(){RedirectToSegnalazione();});//ok


    //---------------------Funzioni-------------------------//
    // cercano nell'html gli id='quello che serve'
    //------------------------------------------------------//

    function getNomeUtente()//ok ritorna il nome utente
    {
        var id=$("table").find("#nomeutente")
            //.css( "background-color", "red" )
            .text();
        return id;
    }

    function getIDSegnalazione()//ok ritorna l'id della segnalazione
    {

    var id=$("table").find("#idsegnalazione")
        //.css( "background-color", "red" );
        .text();
    return id;
    }

    function getIDViaggio()//ok ritorna l'id del viaggio
    {

        var id=$("table").find("#idviaggio")
            //.css( "background-color", "red" )
            .text();
        return id;
    }

    function getNomeCitta()//ok ritorna il nome della citta
    {
    var nomecitta=$("table").find("#nomecitta")
        //.css( "background-color", "red")
        .text();
        return nomecitta;
    }

    function getNomeLuogo()//ok ritorna il nome del luogo
    {

        var nomeluogo=$("table").find("#nomeluogo")
            //.css( "background-color", "red");
            .text();
        return nomeluogo;
    }

    function getIDCommento()//ok ritorna l'id del commento
    {

        var id=$("table").find("#idcommento")
            //.css( "background-color", "red" )
            .text();
        return id;
    }
    //-------------------end------------------------//

   function RedirectToHomeSegnalazioni()//ok
   {
       location.href="index.php?controller=amministrazione&task=segnalazioni";
       /*window.location.href = $.ajax({
           type: 'GET',
           url: 'index.php?controller=amministrazione&task=segnalazioni',

           success: function(response){
               alert("tutto OK");
           }
       })*/
   }

    function RedirectToUtenti()//ok
    {
        location.href="index.php?controller=amministrazione&task=gestione_utenti";
        /*window.location.href = $.ajax({
         type: 'GET',
         url: 'index.php?controller=amministrazione&task=segnalazioni',

         success: function(response){
         alert("tutto OK");
         }
         })*/
    }

    function RedirectToSegnalazione()//ok
    {
        history.back();
        //location.href="index.php?controller=amministrazione&task=segnalazioni";
    }

    function AggiornaPagina()//ok aggiorna la pagina dopo un'eliminazione
    {
        window.location.reload();
        //location.href="index.php?controller=amministrazione&task=segnalazioni";
    }

    function ColoraCasella()//colora la casella in base al numero di avvertimenti. 0 = verde 1,2 =giallo e 3=rosso
    {
        $('table #numeroavvertimenti').each(function( i )
        {
        var numeroAvvertimenti= $(this).text();
        var casellaAvvertimenti= $(this);

        //alert("questo è il numero degli avvertimenti\n");
        //alert(numeroAvvertimenti);

        if (numeroAvvertimenti>=3){
                casellaAvvertimenti.css( "background-color", "red");
        }
        if (numeroAvvertimenti==1 || numeroAvvertimenti== 2){
                casellaAvvertimenti.css( "background-color", "yellow");
        }
        if (numeroAvvertimenti<=0){
            casellaAvvertimenti.css( "background-color", "green");
        }
        });
    }


});