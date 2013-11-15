jQuery(document).ready(function($){
    $.fn.enterKey = function (fnc) {
        return this.each(function () {
            $(this).keypress(function (ev) {
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    fnc.call(this, ev);
                }
            })
        })
    }
    function log( message ) {
        $( "<div>" ).text( message ).prependTo( "#log" );
        $( "#log" ).scrollTop( 0 );
    }
    var autocomplete = function (){
        $('#ricerca').autocomplete({
        source:'?controller=ricerca&task=autocomplete',
        minLength:2,
        select: function( event, ui ) {
            log( ui.item ?
                "Selezionato: " + ui.item.value + " , idViaggio:" + ui.item.idviaggio :
                "Nessuna selezione, input era " + this.value );
        }
    });
    };

    autocomplete();

    $('#tab-citta').tabs();
    $(".button-menu-citta , .button-menu-luogo").button().click(function( event ) {
        $('div#risposta-dettaglio *').remove();
        $('div#risposta-panoramica *').remove();
        $('div#risposta-commento *').remove();
        var citta=$(this).attr('citta');
        var luogo=$(this).attr('luogo');
        if($("div#risposta-dettaglio").length == 0)
        {
            $.ajax({
                url: "index.php",
                type: "POST",
                data: "controller=ricerca&task=ricerca_menu_laterale",
                success: function(msg) {
                    $(".content").remove();
                    $("#site_content").append(msg);
                    button_search();
                    autocomplete();
                },
                error: function(){
                    alert("Chiamata fallita!!!");
                }
            });
        }
        $.ajax({
            url: "index.php",
            type: "POST",
            data: "controller=ricerca&task=visualizza_viaggio&idviaggio="+$(this).attr('idviaggio'),
            success: function(msg) {
                $("div#risposta-dettaglio").html(msg);
                dettaglio();
                var cittaAttiva;
                $('.citta-visitate h3 ').each(function(index , elemento) {
                    var cittaformattata=$(this).text().replace(/\ /g,'').replace(/\'/g,'');
                    if(cittaformattata==citta)
                        cittaAttiva=index;
                });
                $( ".dettaglio-viaggio-ext" ).accordion("option", "active", 1);
                $( ".citta-visitate" ).accordion( "option", "active", cittaAttiva);
                $( "#"+citta+" .citta-visitate-int" ).accordion("option", "active", 0);

                if(typeof(luogo) != "undefined" && luogo !== null){
                    var luogoAttivo;
                    $('#'+citta+' h5 ').each(function(indice , elemento) {
                        var luogoformattato=$(this).text().replace(/\ /g,'');
                        if(luogoformattato==luogo)
                            luogoAttivo=indice;
                    });
                    $( "#"+citta+" .citta-visitate-int" ).accordion("option", "active", 1);
                    $( "#"+citta+" .luoghi-visitati-int" ).accordion( "option", "active", luogoAttivo);
                }
                if($('#barraricerca').show())
                    $('#barraricerca').hide();
                if($("div#risposta-dettaglio").hide())
                    $("div#risposta-dettaglio").show();
                if($("div#risposta-panoramica").show())
                    $("div#risposta-panoramica").hide();
            },
            error: function(){
                alert("Chiamata fallita!!!");
            }
        });
        return false;
    });

    $('#tab-1 .feedback-citta-laterale').ratingbar({
        animate: false,
        duration: 1000,
        maxRating: 10,
        wrapperWidth: 75,
        showText: true
    });
    $('#tab-2 .button-menu-citta').button();
    $('#tab-2 .feedback-citta-laterale').ratingbar({
        animate: false,
        duration: 1000,
        maxRating: 10,
        wrapperWidth: 75,
        showText: true
    });
    $('#tab-luogo').tabs();
    $('#tab-1 .button-menu-luogo').button();
    $('#tab-1 .feedback-luogo-laterale').ratingbar({
        animate: false,
        duration: 1000,
        maxRating: 10,
        wrapperWidth: 75,
        showText: true
    });
    $('#tab-2 .button-menu-luogo').button();
    $('#tab-2 .feedback-luogo-laterale').ratingbar({
        animate: false,
        duration: 1000,
        maxRating: 10,
        wrapperWidth: 75,
        showText: true
    });

    var button_search= function() {
        $('#buttonsearch').button({
            icons: {
                primary: "ui-icon-search",
                float: "right"
            },
            text: false,
            float: "left"
        }).click(function( event ) {
                var nome = $("#ricerca").val();
                var href = "index.php?controller=ricerca&task=ricerca&nome="+nome;
                $.ajax({
                    url: "index.php",
                    type: "POST",
                    data: "controller=ricerca&task=ricerca&nome="+nome,
                    success: function(msg) {
                        $("div#risposta-panoramica").html(msg);
                        if($("div#risposta-panoramica").hide())
                            $("div#risposta-panoramica").show();
                        if($('#barraricerca').show())
                            $('#barraricerca').hide();
                        panoramica();
                    },
                    error: function(){
                        alert("Chiamata fallita!!!");
                    }
                });
                return false;
            });

        $('#buttonclear').button({
            icons: {
                primary: "ui-icon-squaresmall-close"
            },
            text: false,
            float: "left"
        }).click(function( event ) {
                $("#ricerca").val("");
        });
        };
    button_search();

    $("#ricerca").enterKey(function () {
        if($('#ui-id-1').show())
            $('#ui-id-1').hide();
        var nome = $("#ricerca").val();
        var href = "index.php?controller=ricerca&task=ricerca&nome="+nome;
        $.ajax({
            url: "index.php",
            type: "POST",
            data: "controller=ricerca&task=ricerca&nome="+nome,
            success: function(msg) {
                $("div#risposta-panoramica").html(msg);
                if($("div#risposta-panoramica").hide())
                    $("div#risposta-panoramica").show();
                if($('#barraricerca').show())
                    $('#barraricerca').hide();
                panoramica();
            },
            error: function(){
                alert("Chiamata fallita!!!");
            }
        });
        return false;
    })

    var panoramica = function () {
        $( ".luoghi-panoramica-ext" ).accordion({
            header: 'h2',
            active: false,
            collapsible: false,
            heightStyle: 'content'
        });

        $( ".luoghi-panoramica-int" ).accordion({
            header: 'h3',
            active: true,
            collapsible: false

        });

        $( ".citta-panoramica-ext" ).accordion({
            header: 'h2',
            active: false,
            collapsible: false,
            heightStyle: 'content'
        });


        $( ".citta-panoramica-int" ).accordion({
            header: 'h3',
            active: true,
            collapsible: false
        });

        $('.citta-panoramica-ext .feedback-citta').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 75,
            showText: true
        });

        $('.luoghi-panoramica-ext .feedback-luogo').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 75,
            showText: true
        });
        button_profilo();


        $(function() {
            $('.link-dettaglio-viaggio').click(function( event ) {
                    var citta=$(this).attr('citta');
                    var luogo=$(this).attr('luogo');
                    $.ajax({
                        url: "index.php",
                        type: "POST",
                        data: "controller=ricerca&task=visualizza_viaggio&idviaggio="+$(this).attr('idviaggio'),
                        success: function(msg) {
                            $("div#risposta-dettaglio").html(msg);
                            dettaglio();
                            var cittaAttiva;
                            $('.citta-visitate h3 ').each(function(index , elemento) {
                                if($(this).text().replace(/\ /g,'').replace(/\'/g,'')==citta)
                                    cittaAttiva=index;
                            });

                            $( ".dettaglio-viaggio-ext" ).accordion("option", "active", 1);
                            $( ".citta-visitate" ).accordion( "option", "active", cittaAttiva);
                            $( "#"+citta+" .citta-visitate-int" ).accordion("option", "active", 0);

                            if(typeof(luogo) != "undefined" && luogo !== null){
                                var luogoAttivo;
                                $('#'+citta+' h5 ').each(function(indice , elemento) {
                                    if($(this).text().replace(/\ /g,'').replace(/\'/g,'')==luogo)
                                        luogoAttivo=indice;
                                });

                                $( "#"+citta+" .citta-visitate-int" ).accordion("option", "active", 1);
                                $( "#"+citta+" .luoghi-visitati-int" ).accordion( "option", "active", luogoAttivo);
                            }
                                if($("div#risposta-dettaglio").hide())
                                    $("div#risposta-dettaglio").show();
                                if($("div#risposta-panoramica").show())
                                    $("div#risposta-panoramica").hide();
                        },
                        error: function(){
                            alert("Chiamata fallita!!!");
                        }
                    });
                    return false;
                });

        });
        $(function() {
        $(".ricerca-navigazione1 #home").button({
            icons: {
                primary: "ui-icon-home"
            },
            text: false
        }).click(function(){
                $('div#risposta-dettaglio *').remove();
                $('div#risposta-panoramica *').remove();
                if($('#barraricerca').hide())
                    $('#barraricerca').show();
            });
        });
        $(function() {
            $(".ricerca-navigazione1 #prev").button({
                icons: {
                  primary: "ui-icon-arrow-1-w"
                },
                text: false
            }).click(function(event) {
                    if($('div#risposta-panoramica').show())
                        $('div#risposta-panoramica').hide();
                    if($('#barraricerca').hide())
                        $('#barraricerca').show();
                    $('div#risposta-dettaglio *').remove();
                });
        });
        $(function() {
            $(".ricerca-navigazione1 #next").button({
                icons: {
                    primary: "ui-icon-arrow-1-e"
                },
                text: false,
                disabled: true
            }).click(function(event) {
                    if( $('div#risposta-dettaglio h4').length !=0 ) {
                        if($('div#risposta-panoramica').show())
                            $('div#risposta-panoramica').hide();
                        if($('div#risposta-dettaglio').hide())
                            $('div#risposta-dettaglio').show();
                        if($('#barraricerca').show())
                            $('#barraricerca').hide();
                    }
                });
        });

    };

    var dettaglio = function () {
        $( ".dettaglio-viaggio-ext" ).accordion({
            header: 'h2',
            active: false,
            collapsible: true,
            heightStyle: 'content'
        });

        $( ".citta-visitate" ).accordion({
            header: 'h3',
            active: true,
            collapsible: true,
            heightStyle: 'content'
        });
        $( ".citta-visitate-int" ).accordion({
            header: 'h4',
            active: true,
            collapsible: true,
            heightStyle: 'content'
        });
        $( ".luoghi-visitati-int" ).accordion({
            header: 'h5',
            active: true,
            collapsible: true,
            heightStyle: 'content'
        });
        $('.dettaglio-viaggio-ext .feedback-citta').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 75,
            showText: true
        });

        $('.dettaglio-viaggio-ext .feedback-luogo').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 75,
            showText: true
        });

        button_profilo();
        button_segnalazione_1();

        $(function() {
            $(".loadCommento").click(function( event ){
                $.ajax({
                    url: "index.php?controller=ricerca&task=visualizza_commenti",
                    type: "POST",
                    data: { idviaggio: $(this).attr("idviaggio"), nomecitta: $(this).attr("citta"), nome: $(this).attr("luogo")},
                    success: function(msg) {
                        $("div#risposta-commento").html(msg);
                        commento();
                        if($("div#risposta-panoramica").show())
                            $("div#risposta-panoramica").hide();
                        if($("div#risposta-dettaglio").show())
                            $("div#risposta-dettaglio").hide();
                        if($("div#risposta-commento").hide())
                            $("div#risposta-commento").show();
                        if($('#barraricerca').show())
                            $('#barraricerca').hide();
                    },
                    error: function(){
                        alert("Chiamata fallita!!!");
                    }
                });

            });
        });


        $(function() {
            $('.citta-visitate h3 ').each(function(index , elemento) {
                var cittaformattata=$(this).text().replace(/\ /g,'').replace(/\'/g,'');
            $("#"+cittaformattata+" .aggiungi-feedback-citta").click(function( event ){
                $.ajax({
                    url: "index.php?controller=ricerca&task=aggiungi_feedback_citta",
                    type: "POST",
                    data: { idviaggio: $(this).attr("idviaggio"), nomecitta: $(this).attr("citta"), stato: $(this).attr("stato")},
                    success: function(msg) {
                        $("#"+cittaformattata+" .aggiungi-feedback-citta").remove();
                        $("#"+cittaformattata+" .feedback-citta h6").text(msg);
                    },
                    error: function(){
                        alert("Chiamata fallita!!!");
                    }
                });
            });
        });
        });

        $(function() {
            $(".ricerca-navigazione2 #home").button({
                icons: {
                    primary: "ui-icon-home"
                },
                text: false
            }).click(function(){
                    $('div#risposta-dettaglio *').remove();
                    $('div#risposta-panoramica *').remove();
                    if($('#barraricerca').hide())
                        $('#barraricerca').show();
                });
        });
        $(function() {
            $(".ricerca-navigazione2 #prev").button({
                icons: {
                    primary: "ui-icon-arrow-1-w"
                },
                text: false
            }).click(function(event) {
                    if( $('div#risposta-panoramica h3').length !=0 ) {
                        if($("div#risposta-dettaglio").show())
                            $("div#risposta-dettaglio").hide();
                        if($("div#risposta-panoramica").hide())
                            $("div#risposta-panoramica").show();
                        $(".ricerca-navigazione1 #next").button("enable");
                        }
                    else
                    {
                        if($("div#risposta-dettaglio").show())
                            $("div#risposta-dettaglio").hide();
                        if($('#barraricerca').hide())
                            $('#barraricerca').show();
                    }
                    });
        });

        $(function() {
            $(".ricerca-navigazione2 #next").button({
                icons: {
                    primary: "ui-icon-arrow-1-e"
                },
                text: false,
                disabled: true
            }).click(function(event) {
                    if( $('div#risposta-commento h4').length !=0 ) {
                        if($('div#risposta-panoramica').show())
                            $('div#risposta-panoramica').hide();
                        if($('div#risposta-dettaglio').show())
                            $('div#risposta-dettaglio').hide();
                        if($('div#risposta-commento').hide())
                            $('div#risposta-commento').show();
                        if($('#barraricerca').show())
                            $('#barraricerca').hide();
                    }
                });
        });

    };

    var commento = function () {

        $( ".commento-int" ).accordion({
            header: 'h4',
            active: false,
            collapsible: false,
            heightStyle: 'content'
        });
        $("#testo").show_char_limit(1024, {
            status_element: '.inserimento-commento .status',
            error_element: '#testo',
            status_style: 'chars_left'
        });
        button_profilo();
        button_segnalazione_2();
        button_segnalazione_3();

        $("#salvacommento").button({
            icons: {
                primary: "ui-icon-arrowthickstop-1-s"
            },
            text: true
        }).click(function(event) {
                var testo = $('#testo').val();
                if(typeof testo !== "undefined" && testo && $('#voto').val()!=0)
                {
                $.ajax({
                    url: "index.php?controller=ricerca&task=inserisci_commento",
                    type: "POST",
                    data: { idviaggio: $(this).attr("idviaggio"), nomecitta: $(this).attr("nomecitta"), nomeluogo: $(this).attr("nomeluogo"), testo: $('#testo').val(), voto: $('#voto').val()},
                    success: function(msg) {
                        $("div#commento-inserito").hide();
                        $(".commenti-utenti-ext").append(msg);
                        $("div#commento-inserito").show("clip",900);
                        $('#testo').val('');
                        $('#voto').val(0);
                        $("#testo").show_char_limit(1024, {
                            status_element: '.inserimento-commento .status',
                            error_element: '#testo',
                            status_style: 'chars_left'
                        });
                    },
                    error: function(){
                        alert("Chiamata fallita!!!");
                    }
                });
                }
                else
                {
                    alert("inserisci sia il commento che il voto")
                }
            });

        $(function() {
            $(".aggiungi-feedback-luogo").click(function( event ){
                $.ajax({
                    url: "index.php?controller=ricerca&task=aggiungi_feedback_luogo",
                    type: "POST",
                    data: { idviaggio: $(this).attr("idviaggio"), nomecitta: $(this).attr("citta"), nomeluogo: $(this).attr("luogo")},
                    success: function(msg) {
                        $(".aggiungi-feedback-luogo").remove();
                        $('.feedback-luogo h6').text(msg);
                    },
                    error: function(){
                        alert("Chiamata fallita!!!");
                    }
                });
            });
        });

        $(function() {
            $(".ricerca-navigazione3 #home").button({
                icons: {
                    primary: "ui-icon-home"
                },
                text: false
            }).click(function(){
                    $('div#risposta-dettaglio *').remove();
                    $('div#risposta-panoramica *').remove();
                    $('div#risposta-commento *').remove();
                    if($('#barraricerca').hide())
                        $('#barraricerca').show();
                });
        });
        $(function() {
            $(".ricerca-navigazione3 #prev").button({
                icons: {
                    primary: "ui-icon-arrow-1-w"
                },
                text: false
            }).click(function(event) {
                    if($('div#risposta-commento').show())
                        $('div#risposta-commento').hide();
                    if($('div#risposta-panoramica').show())
                        $('div#risposta-panoramica').hide();
                    if($('div#risposta-dettaglio').hide())
                        $('div#risposta-dettaglio').show();
                    if($('#barraricerca').show())
                        $('#barraricerca').hide();
                    $(".ricerca-navigazione2 #next").button("enable");
                });
        });
        $('.commento-ext .feedback-luogo').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 75,
            showText: true
        });
        };

    var barra_feedback = function () {
        $('.feedback-citta').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 75,
            showText: true
        });

        $('.feedback-luogo').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 75,
            showText: true
        });
    };

    var button_profilo = function () {
        $(".button-profilo").click(function(event){
            $.ajax({
                url: "index.php?controller=profilo&task=visualizza_link",
                type: "POST",
                data: { utente: $(this).attr("utente"), pagina: $(this).attr("pagina")},
                success: function(msg) {
                    $("div#risposta-profilo").html(msg);
                    if($("div#risposta-profilo").hide())
                        $("div#risposta-profilo").show();
                    if($("div#risposta-panoramica").show())
                        $("div#risposta-panoramica").hide();
                    if($("div#risposta-commento").show())
                        $("div#risposta-commento").hide();
                    if($("div#risposta-dettaglio").show())
                        $("div#risposta-dettaglio").hide();
                    if($('#barraricerca').show())
                        $('#barraricerca').hide();
                    $( ".profilo-int" ).accordion({
                        header: 'h4',
                        active: false,
                        collapsible: false,
                        heightStyle: 'content'
                    });
                    $(".ricerca-navigazione4 #home").button({
                        icons: {
                            primary: "ui-icon-home"
                        },
                        text: false
                    }).click(function(){
                            $('div#risposta-dettaglio *').remove();
                            $('div#risposta-panoramica *').remove();
                            $('div#risposta-commento *').remove();
                            $('div#risposta-profilo *').remove();
                            if($('#barraricerca').hide())
                                $('#barraricerca').show();
                        });
                    $(".ricerca-navigazione4 #prev").button({
                        icons: {
                            primary: "ui-icon-arrow-1-w"
                        },
                        text: false
                    }).click(function(event) {
                            if($(this).attr('pagina')==1)
                            {
                                if($('div#risposta-profilo').show())
                                    $('div#risposta-profilo').hide();
                                if($('div#risposta-panoramica').hide())
                                    $('div#risposta-panoramica').show();
                                if($('div#risposta-dettaglio').show())
                                    $('div#risposta-dettaglio').hide();
                                if($('div#risposta-commento').show())
                                    $('div#risposta-commento').hide();
                                if($('#barraricerca').show())
                                    $('#barraricerca').hide();
                            }
                            if($(this).attr('pagina')==2)
                            {
                                if($('div#risposta-profilo').show())
                                    $('div#risposta-profilo').hide();
                                if($('div#risposta-panoramica').show())
                                    $('div#risposta-panoramica').hide();
                                if($('div#risposta-dettaglio').hide())
                                    $('div#risposta-dettaglio').show();
                                if($('div#risposta-commento').show())
                                    $('div#risposta-commento').hide();
                                if($('#barraricerca').show())
                                    $('#barraricerca').hide();
                            }
                            if($(this).attr('pagina')==3)
                            {
                                if($('div#risposta-profilo').show())
                                    $('div#risposta-profilo').hide();
                                if($('div#risposta-panoramica').show())
                                    $('div#risposta-panoramica').hide();
                                if($('div#risposta-dettaglio').show())
                                    $('div#risposta-dettaglio').hide();
                                if($('div#risposta-commento').hide())
                                    $('div#risposta-commento').show();
                                if($('#barraricerca').show())
                                    $('#barraricerca').hide();
                            }
                        });
                },
                error: function(){
                    alert("Chiamata fallita!!!");
                }
            });
    });
    };

    var button_segnalazione_1 = function () {

        $('.button-segnalazione-viaggio').click(function(event) {
            var utente=$(this).attr('utente');
            var idviaggio=$(this).attr('idviaggio');
            $("#SegnalazioneViaggio").dialog({
                autoOpen: true,
                height: 300,
                width: 350,
                modal: true,
                buttons: {
                    "Invia": function(event) {
                        var testoSegnalazione = $('textarea#ViaggioCommentoSegnalazione').val();
                        if(typeof testoSegnalazione !== "undefined" && testoSegnalazione)
                        {
                            $.ajax({
                                type: 'POST',
                                url: 'index.php?controller=amministrazione&task=invia_segnalazione_viaggio',
                                data: {"nomeutente":utente,"idviaggio":idviaggio,"testosegnalazione":testoSegnalazione},
                                success: function(response)
                                {
                                    $('.button-segnalazione-viaggio').hide();
                                    $('textarea#ViaggioCommentoSegnalazione').remove();
                                },
                                error:function(response)
                                {
                                    alert ("impossibile inviare");
                                }
                            });
                            $(this).dialog( "close" );
                        }
                        else
                        {
                            alert("Devi inserire un commento");
                        }
                    },
                    Cancel: function() {
                        $(this).dialog( "close" );
                        $('textarea#ViaggioCommentoSegnalazione').val('');
                    }
                },
                close: function() {
                    $(this).dialog( "close" );
                    $('textarea#ViaggioCommentoSegnalazione').val('');
                }
            });

        });


        $(function() {
            $('.citta-visitate h3 ').each(function(index , elemento) {
                var cittaformattata=$(this).text().replace(/\ /g,'').replace(/\'/g,'');
                $("#"+cittaformattata+".button-segnalazione-citta").click(function( event ){
                    var utente=$(this).attr('utente');
                    var idviaggio=$(this).attr('idviaggio');
                    var nomecitta=$(this).attr('nomecitta');
                    var cittaAttiva=$(this).attr("nomecitta").replace(/\ /g,'').replace(/\'/g,'');
                    $("#"+cittaformattata+".SegnalazioneCitta").dialog({
                        autoOpen: true,
                        height: 300,
                        width: 350,
                        modal: true,
                        buttons: {
                            "Invia": function() {
                                var testoSegnalazione = $("#"+cittaformattata+".SegnalazioneCitta textarea").val();
                                if(typeof testoSegnalazione !== "undefined" && testoSegnalazione)
                                {
                                    $.ajax({
                                        type: 'GET',
                                        url: 'index.php?controller=amministrazione&task=invia_segnalazione_citta',
                                        data: {"nomeutente":utente,"idviaggio":idviaggio,"nomecitta":nomecitta,"testosegnalazione":testoSegnalazione},
                                        success: function(response)
                                        {
                                            $("#"+cittaformattata+".button-segnalazione-citta").hide();
                                            $("#"+cittaformattata+".SegnalazioneCitta textarea").remove();
                                        },
                                        error:function(response)
                                        {
                                            alert ("impossibile inviare");
                                        }
                                    });
                                    $("#"+cittaformattata+".SegnalazioneCitta").dialog( "close" );
                                }
                                else
                                {
                                    alert("Devi inserire un commento");
                                }
                            },
                            Cancel: function() {
                                $( "#"+cittaformattata+".SegnalazioneCitta" ).dialog( "close" );
                                $("#"+cittaformattata+".SegnalazioneCitta textarea").val('');
                            }
                        },
                        close: function() {
                            $( "#"+cittaformattata+".SegnalazioneCitta" ).dialog( "close" );
                            $("#"+cittaformattata+".SegnalazioneCitta textarea").val('');
                        }
                    });
                });
            });
        });
    };

    var button_segnalazione_2 = function () {
        $('.button-segnalazione-luogo').click(function() {
            var utente=$(this).attr('nomeutente');
            var idviaggio=$(this).attr('idviaggio');
            var nomecitta=$(this).attr('nomecitta');
            var nomeluogo=$(this).attr('nomeluogo');
            $( "#SegnalazioneLuogo").dialog({
                autoOpen: true,
                height: 300,
                width: 350,
                modal: true,
                buttons: {
                    "Invia": function() {
                        var testoSegnalazione = $('textarea#LuogoCommentoSegnalazione').val();
                        if(typeof testoSegnalazione !== "undefined" && testoSegnalazione)
                        {
                            $.ajax({
                                type: 'POST',
                                url: 'index.php?controller=amministrazione&task=invia_segnalazione_luogo',
                                data: {"nomeutente":utente,"idviaggio":idviaggio,"nomecitta":nomecitta,"nomeluogo":nomeluogo,"testosegnalazione":testoSegnalazione},
                                success: function(response)
                                {
                                    $('.button-segnalazione-luogo').hide();
                                    $('textarea#LuogoCommentoSegnalazione').remove();
                                },
                                error:function(response)
                                {
                                    alert ("impossibile inviare");
                                }
                            });
                            $(this).dialog( "close" );
                        }
                        else
                        {
                            alert("Il commento NON puo essere vuoto");
                        }
                    },
                    Cancel: function() {
                        $(this).dialog( "close" );
                        $('textarea#LuogoCommentoSegnalazione').val('');
                    }
                },
                close: function() {
                    $(this).dialog( "close" );
                    $('textarea#LuogoCommentoSegnalazione').val('');
                }
            });
        });
    };

    var button_segnalazione_3 = function () {
        $(function() {
            $('.commenti-utenti').each(function(index , elemento) {
                var comment=$(this).attr('id');
                $("#"+comment+".button-segnalazione-commento").click(function( event ){
                var utente=$(this).attr('nomeutente');
                var autorecommento=$(this).attr('autorecommento');
                var idcommento=$(this).attr('idcommento');
                $( "#"+comment+".SegnalazioneCommento").dialog({
                    autoOpen: true,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Invia": function() {
                            var testoSegnalazione = $("#"+comment+".SegnalazioneCommento textarea").val();
                            if(typeof testoSegnalazione !== "undefined" && testoSegnalazione)
                            {
                                $.ajax({
                                    type: 'POST',
                                    url: 'index.php?controller=amministrazione&task=invia_segnalazione_commento',
                                    data: {"nomeutente":utente,"autorecommento":autorecommento,"idcommento":idcommento,"testosegnalazione":testoSegnalazione},
                                    success: function(response)
                                    {
                                        $("#"+comment+".button-segnalazione-commento").hide();
                                        $("#"+comment+".SegnalazioneCommento textarea").remove();
                                    },
                                    error:function(response)
                                    {
                                        alert ("impossibile inviare");
                                    }
                                });
                                $("#"+comment+".SegnalazioneCommento").dialog("close");
                            }
                            else
                            {
                                alert("Il commento NON puo essere vuoto");
                            }
                        },
                        Cancel: function() {
                            $("#"+comment+".SegnalazioneCommento").dialog("close");
                            $("#"+comment+".SegnalazioneCommento textarea").val('');
                        }
                    },
                    close: function() {
                        $("#"+comment+".SegnalazioneCommento").dialog("close");
                        $("#"+comment+".SegnalazioneCommento textarea").val('');
                    }
                });
            });
            });
        });
    };
});



