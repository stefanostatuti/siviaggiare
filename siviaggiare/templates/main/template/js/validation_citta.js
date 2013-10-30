$(document).ready(function()
{
	// my method for validate username
	$.validator.addMethod("stato_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-zA-Z \"'"]{3,20}$/i.test(value); 
	}, "Usare solo dai 3 ai 20 caratteri alfanumerici!");
	
	$.validator.addMethod("costo_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[0-9]{1,6}$/i.test(value); 
	}, "dato non valido es.12 euro!");
	
	$.validator.addMethod("datafine_regex", function( value, element, params) 
	{ 
		if (!/Invalid|NaN/.test(new Date(value))) 
		{
        return new Date(value) >= new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val())); 
    },"data inizio maggiore data fine?");
    
    $.validator.addMethod("citta_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-zA-Z \"'"]{3,50}$/i.test(value); 
	}, "dato non valido es.Roma!");
	
	
	
	$("#form_journey").validate
	(
	{
        rules:
        {
		
		'datainizio':
		{
			required: true//,
			/*remote: 
			{   //ajax sottostante servirˆ a creare un collegamento php ripartendo dall'index cambiando task e controller e accedendo  infine al databasef
				url: "index.php?controller=aggiunta_viaggio&task=verifica_datainiziocitta",
				type: "post",
				data: { datainizio: function() { //nome variabile inviata
                                                return $("#datainizio").val(); //dato inviato  
                                               }
                      },    
                success:function(msg) {
                                         alert(msg);
                                      }                          	   
		    } */
		},

		'datafine':
		{
			required: true,
			datafine_regex: "#datainizio"/*,
			remote: 
			{   //ajax sottostante servirˆ a creare un collegamento php ripartendo dall'index cambiando task e controller e accedendo  infine al databasef
				url: "index.php?controller=aggiunta_viaggio&task=verifica_datafinecitta",
				type: "post",
				data: { datafine: function() { //nome variabile inviata
                                                return $("#datafine").val(); //dato inviato  
                                             }
                      }                        	   
		    } */
		},
        
        'stato':
		{
			required: true,
			stato_regex: true,
		},
		
		'nome':
		{
			required: true,
			citta_regex: true
		},
		
		'costoalloggio':
		{   
			costo_regex: true//,
			/*remote:
			{   //ajax sottostante servirˆ a creare un collegamento php ripartendo dall'index cambiando task e controller e accedendo  infine al databasef
				url: "index.php?controller=aggiunta_viaggio&task=verifica_alloggio",
				type: "post",                         	   
		    } */
		}
		},
		
        messages:
        {
		'datainizio':
		{
			required: "Campo obbligatorio!",
			remote: "Dato non coerente con quello del viaggio!"
		},

		'datafine':
		{
			required: "Campo obbligatorio!",
			datafine_regex: "data inizio maggiore data fine?",
			remote: "Dato non coerente con quello del viaggio!"
			
		},
		
		'stato':
		{
			required: "Campo obbligatorio!",
			stato_regex: "Usare solo dai 3 ai 20 caratteri alfanumerici!"
		},
		
		'nome':
		{
			required: "campo obbligatorio!",
			citta_regex: "dato non valido es.Roma!"
		},

		'costoalloggio':
		{
			costo_regex: "dato non valido es.12 euro!",
			remote: "costo maggiore del budget?"
		}
		},
			onkeyup: true,
            onblur: true
	}); 
});
