$(document).ready(function()
{
	// my method for validate username
	$.validator.addMethod("luogo_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-zA-Z \"'"]{3,40}$/i.test(value); 
	}, "campo non valido, solo caratteri alfanumerici!");
	
	$.validator.addMethod("sito_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}?$/i.test(value); 
	}, "sito web non valido - es. www.dominio.it!");
	
	$.validator.addMethod("costobiglietto_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[0-9]{1,3}$/i.test(value); 
	}, "dato non valido es.12 euro!");
	
	$.validator.addMethod("guida_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-zA-Z \, \"'"]{2,50}$/i.test(value); 
	}, "campo non valido, solo caratteri alfanumerici!");
	
	$.validator.addMethod("durata_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[0-9]{1,3}$/i.test(value); 
	}, "in minuti!");
	
	
	
	

	$("#form_journey").validate
	(
	{
        rules:
        {
		'nome':
		{
			required: true,
			luogo_regex: true,
		},
		
		'sitoweb':
		{
			sito_regex: true
		},

		'costobiglietto':
		{
			costobiglietto_regex: true,
			/*remote:
			{   //ajax sottostante servirˆ a creare un collegamento php ripartendo dall'index cambiando task e controller e accedendo  infine al databasef
				url: "index.php?controller=aggiunta_viaggio&task=verifica_costobiglietto",
				type: "post",
				data: { costobiglietto: function() { //nome variabile inviata
                                                return $("#costobiglietto").val(); //dato inviato  
                                             }
                      }                        	   
		    } */
		},

		'guida':
		{
			guida_regex: true
		},
		
		'durata':
		{
			durata_regex: true
		}
		},
		
        messages:
        {
		'nome':
		{
			required: "campo obbligatorio!",
			trasporto_regex: "campo non valido, solo caratteri alfanumerici!"
		},
		
		'sitoweb':
		{
			sito_regex: "sito web non valido - es. www.dominio.it!"
		},

		'costobiglietto':
		{
			costobiglietto_regex: "dato non valido es.12 euro!",
			/*remote:""*/
		},

		'guida':
		{
			guidaturistica_regex: "campo non valido, solo caratteri alfanumerici!"
		},
		
		'durata':
		{
			
			duratavisita_regex: "in minuti!"
		}
		}	
	});
});