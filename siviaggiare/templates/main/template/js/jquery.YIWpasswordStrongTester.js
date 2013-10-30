(function($){  
 $.fn.YIWpasswordStrongTester = function(options) {  
 	
 	var defaults = {  
   	poorColor: 'red',
   	mediumColor: '#FF7F2A',
   	goodColor: '#AAFF55',
   	excellentColor: 'green',
   	barId : 'bar',
   	resultId: 'result',
   	speed: 500
  	};
  	
  	var options = $.extend(defaults, options);
 
    return this.each(function() {  
 		
 		$('#'+options.barId).css({'height':'100%','width':0,'background-color':options.poorColor});
		var width = $('#result').width();
		var actRate = 0;
		var lowerCase = /[a-z]+/;
		var upperCase =  /[A-Z]+/;
		var numbers = /[0-9]+/;
		var specialChars = /[\040\041\042\043\044\045\046\047\050\051\052\053\054\055\056\057\072\073\074\075\076\077\100\133\135\137\173\174\175]+/;
		var specialCharsBonus = /[\040\041\042\043\044\045\046\047\050\051\052\053\054\055\056\057\072\073\074\075\076\077\100\133\135\137\173\174\175]{4,}/;
		$(this).keyup(function(){
			var pwd = $(this).val()
			rate = 0;
			if(pwd.length > 5)
			{
				if(lowerCase.test(pwd))
				{
					rate += 10;
				}
				if(upperCase.test(pwd))
				{
					rate += 10;
				}
				if(numbers.test(pwd))
				{
					rate += 10;
				}
				if(specialChars.test(pwd))
				{
					rate += 20;
				}
				if(specialCharsBonus.test(pwd))
				{
					rate += 30;
				}
				if(pwd.length > 12)
				{
					rate += 20;
				}
				
			}
			if(actRate != rate)
			{
				actRate = rate;
				var relWidth = width / 100;
				var barWidth = rate * relWidth;
				$('#'+options.barId).animate({
					width: barWidth
				},options.speed, function(){
					
					if(rate < 25)
					{
						$('#'+options.barId).css('background-color', options.poorColor);
					}
					if(rate >= 25 && rate < 50)
					{
						$('#'+options.barId).css('background-color', options.mediumColor);
					}
					if(rate >= 50 && rate < 75)
					{
						$('#'+options.barId).css('background-color', options.goodColor);
					}
					if(rate >= 75)
					{
						$('#'+options.barId).css('background-color', options.excellentColor);
					}
				});
			}
		});	
 
    });  
 };  
})(jQuery);