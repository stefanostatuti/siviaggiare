$(document).ready(function()
{


    //disabilito il campo di testo
    $('input[class="info_profilo"]').attr('disabled','disabled');
    $('select[class="info_profilo"]').attr('disabled','disabled');
    $('#salva_nome').hide();
    $('#salva_cognome').hide();
    $('#salva_lavoro').hide();
    $('#salva_mail').hide();
    $('#salva_nazione').hide();
    $('#salva_residenza').hide();
    $('#salva_sesso').hide();
    $('#salva_data_nascita').hide();
    $('#salva_telefono').hide();


    //se clicco su modifica il campo di testo viene abilitato
    $('input[name="modifica_nome"]').click(function()
    {
        $('input[name="nome"]').removeAttr('disabled');
        $('#modifica_nome').hide();
        $('#salva_nome').show();
    });


    $('input[name="modifica_cognome"]').click(function()
    {
        $('input[name="cognome"]').removeAttr('disabled');
        $('#modifica_cognome').hide();
        $('#salva_cognome').show();
    });


    $('input[name="modifica_lavoro"]').click(function()
    {
        $('input[name="lavoro"]').removeAttr('disabled');
        $('#modifica_lavoro').hide();
        $('#salva_lavoro').show();
    });


    $('input[name="modifica_nazione"]').click(function()
    {
        $('input[name="nazione"]').removeAttr('disabled');
        $('#modifica_nazione').hide();
        $('#salva_nazione').show();
    });


    $('input[name="modifica_residenza"]').click(function()
    {
        $('input[name="citta"]').removeAttr('disabled');
        $('#modifica_residenza').hide();
        $('#salva_residenza').show();
    });


    $('input[name="modifica_mail"]').click(function()
    {
        $('input[name="mail"]').removeAttr('disabled');
        $('#modifica_mail').hide();
        $('#salva_mail').show();
    });


    $('input[name="modifica_telefono"]').click(function()
    {
        $('input[name="telefono"]').removeAttr('disabled');
        $('#modifica_telefono').hide();
        $('#salva_telefono').show();
    });


    $('input[name="modifica_sesso"]').click(function()
    {
        $('select[name="sesso"]').removeAttr('disabled');
        $('#modifica_sesso').hide();
        $('#salva_sesso').show();
    });


    $('input[name="modifica_data"]').click(function()
    {
        $('input[name="data"]').removeAttr('disabled');
        $('#modifica_data').hide();
        $('#salva_data_nascita').show();
    });


    $('input[id="salva_nome"]').click(function()
    {
        var nome = $('input[name="nome"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=nome&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("nome errato!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_nome').hide();
                        $('#modifica_nome').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });


    $('input[ id="salva_cognome"]').click(function()
    {
        var nome = $('input[name="cognome"]').val();
        $.ajax(
        {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=cognome&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("cognome errato!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_cognome').hide();
                        $('#modifica_cognome').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });

    $('input[id="salva_lavoro"]').click(function()
    {
        var nome = $('input[name="lavoro"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=lavoro&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("lavoro errato!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_lavoro').hide();
                        $('#modifica_lavoro').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }

            });
    });


    $('input[id="salva_nazione"]').click(function()
    {
        var nome = $('input[name="nazione"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=nazione&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("nome nazione errata!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_nazione').hide();
                        $('#modifica_nazione').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });


    $('input[id="salva_residenza"]').click(function()
    {
        var nome = $('input[name="citta"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=residenza&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("nome città errata!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_residenza').hide();
                        $('#modifica_residenza').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });


    $('input[id="salva_mail"]').click(function()
    {
        var nome = $('input[name="mail"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=mail&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("e-mail errata!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_mail').hide();
                        $('#modifica_mail').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });


    $('input[id="salva_telefono"]').click(function()
    {
        var nome = $('input[name="telefono"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=telefono&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("numero telefono errato!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_telefono').hide();
                        $('#modifica_telefono').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });


    $('input[id="salva_sesso"]').click(function()
    {
        var nome = $('select[name="sesso"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=sesso&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("problema inserimento!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_sesso').hide();
                        $('#modifica_sesso').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });


    $('input[id="salva_data_nascita"]').click(function()
    {
        var nome = $('input[name="data"]').val();
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=salva_info&label=data&campo="+nome,
                success: function(msg)
                {
                    if((msg) == 'false')
                    {
                        alert("data errata!!!");
                    }else
                    {
                        alert("Campo inserito!!!");
                        $('#salva_data_nascita').hide();
                        $('#modifica_data').show();
                        $('input[class="info_profilo"]').attr('disabled','disabled');
                        $('select[class="info_profilo"]').attr('disabled','disabled');
                    }
                },
                error: function()
                {
                    alert("Chiamata fallita!!!");
                }
            });
    });
});