
$(document).ready(function(){
	$("#login-form").click(function(c){
		c.preventDefault();
		
		$(".user-error").html("");
		$(".email-error").html("");
		$(".phone-error").html("");
		$(".city-error").html("");
		$(".message-error").html("");
		$(".success").html("");
		var username=$("#username").val();
		var city=$("#city").val();
		var message=$("#message").val();
		var email=$("#email").val();
		var phone=$("#phone").val();
		query_string="action=login&username="+username+"&city="+city+"&message="+message+"&email="+email+"&phone="+phone;
			$.ajax({
				url:"/ajax-contact.php",
				data:query_string,
				dataType:"json",
				type:"POST",cache:!1,
				success:function(d){
					if(d.status=="success"){
						window.location="http://www.panditsriramguruji.com/thankyou.html";
					}else{
						if(d.status=="error"){
							if(d.result.invalid_user&&d.result.invalid_user!=""){
							$(".user-error").append("<p style='color:red;'>"+d.result.invalid_user+"</p>")
							}if(d.result.invalid_city&&d.result.invalid_city!=""){
							$(".city-error").append("<p style='color:red;'>"+d.result.invalid_city+"</p>")
							}if(d.result.invalid_email&&d.result.invalid_email!=""){
							$(".email-error").append("<p style='color:red;'>"+d.result.invalid_email+"</p>")
							}if(d.result.invalid_phone&&d.result.invalid_phone!=""){
							$(".phone-error").append("<p style='color:red;'>"+d.result.invalid_phone+"</p>")
							}if(d.result.invalid_message&&d.result.invalid_message!=""){
							$(".message-error").append("<p style='color:red;'>"+d.result.invalid_message+"</p>")
							}
						}
					}
				},error:function(){}
			})
	});
});
