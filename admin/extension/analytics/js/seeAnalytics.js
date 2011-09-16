			var tm_id = 0;
			var tm_animate = 200;
			var tm_metric = 'visitors';
			var tm_details;
			
			var tm_c1_theme;
			var tm_c2_theme;
			
			$(document).ready(function(){
				tm_details = $('.details span');
				
				
				$('ul li').hover(function(){
					var text = $('div',this).html();
					tm_details.html(text);
				},function(){
					tm_details.html('&nbsp;');
				});
				
				
				$('ul li div').hover(function(){
					$(this).css('background-position','bottom left');
				},function(){
					$(this).css('background-position','top left');
				});
				
				/*
				$(' .details li').mouseenter(function(){
					var frontCol = $('a',this).attr('rel');
					
					var backCol = 'c';
					if (frontCol=='c1') {  backCol='c2'; }else{ backCol='c1'; }
					
					$(' li .'+frontCol).css('z-index','20');
					$(' li .'+backCol).css('z-index','10');
				});
				*/
				
				$('.theme').click(function(){
					if ($('.settings').hasClass('thVisible')){
						$(this).removeClass('thVisible');
						$('.settings').fadeOut();
					}else{
						$(this).addClass('thVisible');
						$('.settings').fadeIn();
					}
				});
				
				
				$('.settings, .theme')
					.mouseout(function(){
						tm_id = setTimeout (hideTMenu, tm_animate );
					})
					.mousemove(function(){
						clearTimeout (tm_id);
					});

					
				$('.right span').click(function(){
					$('.right span.selected').removeClass('selected');
					$(this).addClass('selected');
					
					loadData( $(this).text());
				});

			});
			
			
			
			function changeTheme(col, newClass){
				$('.chart .'+col).addClass(newClass); 
				$(' ol .'+col+' div').attr('class',newClass);
				
				if (col=='c1') { 
					if (tm_c1_theme){ $(' .chart .c1').removeClass(tm_c1_theme); }
					tm_c1_theme=newClass; 
				}else{
					if (tm_c2_theme){ $(' .chart .c2').removeClass(tm_c2_theme); }
					tm_c2_theme=newClass; 
				 }
			}
			
			function loadData(metric){
				$(' .loader')
					.css({opacity:'0'})
					.css('display','block')
					.animate({opacity:'0.8'}) ;
					
				$(' .details .c1 a').fadeOut(function(){
					$(this).text(metric).fadeIn();
				});
				
				if (metric=="New visits") { metric="newVisits"; }
				
				 $.ajax({
				   type: "GET",
				   url: "chart.php",
				   dataType: "json",
				   data: ({show : metric}),
				   success: function(data){
						if (minimal){
							$("ul.chart .c1").each(function (i) {
								var nHeight =  data.items[i].value+'%';
								$(this).css('height',nHeight);
							});
						}else{
							$("ul.chart .c1").each(function (i) {
								var nHeight =  data.items[i].value+'%';
								 $(this).animate( { height: nHeight }, { queue:true, duration:1000 } );
							});
						}
						
						$("ul.chart .c2").each(function (i) {
							$(this).html(data.items[i].label);
						});
						
						$(' .loader').fadeOut();
				   }
				 });

			}
			
			function hideTMenu(){
				$('.theme').removeClass('thVisible');
				$('.settings').fadeOut();
			}