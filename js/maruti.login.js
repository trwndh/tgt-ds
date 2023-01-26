
$(document).ready(function(){


    
    if($.browser.msie == true && $.browser.version.slice(0,3) < 10) {
        $('input[placeholder]').each(function(){ 
       
			var input = $(this);       
		   
			$(input).val(input.attr('placeholder'));
				   
			$(input).focus(function(){
				 if (input.val() == input.attr('placeholder')) {
					 input.val('');
				 }
			});
		   
			$(input).blur(function(){
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.val(input.attr('placeholder'));
				}
			});
		});
	}
	
	$("#btn_login").click(function(e){
		e.preventDefault();
		var a = $("#input_login").val();
		var b = $("#input_password").val();
		$.ajax({
			url:'ajax/getter.php?act=auth',
			data:{a:a,b:b},
			type:'post',
			async:false,
			success:function(response){
				if(response=='ok')
				{
					$("#msg-text").html('Logged In.. Please Wait');
					setTimeout(function(){
						window.location.href = "dashboard.php";
					},1340);
				}
				// else $("#msg-text").html('Login Failed');
				else
				{
					$("#msg-text").html(response);
				
					setTimeout(function(){
						$("#msg-text").html('YTDS &copy;2018');
					},2000);
				}
			}
		});
	});
});