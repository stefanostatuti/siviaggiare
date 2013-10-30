$(document).ready(function()
{
	// my method for validate username
	$.validator.addMethod("username_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-z0-9\.\-_]{3,15}$/i.test(value); 
	}, "Usare solo caratteri alfanumerici, numeri,.,-,_!");
	
	$.validator.addMethod("cognome_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-z ]{3,20}$/i.test(value); 
	}, "Usare solo caratteri alfanumerici!");
		
	$.validator.addMethod("nome_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-z ]{3,20}$/i.test(value); 
	}, "Usare solo caratteri alfanumerici!");	
	
	$.validator.addMethod("nazione_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-z ]{3,20}$/i.test(value); 
	}, "Usare solo caratteri alfanumerici!");
	
	$.validator.addMethod("citta_regex", function(value, element) 
	{ 
		return this.optional(element) || /^[a-z ]{3,20}$/i.test(value); 
	}, "Usare solo caratteri alfanumerici!");
	
	$.validator.addMethod("email_regex", function(value, element) 
	{ 
		return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value); 
	}, "Email non valida es. pippo.pluto@dominio.it!");
	
	$.validator.addMethod("pass_regex", function(value, element) 
	{ 
		return this.optional(element) || /^\w{8,16}$/i.test(value); 
	}, "Formato password non valido !");
	
	
	$("#form_register").validate
	(
	{   onkeyup: true,
        onblur: true,
        rules:
        {
		'username':
		{
			required: true,
			minlength: 3,
			username_regex: true,
		    remote:
			{   /*AJAX*/
				url: "index.php?controller=registrazione&task=verifica_registrazione",
				type: "post"                      	   
		    } /*altri dati si possono passare cos“ data: { username: function() { //nome variabile inviata
                                                return $("#reg_user").val(); //dato inviato}
                      */  
		}, 
		
		'cognome':
		{
			required: true,
			minlength: 3,
			cognome_regex: true
			
		},
		
		'nome':
		{
			required: true,
			minlength: 3,
			nome_regex: true
			
		},
		
		'nazione':
		{
			required: true,
			minlength: 3,
			nazione_regex: true
			
		},	
		
		'residenza':
		{
			required: true,
			minlength: 3,
			citta_regex: true
			
		},	
		
		'mail':
		{
			required: true,
			email: true,
			email_regex: true
		},
		
		'password':
		{
			required: true,
			minlength: 8,
			pass_regex: true
		},
		
		'password_1':
		{
		    required: true,
			equalTo: '.reg_pass1'
		}
		},
		
        messages:
        {
		'username':
		{
			required: "Campo obbligatorio!",
			minlength: "Scegli un username di almeno 3 caratteri!",
			username_regex: "Hai utilizzato caratteri non validi. Sono consentiti solo lettere, numeri,.,-,_!",
			remote: "L'username  gi&aacute;  utilizzato!"
		},
		
		'cognome':
		{
			required: "Campo obbligatorio!",
			minlength: "Inserisci un cognome di almeno 3 caratteri!",
			cognome_regex: "Hai utilizzato caratteri non validi. Sono consentiti solo lettere!"
		},
		
		'nome':
		{
			required: "Campo obbligatorio!",
			minlength: "Inserisci un nome di almeno 3 caratteri!",
			nome_regex: "Hai utilizzato caratteri non validi. Sono consentiti solo lettere!"
		},
		
		'nazione':
		{
			required: "Campo obbligatorio!",
			minlength: "Inserisci una nazione di almeno 3 caratteri!",
			nazione_regex: "Hai utilizzato caratteri non validi. Sono consentiti solo lettere!"
		},
		
		'residenza':
		{
			required: "Campo obbligatorio!",
			minlength: "Inserisci una citta di almeno 3 caratteri!",
			citta_regex: "Hai utilizzato caratteri non validi. Sono consentiti solo lettere!"
		},
		
		'mail':
		{
			required: "Campo obbligatorio!",
			email: "Inserisci un valido indirizzo email!",
			email_regex: "Formato email non valido es. pippo@pluto.dominio.it!"
		},
			
		'password':
		{
			required: "Campo obbligatorio!",
			minlength: "Inserisci una password di almeno 8 caratteri!",
			pass_regex: "Formato password non valido !"
		},
			
		'password_1':
		{
		    required: "Campo obbligatorio!",
			equalTo: "Le due password non coincidono!"
		},
		}
	});
});
