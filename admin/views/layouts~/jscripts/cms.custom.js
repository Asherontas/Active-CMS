$(document).ready(function(){
    
    // Delete user
    $('.delete_user').click(function () {
        if (confirm('Voulez-vous vraiment supprimer cet utilisateur ?')) {
            id = $(this).attr('id');
            if ( id != 1 ) {
                $.ajax({
                       type: "POST",
                       url: "actions",
                       data: "delete_user_id="+id,
                       success: function(){
                            $('#row_'+id).fadeOut('slow');
                            $('#ajax_message').fadeIn('slow').delay(3000).fadeOut(1000);
                       }
                });
            }
            else {
                alert('Impossibe de supprimer cet utilisateur !');
            }
        }
        return false;
     });

     // Delete page
    $('.delete_page').click(function () {
        if (confirm('Voulez-vous vraiment supprimer cette page ?')) {
            id = $(this).attr('id');
            
                $.ajax({
                       type: "POST",
                       url: "actions.php",
                       data: "delete_page_id="+id,
                       success: function(){
                            $('#row_'+id).fadeOut('slow');
                            $('#ajax_message').fadeIn('slow').delay(3000).fadeOut(1000);
                       }
                });
            }
        return false;
     });

      // Enable/Disable page
    $('.page_status').click(function () {

            id = $(this).attr('id');
            var data_array = id.split('-');

            var page_id      = data_array[0];
            var page_status  = data_array[1];

            //alert(user_id + user_status);

            $.ajax({
                   type: "POST",
                   url: $(this).attr('href'),
                   data: "page_id="+page_id+"&status="+page_status,
                   success: function(){
                       $('#'+page_id+'-'+page_status).fadeOut('slow').fadeIn('slow');
                   }
            });
            window.setTimeout('location.reload()', 1000); //reloads after 2 seconds
     });

     // Enable/Disable user
    $('.user_status').click(function () {

            id = $(this).attr('id');
            var data_array = id.split('-');

            var user_id      = data_array[0];
            var user_status  = data_array[1];

            //alert(user_id + user_status);

            $.ajax({
                   type: "POST",
                   url: "actions",
                   data: "user_id="+user_id+"&status="+user_status,
                   success: function(){
                       $('#'+user_id+'-'+user_status).fadeOut('slow').fadeIn('slow');
                   }
            });
         window.setTimeout('location.reload()', 1000); //reloads after 2 seconds
     });

    // END AJAX

    // Slider Button
    $(".demo-dark").radioSwitch({width: 75, height: 23, track_bg_color:'#4E8CBB'});
    $(".demo-light").radioSwitch({width: 75, height: 23, track_bg_color:'#4E8CBB'});


            $("#submit_new").click(function () {
		$("#submit_new").hide();
		$("#loading").show();
	    });
	 
	$('.notification').hover(function() {
 		$(this).css('cursor','pointer');
 	}, function() {
 		$(this).css('cursor','auto');
	});

	$('.notification span').click(function() {
		$(this).parent().fadeOut(800);
	});
	
	$('.notification').click(function() {
		$(this).fadeOut(800);
	});

    if ( $(".success").length > 0 ) {
		$(".success").fadeIn('slow');
	};

    if ( $(".error").length > 0 ) {
		$(".error").fadeIn('slow');
	};

    //Tooltip
    $(".tooltips").hover(
	    function() {$(this).contents("span:last-child").css({display: "block"});},
	    function() {$(this).contents("span:last-child").css({display: "none"});}
    );
    $(".tooltips").mousemove(function(e) {
	    var mousex = e.pageX + 10;
	    var mousey = e.pageY + 5;
	    $(this).contents("span:last-child").css({top: mousey, left: mousex});
    });

    $(".main .textinput").bind("change keyup", function (e) {
            key = e.which+" ";
            badkeys = "224 16 17 18 37 38 39 40 ";
            if ((badkeys.indexOf(key) == "-1") && ($("#submit_new").val() !== "Modifier *")) {
                    $("#submit_new").val("Modifier *");
            }
    });

    /*
    $(window).keypress(function(event) {
        if (!(event.which == 115 && event.ctrlKey)) return true;
        alert("Ctrl-S pressed");
        event.preventDefault();
        $('#ctrl_submit').submit();
        return false;
    });

    */

/* Log out
$("#logout").click(function () {
	$.ajax({
		type: "POST",
		url: "core/logout.php",
		success: function(){
		    window.setTimeout('location.reload()', 0); //reloads after 2 seconds
		}
	});
});

*/

}); // End jQuery

// Editor wysiwyg
bkLib.onDomLoaded(function() {
    new nicEditor({fullPanel : true}).panelInstance('wysiwyg');
});

/*
$(function() {
        $( "#datepicker" ).datepicker();
});
*/
