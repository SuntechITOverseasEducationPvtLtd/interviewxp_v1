$(document).ready(function(){	
	$('.click-nav1 > ul').toggleClass('no-js1 js1');
			$('.click-nav1 .js1 ul').hide();
			$('.click-nav1 .js1').click(function(e) {
				$('.click-nav1 .js1 ul').slideToggle(200);
				$('.clicker1').toggleClass('active1');
				e.stopPropagation();
			});
			$(document).click(function() {
				if ($('.click-nav1 .js1 ul').is(':visible')) {
					$('.click-nav1 .js1 ul', this).slideUp();
					$('.clicker').removeClass('active1');
				}
			});
			
			
			// Clickable Dropdown
			$('.click-nav2 > ul').toggleClass('no-js2 js2');
			$('.click-nav2 .js2 ul').hide();
			$('.click-nav2 .js2').click(function(e) {
				$('.click-nav2 .js2 ul').slideToggle(200);
				$('.clicker2').toggleClass('active2');
				e.stopPropagation();
			});
			$(document).click(function() {
				if ($('.click-nav2 .js2 ul').is(':visible')) {
					$('.click-nav2 .js2 ul', this).slideUp();
					$('.clicker').removeClass('active2');
				}
			});
			
			
			// Clickable Dropdown
			$('.click-nav3 > ul').toggleClass('no-js3 js3');
			$('.click-nav3 .js3 ul').hide();
			$('.click-nav3 .js3').click(function(e) {
				$('.click-nav3 .js3 ul').slideToggle(200);
				$('.clicker3').toggleClass('active3');
				e.stopPropagation();
			});
			$(document).click(function() {
				if ($('.click-nav3 .js3 ul').is(':visible')) {
					$('.click-nav3 .js3 ul', this).slideUp();
					$('.clicker').removeClass('active3');
				}
			});
			
			
			// Clickable Dropdown
			$('.click-nav4 > ul').toggleClass('no-js4 js4');
			$('.click-nav4 .js4 ul').hide();
			$('.click-nav4 .js4').click(function(e) {
				$('.click-nav4 .js4 ul').slideToggle(200);
				$('.clicker4').toggleClass('active4');
				e.stopPropagation();
			});
			$(document).click(function() {
				if ($('.click-nav4 .js4 ul').is(':visible')) {
					$('.click-nav4 .js4 ul', this).slideUp();
					$('.clicker').removeClass('active4');
				}
			});
			
			
			// Clickable Dropdown
			$('.click-nav5 > ul').toggleClass('no-js5 js5');
			$('.click-nav5 .js5 ul').hide();
			$('.click-nav5 .js5').click(function(e) {
				$('.click-nav5 .js5 ul').slideToggle(200);
				$('.clicker5').toggleClass('active5');
				e.stopPropagation();
			});
			$(document).click(function() {
				if ($('.click-nav5 .js5 ul').is(':visible')) {
					$('.click-nav5 .js5 ul', this).slideUp();
					$('.clicker').removeClass('active5');
				}
			});
			
			
			// Clickable Dropdown
			$('.click-nav6 > ul').toggleClass('no-js6 js6');
			$('.click-nav6 .js6 ul').hide();
			$('.click-nav6 .js6').click(function(e) {
				$('.click-nav6 .js6 ul').slideToggle(200);
				$('.clicker6').toggleClass('active6');
				e.stopPropagation();
			});
			$(document).click(function() {
				if ($('.click-nav6 .js6 ul').is(':visible')) {
					$('.click-nav6 .js6 ul', this).slideUp();
					$('.clicker').removeClass('active6');
				}
			});
	});