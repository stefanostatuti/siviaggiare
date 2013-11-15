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
			required: true
		},

		'datafine':
		{
			required: true,
			datafine_regex: "#datainizio"
		},
        
        'stato':
		{
			required: true,
			stato_regex: true
		},
		
		'nome':
		{
			required: true,
			citta_regex: true
		},
		
		'costoalloggio':
		{   
			costo_regex: true,
			remote:
		    {   url: "index.php?controller=aggiunta_viaggio&task=verifica_alloggio",
				type: "post",
                data: { idviaggio: $('input[name="idviaggio"]').val() }
		    }
		}
		},
		
        messages:
        {
		'datainizio':
		{
			required: "Campo obbligatorio!"
		},

		'datafine':
		{
			required: "Campo obbligatorio!",
			datafine_regex: "data inizio maggiore data fine?"
			
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
			remote: "costo alloggio maggiore del budget!"
		}
		}
	}); 
});
