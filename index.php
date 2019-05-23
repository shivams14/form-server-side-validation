<!DOCTYPE html>
<html>
<head>
	<title>form</title>
</head>
<body>
	<div>
<form method="POST" id="book_visit">
	<input type="text" name="name" id="name" placeholder="name"><br>
	<input type="text" name="email" id="email" placeholder="email"><br>
	<input type="text" name="phone" id="phone" placeholder="phone"><br>
	<input type="text" name="city" id="city" placeholder="city"><br>
	<input type="submit" name="submit" id="submit" value="Submit">
</form>



</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#book_visit").submit(function(e){
		e.preventDefault();
		var me=$(this);
		// Get form
		var form = $('#book_visit')[0];
		
		// Create an FormData object 
		var data = new FormData(form);
		 data.append("action","insert");
		// If you want to add an extra field for the FormData
		
		
		$('.text-danger').remove();
		var  baseurl = 'register.php';

		$.ajax({
			url: baseurl,
			data: data,
			dataType:"json",
			type: "POST",
			processData: false,
			contentType: false,
			cache: false,
			beforeSend: function(){
				// Show image container
				$("#loader").show();
			   },
			success:function(data){
				if(data.status=='success'){
					/*$('.success_msg').show();
					me[0].reset();
					$('.success_msg').delay(500).show(10,function(){
					$(this).delay(500).hide(10,function(){
					//$(this).remove();
					});
					});*/
					
					alert('submit');
					$('#submit').attr('disabled','disabled');
				}
				else{
					$('#submit').removeAttr("disabled");
				    var keys=Object.keys(data.result);
				    var vallues=Object.values(data.result);
					var element=$('#'+keys);
					$('#'+keys).focus();
					 $('html, body').animate({
                        scrollTop: $('#'+keys).offset().top-100
                    }, 'fast');
					element.parent().addClass("is-active is-completed");
					element.after(vallues);
				
				}
			},
			 complete:function(data){
    // Hide image container
    //$("#loader").hide();
   }
		});
		return false;
	});
});
</script>
</body>
</html>