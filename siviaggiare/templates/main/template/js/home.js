$(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
      if(!navigator.cookieEnabled)
      {
        	window.location.href="nocookie.html";
      }
    });
