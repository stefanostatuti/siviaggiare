$(document).ready(function() {
    function disabilitaf5(e)
    {if((e.which || e.keyCode) == 116){e.preventDefault();}
    };

    $('#carica').click(function()
    {
        var nome = $("#foto_profilo").val();
         $.ajax(
            {
            url: "index.php",
            type: "POST",
            data: "controller=profilo&task=salva_foto&foto="+nome,
            success: function(msg)
            {
                if((msg) == true)
                alert('foto caricata!!!');
            }
            });
    });
});