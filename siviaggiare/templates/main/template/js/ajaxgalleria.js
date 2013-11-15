$(document).ready(function() {
    $('#carica_galleria').click(function()
    {
        $.ajax(
            {
                url: "index.php",
                type: "POST",
                data: "controller=profilo&task=aggiungi_foto_galleria"/*&foto="+nome*/,
                success: function(msg) {}
            });
    });
});