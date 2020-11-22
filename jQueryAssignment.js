//This is my jqeury that is used to run the slideshow/carousel on my site. 
$(document).ready(function() {

	var speed = 1100;
	var run = setInterval('rotate()', speed);	
	
	var item_width = $('#slides li').outerWidth(); 
	var left_value = item_width * (-1); 
        
	$('#slides li:first').before($('#slides li:last'));
	
	$('#slides ul').css({'left' : left_value});

	$('#prev').click(function() {

		var left_indent = parseInt($('#slides ul').css('left')) + item_width;

		$('#slides ul').animate({'left' : left_indent}, 200,function(){    

			$('#slides li:first').before($('#slides li:last'));           

			$('#slides ul').css({'left' : left_value});
		
		});

		return false;
            
	});

 
	$('#next').click(function() {
		
		var left_indent = parseInt($('#slides ul').css('left')) - item_width;
		
		$('#slides ul').animate({'left' : left_indent}, 200, function () {
            
			$('#slides li:last').after($('#slides li:first'));                 	
			
			$('#slides ul').css({'left' : left_value});
		
		});
		         
		return false;
		
	});        
	
	$('#slides').hover(
		
		function() {
			clearInterval(run);
		}, 
		function() {
			run = setInterval('rotate()', speed);	
		}
	); 
        
});
//below is my js menu function. It created a dropdown menu on my site. 
function myFunction() {
    document.getElementById("myDrop").classList.toggle("show");
  }
  
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
//this javascript section below is a p5.js plugin i found online, i thought it was a really cool plugin
//it takes wherever your mouse goes and has a plethora of ellipses follow it all changing colors as you move
  function setup() {
    createCanvas(windowWidth, windowHeight);
  }
  function draw() {
    const col = {};
    const {r, g, b} = col;
    col.r = random(0,255);
    col.g = random(0,255);
    col.b = random(0,255);
    fill(col.r,col.g,col.b);
    ellipse(mouseX,mouseY,200,200);
  }