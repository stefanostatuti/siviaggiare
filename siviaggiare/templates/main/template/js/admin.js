$(document).ready(function()
{
    $("#modifica").on('click', function(){

        $('#elimina').show('fast');
        $('#annulla').show('fast');
        $('#salva-modifiche').show('fast');

        //$('#indietro').hide('fast');
        $('#avvertimento').hide('fast');
        $('#gestisci-utente').hide('fast');
        $('#modifica').hide('fast');
    });

    $('#annulla').on('click', function(){
        $('#avvertimento').show('fast');
        $('#elimina').show('fast');
        $('#salva-modifiche').hide('fast');
        $('#gestisci-utente').show('fast');
        $('#modifica').show('fast');

        $('#annulla').hide('fast');

        //$('#indietro').show('fast');
    });

    $('#modifica').on('click', function(event){
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=amministrazione&task=modifica_utente',
                data: "nomeutente="+getNomeUtente(),
                success: function(msg){
                    $('#danascondere').hide();
                    if($('#administrator_modifiche fieldset').length==0){
                    $('#site_content').append(msg);
                    }
                    event.preventDefault();
                    //event.stopPropagation();
                        $('#salva_modifiche').on('click', function(){
                            var username=$('#adm_user').val();
                            var nome=$('#adm_nome').val();
                            var cognome=$('#adm_cognome').val();
                            var citta =$('#adm_citta').val();
                            var nazione=$('#adm_nazione').val();
                            var mail=$('#adm_email').val();
                            var cod_attiv=$('#adm_codattivazione').val();
                            var cod_avvertimenti=$('#adm_avvertimenti').val();
                            var lavoro=$('#adm_lavoro').val();
                            var telefono=$('#adm_telefono').val();
                            var data=$('#adm_data').val();
                            var sesso=$('#adm_sesso').val();
                            var stato=$('#adm_stato').val();
                            var password=$('#adm_password').val();
                            $.ajax({
                                type: 'POST',
                                url: 'index.php?controller=amministrazione&task=salva_modifica_utente',
                                data:{
                                    "cognome":cognome,
                                    "nome":nome,
                                    "username":username,
                                    "residenza":citta,
                                    "nazione":nazione,
                                    "mail":mail,
                                    "lavoro":lavoro,
                                    "telefono":telefono,
                                    "sesso":sesso,
                                    "datanascita":data,
                                    "password":password,
                                    "stato":stato,
                                    "cod_attivazione":cod_attiv,
                                    "avvertimenti":cod_avvertimenti
                                },
                                success: function(response){
                                    alert("Salvataggio eseguito con successo!")
                                    location.href="index.php?controller=amministrazione&task=dettaglio_utente&username="+username;
                                },
                                error: function(response){
                                    alert("Errore!")
                                }
                            });
                        });

                        $('#annulla_modifiche').on('click', function(event){
                            event.preventDefault();
                            event.stopPropagation();
                            alert("modifiche Annullate");
                            $('#danascondere').show();
                            $('#templatemodificaUtente').remove();
                            $('#salva-modifiche').hide('fast');
                            $('#annulla-modifiche').hide('fast');
                            $('#annulla').hide('fast');
                            $('#gestisci-utente').show('fast');
                            $('#avvertimento').show('fast');
                            $('#modifica').show('fast');
                        });
                }
            })
    }); //ok






    $('#elimina-segnalazione').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare la segnalazione?");
        if (r==true)
        {
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=amministrazione&task=elimina_segnalazione',
                data: "idsegnalazione="+getIDSegnalazione(),
                success: function(response)
                {
                    AggiornaPagina();
                }
            });
        }
    });//ok

    $('#elimina-viaggio').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare il viaggio?");
        if (r==true)
        {
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=amministrazione&task=elimina_viaggio',
                data: "idviaggio="+getIDViaggio(),
                success: function(response){
                    AggiornaPagina();
                }
            })
        }
    });//ok

    $('#elimina-citta').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare la citta?");
        if (r==true)
        {
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=amministrazione&task=elimina_citta',
                data: {"nomecitta":getNomeCitta(),"idviaggio":getIDViaggio()},
                success: function(response){
                    AggiornaPagina();
                }
            })
        }

    });//OK

    $('#elimina-luogo').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare il Luogo?");
        if (r==true)
        {
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=amministrazione&task=elimina_luogo',
                data: {"nomecitta":getNomeCitta(),"idviaggio":getIDViaggio(),"nomeluogo":getNomeLuogo()},
                success: function(response)
                {
                    AggiornaPagina();
                }
            });
        }
    });//ok

    $('#elimina-commento').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare il commmento?");
        if (r==true)
        {
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=amministrazione&task=elimina_commento',
                data: "idcommento="+getIDCommento(),
                success: function(response)
                {
                    AggiornaPagina();
                }
            });
        }
    });//ok

    $('#elimina-utente').on('click', function(){
        var r=confirm("Sei sicuro di voler eliminare l'utente?");
        if (r==true)
        {
            $.ajax({
                type: 'POST',
                processData: false, //obbligatorio se si spedisce del testo
                url: 'index.php?controller=amministrazione&task=elimina_utente',
                data: "nomeutente="+getNomeUtente(),
                success: function(response){
                    AggiornaPagina();
                }
            })
        }

    }); //ok

    $('#avvertimento').on('click', function(){
        var r=confirm("Sei sicuro di voler mandare l'avvertimento?");
        if (r==true)
        {
            $.ajax({
                type: 'POST',
                url: 'index.php?controller=amministrazione&task=manda_avvertimento',
                data: "nomeutente="+getNomeUtente(),
                success: function(response){
                    //AggiornaPagina();
                    $("#avvertimento").hide();
                }
            })
        }
    });

     $( document ).ready(function(){
        ColoraCasella();
    }) //colora in automatico la casella degli avvertimenti

    $('#gestisci-utente').on('click', function(){

        var r=confirm("Sei sicuro di Cambiare lo stato dell'utente");
        if (r==true)
        {
            var stato = getStato();
            if (stato== 'attivo')
            {
                $.ajax({
                    type: 'POST',
                    processData: false,
                    url: 'index.php?controller=amministrazione&task=promuovi_utente',
                    data: "nomeutente="+getNomeUtente(),
                    success: function(response){
                        AggiornaPagina();
                    }
                })
            }
            if (stato== 'admin')
            {
                $.ajax({
                    type: 'POST',
                    processData: false,
                    url: 'index.php?controller=amministrazione&task=degrada_utente',
                    data: "nomeutente="+getNomeUtente(),
                    success: function(response){
                        AggiornaPagina();
                    }
                })
            }
        }
    });//ok

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

    function getStato()//ok ritorna lo stato dell'utente (admin, attivo non_attivo)
    {

        var id=$("table").find("#stato")
            //.css( "background-color", "red" )
            .text();
        return id;
    }
    //-------------------end------------------------//

   function RedirectToHomeSegnalazioni()//ok
   {
       location.href="index.php?controller=amministrazione&task=segnalazioni";
   }

    function RedirectToUtenti()//ok
    {
        location.href="index.php?controller=amministrazione&task=gestione_utenti";
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