$(document).ready(function()
{
	// my method for validate username
	$.validator.addMethod("trasporto_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[0-9]{1,6}$/i.test(value); 
	}, "dato non valido es.12 euro!");
	
	$.validator.addMethod("budget_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[0-9]{1,6}$/i.test(value); 
	}, "dato non valido es.12 euro!");
	
	$.validator.addMethod("datafine_regex", function( value, element, params) 
	{ 
		if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) >= new Date($(params).val());
    }

        return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val())); 
    },"data inizio maggiore data fine?");
	
	$.validator.addMethod("costi_regex", function(value, element, params) 
	{ 
		if ((value)> ($(params).val()))
		{
        return (value) > ($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val())); 
    },"budget minore del costo trasporto?");
	
	

	$("#form_journey").validate
	(
	{
        rules:
        {
		'costotrasporto':
		{
			required: true,
			trasporto_regex: true,
		},
		
		'datainizio':
		{
			required: true
		},

		'datafine':
		{
			required: true,
			datafine_regex: "#datainizio"
		},

		'budget':
		{
			required: true,
			budget_regex: true,
			costi_regex: "#costotrasporto"
		}
		},
		
        messages:
        {
		'costotrasporto':
		{
			required: "campo obbligatorio!",
			trasporto_regex: "dato non valido es.12 euro!"
		},
		
		'datainizio':
		{
			required: "campo obbligatorio!"
		},

		'datafine':
		{
			required: "campo obbligatorio!",
			datafine_regex: "data inizio maggiore data fine?"
		},

		'budget':
		{
			required: "campo obbligatorio!",
			budget_regex: "dato non valido es.12 euro!",
			costi_regex: "budget minore del costo trasporto?"
		}
		}	
	});
});
