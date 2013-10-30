jQuery(document).ready(function($){
    function log( message ) {
        $( "<div>" ).text( message ).prependTo( "#log" );
        $( "#log" ).scrollTop( 0 );
    }
    $('#ricerca').autocomplete({
        source:'?controller=ricerca&task=autocomplete',
        minLength:2,
        select: function( event, ui ) {
            log( ui.item ?
                "Selezionato: " + ui.item.value + " , idViaggio:" + ui.item.idviaggio :
                "Nessuna selezione, input era " + this.value );
        }
    });

    $('#tab-citta').tabs();
    $('.button-menu-citta').button();
    $('.feedback-citta-laterale').ratingbar({
        animate: true,
        duration: 1000,
        maxRating: 10,
        wrapperWidth: 50,
        showText: true
    });

    $(function() {
        $('#buttonsearch').button({
            icons: {
                primary: "ui-icon-search"
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
        });

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
            wrapperWidth: 100,
            showText: true
        });

        $('.luoghi-panoramica-ext .feedback-luogo').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 100,
            showText: true
        });



        $(function() {
            $('.button-dettaglio-viaggio').button({
                icons: {
                    primary: "ui-icon-arrow-1-e"
                },
                text: false
            }).click(function( event ) {
                    var citta=$(this).attr('citta');
                    var luogo=$(this).attr('luogo');
                    $.ajax({
                        url: "index.php",
                        type: "POST",
                        data: "controller=ricerca&task=visualizza_viaggio&idviaggio="+$(this).val(),
                        success: function(msg) {
                            $("div#risposta-dettaglio").html(msg);
                            dettaglio();
                            var cittaAttiva;
                            $('.citta-visitate h3 ').each(function(index , elemento) {
                                if($(this).text()==citta)
                                    cittaAttiva=index;
                            });

                            $( ".dettaglio-viaggio-ext" ).accordion("option", "active", 1);
                            $( ".citta-visitate" ).accordion( "option", "active", cittaAttiva);
                            $( "#"+citta+" .citta-visitate-int" ).accordion("option", "active", 0);

                            if(typeof(luogo) != "undefined" && luogo !== null){
                                var luogoAttivo;
                                $('#'+citta+' h5 ').each(function(indice , elemento) {
                                    if($(this).text()==luogo)
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
            wrapperWidth: 100,
            showText: true
        });

        $('.dettaglio-viaggio-ext .feedback-luogo').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 100,
            showText: true
        });

        $(function() {
            $(".loadCommento").click(function( event ){
                $.ajax({
                    url: "index.php?controller=ricerca&task=visualizza_commenti",
                    type: "POST",
                    data: { idviaggio: $(this).attr("idviaggio"), nomecitta: $(this).attr("citta"), nome: $(this).attr("luogo")},
                    success: function(msg) {
                        $("div#risposta-commento").html(msg);
                        if($("div#risposta-commento").hide())
                            $("div#risposta-commento").show();
                        if($("div#risposta-panoramica").show())
                            $("div#risposta-panoramica").hide();
                        if($("div#risposta-dettaglio").show())
                            $("div#risposta-dettaglio").hide();
                        if($('#barraricerca').show())
                            $('#barraricerca').hide();
                        commento();
                    },
                    error: function(){
                        alert("Chiamata fallita!!!");
                    }
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
                    if($("div#risposta-dettaglio").show())
                        $("div#risposta-dettaglio").hide();
                    if($("div#risposta-panoramica").hide())
                        $("div#risposta-panoramica").show();
                    $(".ricerca-navigazione1 #next").button("enable");
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
                        $("div#commento-inserito").html(msg);
                        $("div#commento-inserito").show("clip",900);
                        $('#testo').val('');
                        $('#voto').val(0);
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
            wrapperWidth: 100,
            showText: true
        });
        };

    var button_home = function () {
        $("#home").button({
            icons: {
                primary: "ui-icon-home"
            },
            text: false
        }).click(function(){
                var href = "index.php";
                window.location.href = href;
            });
    };

    var barra_feedback = function () {
        $('.feedback-citta').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 100,
            showText: true
        });

        $('.feedback-luogo').ratingbar({
            animate: true,
            duration: 1000,
            maxRating: 10,
            wrapperWidth: 100,
            showText: true
        });
    };

});



