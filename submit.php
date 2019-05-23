<?php 
require 'phpmailer/class.phpmailer.php';
include 'phpmailer/class.smtp.php';
if(isset($_POST['action'])&& $_POST['action']!="") {
 
	if(!isset($_POST['username']) || $_POST['username'] == '') {
			// if no username was entered
			$contacterror["invalid_user"] = "Please enter a username";
		}
	else if (!preg_match("/^[a-zA-Z ]{2,50}$/",$_POST['username'])) { 
		$contacterror["invalid_user"] = "Please enter a valid username";
	}
    if(!isset($_POST['message']) || $_POST['message'] == '') {
			// if no message was entered
			$contacterror["invalid_message"] = "Please enter a message";
		}
	else if (preg_match("/(http|https):/i",$_POST['message'])) {
			$contacterror["invalid_message"] = "No url is allowed";
		}
	else if (preg_match("/^(www)/i",$_POST['message'])) { 
	         $contacterror["invalid_message"] = "No url is allowed";
	}
	if(!isset($_POST['city']) || $_POST['city'] == '') {
			// if no city was entered
			$contacterror["invalid_city"] = "Please enter a city";
		}
		else if (!preg_match("/^[a-zA-Z ]{2,50}$/",$_POST['city'])) { 
		$contacterror["invalid_city"] = "Please enter a valid City";
	}
    if(!isset($_POST['phone']) || $_POST['phone'] == '') {
			// if no phone was entered
			$contacterror["invalid_phone"] = "Please enter a phone";
		}
	else if (!preg_match("/^\d{10}$/",$_POST['phone'])) { 
	    $contacterror["invalid_phone"] = "Please enter a valid ten digit phone number";
	}
	if(!isset($_POST['email']) || $_POST['email'] == '') {
			// if no email was entered
			$contacterror["invalid_email"] = "Please enter a email";
		}
	else if (!preg_match("/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/",$_POST['email'])) {
            $contacterror["invalid_email"] = "Please enter a valid email";
	}	
 
	if((isset($contacterror["invalid_user"])|| isset($contacterror["invalid_message"])|| isset($contacterror["invalid_city"])|| isset($contacterror["invalid_phone"])|| isset($contacterror["invalid_email"]))&&!empty($contacterror))
		{
			 $response_array['status'] = 'error';
             $response_array['result'] = $contacterror;  			 
		}
	else
		{    
	      $response_array['status'] = 'success'; 
		  $name = $_POST['username'];	
		  $email = $_POST['email'];		
		  $phone = $_POST['phone'];	  
		  $msg = $_POST['message'];	
		  $city = $_POST['city'];	
		  $to = $_POST['email'];	
		  $subject = "Contact Us - Panditsriramguruji.com";	
		  $message1 = "<html>
     <head>
     <title>Contact Us</title>
     <style type='text/css'>
     table{font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; border-collapse:collapse;}
     table td{border:solid 1px #ccc; padding:5px;}
     </style>
     </head>
     <body>
     <table width='500' cellpadding='0' cellspacing='0'>
     <tr>
     <td colspan='2' align='center' bgcolor='#fff'>
						<img src='http://www.panditsriramguruji.com/images/logo.png'  />
	</td>
     </tr>
     <tr>
     <td width='20%'><strong>Name:</strong></td>
     <td>$name</td>
     </tr>
    <tr>				
     <td><strong>Phone</strong></td>				
		  <td>$phone</td>	
		  </tr>			
		  <tr>		
		  <td><strong>Email</strong></td>	
		  <td>$email</td>	
		  </tr>		
		  <tr>				
		  <td><strong>City</strong></td>	
		  <td>$city</td>	
		  </tr>		
		  <tr>				
		  <td><strong>Message:</strong></td>
		  <td>$msg</td>
		  </tr>	
     </table>
     </body>
     </html>
";
	 $message2 = "<html>
     <head>
     <title>Contact Us</title>
     <style type='text/css'>
     table{font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; border-collapse:collapse;}
     table td{border:solid 1px #ccc; padding:5px;}
     </style>
     </head>
     <body>
     <table width='500' cellpadding='0' cellspacing='0'>
	    <tr >
			<td colspan='2' >
				Hello $name,<br />
				Thank you for your interest. 
			    We have received following contact details from you:
			</td>
     </tr>
     <tr>
     <td colspan='2' align='center' bgcolor='#fff'>
						<img src='http://www.panditsriramguruji.com/images/logo.png'  />
	 </td>
     </tr>
     <tr>
     <td width='20%'><strong>Name:</strong></td>
     <td>$name</td>
     </tr>
     <tr>
     <td><strong>Email:</strong></td>
     <td>$email</td>
     </tr>
     <tr>
     <td width='20%'><strong>Phone No:</strong></td>
     <td>$phone</td>
     </tr>
     <tr>
     <td><strong>City living in:</strong></td>
     <td>$city</td>
     </tr>
     <tr>
     <td><strong>Your question/query:</strong></td>
     <td>$msg</td>
     </tr>
	 <tr>
     <td colspan='2' >
     <p> We will very soon get in touch with you to take things forward. In the meanwhile, You can always call 780-255-1666 if you have any questions.<p>
       <p> Your privacy is important to us. We will never share your information.</p>
        <p> Warm Regards, </p>
    <p>Pandit Sriram Guruji</p>
    
	  </td>
     </tr>
     </table>
     </body>
     </html>
";
/*php mailer*/		  
$mail = new PHPMailer;
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'shivji1astro1@gmail.com';                // SMTP username
$mail->Password = 'shivji1@123';                  // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->From = 'shivji1astro1@gmail.com';
$mail->FromName = 'panditsriramguruji';
//$mail->AddAddress('shivajiseo@gmail.com');               // Name is optional
$mail->AddAddress('shivji1astro1@gmail.com');               // Name is optional
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Contact Us - Panditsriramguruji.com';
$mail->Body    =$message1;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
/*php mailer*/		
	if($mail->Send()) {
		    $mail1 = new PHPMailer;
            $mail1->IsSMTP();                                      // Set mailer to use SMTP
			$mail1->Host = 'smtp.gmail.com';                 // Specify main and backup server
			$mail1->Port = 587;                                    // Set the SMTP port
			$mail1->SMTPAuth = true;                               // Enable SMTP authentication
			$mail1->Username = 'shivji1astro1@gmail.com';                // SMTP username
			$mail1->Password = 'shivji1@123';                  // SMTP password
			$mail1->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
			$mail1->From = 'shivji1astro1@gmail.com';
			$mail1->FromName = 'Panditsriramguruji';
			$mail1->AddAddress($_POST['email']);  // Add a recipient
			//$mail->AddAddress('ellen@example.com');               // Name is optional
			$mail1->IsHTML(true);                                  // Set email format to HTML
			$mail1->Subject = 'Contact Us - Panditsriramguruji.com';
			$mail1->Body    =$message2;
			if($mail1->Send()) {
				
			}
       }
	    }
 
} else {
   $response_array['status'] = 'error';  
}
echo json_encode($response_array);
?>



<?php
if(isset($_POST['action'])&& $_POST['action']!="") {


	$error_divstart='<p class="text-danger">';
	$error_divend='</p>';
	
	
	$mailname = $_POST['user_name'];
	$mailage = $_POST['user_age'];
	$mailoccup = $_POST['user_occup'];
	$mailaddress = $_POST['user_address'];
	$mailcity = $_POST['user_city'];
	$mailwaist = $_POST['user_waist'];
	$mailmaritstat = $_POST['user_marital_status'];
	$mailmobile = $_POST['user_mobile'];
	$mailemail = $_POST['user_email'];
	$mailaudcity = $_POST['user_audition_city'];
	$mailregistration_images='';

	
	$_SESSION['usr_name']=$mailname;
	$_SESSION['usr_email']=$mailemail;
	$_SESSION['usr_mobile']=$mailmobile;
	
	if(isset($_FILES["user_image"]["name"])&&!empty($_FILES["user_image"]["name"])){
		$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["user_image"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	 $mailregistration_images = $_FILES['user_image']['name'];
	}

	
	
	
	
	date_default_timezone_set("Asia/Kolkata");
	$maildate = date('Y-m-d h:i:s');
	
	
	$check_sql = "SELECT * FROM `tbl_users` WHERE `usr_email`='$mailemail' OR `usr_mobile`='$mailmobile'";
    $check_query = mysqli_query($conn,$check_sql);
	
	$row = mysqli_num_rows($check_query);
	
	$data = mysqli_fetch_assoc($check_query);
	
	$replace = str_replace("'","feet",$mailheight);
	
	
		/* name */
	if (!isset($mailname) || $mailname==''){
		$contacterror["user_name"] = $error_divstart."Please enter a name".$error_divend;
	}
	else if (!preg_match("/^[a-zA-Z ]{2,50}$/",$mailname)){
		$contacterror["user_name"] = $error_divstart."Please enter a valid name".$error_divend;
	}
	/* mobile */
	else if(!isset($mailmobile) || $mailmobile == ''){
		$contacterror["user_mobile"] = $error_divstart."Please enter a mobile".$error_divend;
	}
	else if (!preg_match("/^\d{10}$/",$mailmobile)){ 
		$contacterror["user_mobile"] = $error_divstart."Enter  ten digit phone number".$error_divend;
	}
	else if ($data['usr_mobile']==$mailmobile){
		$contacterror["user_mobile"] = $error_divstart."Mobile already exits".$error_divend;
	}
	
	
	/* email */
	else if(!isset($mailemail) || $mailemail == ''){
		$contacterror["user_email"] = $error_divstart."Please enter a email".$error_divend;
	}
	else if (!preg_match("/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/",$mailemail)){
		$contacterror["user_email"] = $error_divstart."Please enter a valid email".$error_divend;
	}
	else if ($data['usr_email']==$mailemail){
		$contacterror["user_email"] = $error_divstart."Email already exits".$error_divend;
	}
		/* occupation */
	else if (!isset($mailoccup) || $mailoccup==''){
		$contacterror["user_occup"] = $error_divstart."Please enter occupation".$error_divend;
	}
	/* address */
	else if (!isset($mailaddress) || $mailaddress==''){
		$contacterror["user_address"] = $error_divstart."Please enter address".$error_divend;
	}
	/* city */
	else if (!isset($mailcity) || $mailcity==''){
		$contacterror["user_city"] = $error_divstart."Please enter city".$error_divend;
	}
/* age */
	else if (!isset($mailage) || $mailage==''){
		$contacterror["user_age"] = $error_divstart."Please enter age".$error_divend;
	}
	else if (!is_numeric($mailage)){
		$contacterror["user_age"] = $error_divstart."Should be numeric".$error_divend;
	}
	else if ($mailage<=18){
		$contacterror["user_age"] = $error_divstart."Should greater than 18".$error_divend;
	}
	/* waist */
	else if (!isset($mailwaist) || $mailwaist==''){
		$contacterror["user_waist"] = $error_divstart."Please enter waist".$error_divend;
	}
	else if (!is_numeric($mailwaist)){
		$contacterror["user_waist"] = $error_divstart."Should be numeric".$error_divend;
	}
	else if ($mailwaist<=34){ 
		$contacterror["user_waist"] = $error_divstart."Should greater than 34".$error_divend;
	}
	/* address */
	else if (!isset($mailmaritstat) || $mailmaritstat==''){
		$contacterror["user_marital_status"] = $error_divstart."Please enter Marital status".$error_divend;
	}
	/* address */
	else if (!isset($mailaudcity) || $mailaudcity==''){
		$contacterror["user_audition_city"] = $error_divstart."Please enter Audition City".$error_divend;
	}
	/* image */
	else if (empty($mailregistration_images)){
		$contacterror["image_error"] = $error_divstart."Please choose one image".$error_divend;
	}
	// Check file size
	else if ($_FILES["user_image"]["size"] > 5000000) {
		$contacterror["image_error"] = $error_divstart."Less than 5MB images allowed".$error_divend;
	}
	// Allow certain file formats
	else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		$contacterror["image_error"] = $error_divstart."Sorry, only .JPG, .JPEG & .PNG images are allowed.".$error_divend;
	}
	
	if((isset($contacterror["user_name"])|| isset($contacterror["user_marital_status"]) || isset($contacterror["user_audition_city"]) || isset($contacterror["user_age"])|| isset($contacterror["user_weight"])|| isset($contacterror["user_address"])|| isset($contacterror["user_city"])|| isset($contacterror["user_state"])|| isset($contacterror["user_waist"])|| isset($contacterror["user_height"])|| isset($contacterror["user_mobile"])|| isset($contacterror["user_email"])|| isset($contacterror["image_error"])) || isset($contacterror['user_occup'])&&!empty($contacterror)){
		$response_array['status'] = 'error';
        $response_array['result'] = $contacterror;
	}
	
	else{
	/*$sel = "SELECT usr_id FROM `tbl_users` ORDER BY usr_reg_date DESC LIMIT 1";
	
	$query = mysqli_query($conn,$sel);

	$fetch = mysqli_fetch_assoc($query);*/
	
		
		// uploading image
        if(!empty($mailregistration_images)) {
            $replace_img = str_replace(" ","_",$mailregistration_images);
            $code   = rand(5, 100000);
            $mailimages = $code.$replace_img;
            $path   = "uploads/".$mailimages;
            move_uploaded_file($_FILES['user_image']['tmp_name'],$path);
        } 
   	else {
            $mailimages = "";
        }
		
		// insert data into database
		$sql = "INSERT INTO `tbl_users` (usr_name,usr_age,usr_occup,usr_address,usr_city,usr_waist,usr_marital_status,usr_mobile,usr_email,usr_aud_city,usr_image,usr_reg_date) VALUES ('$mailname','$mailage','$mailoccup','$mailaddress','$mailcity','$mailwaist','$mailmaritstat','$mailmobile','$mailemail','$mailaudcity','$mailimages','$maildate')";

		$reg_query = mysqli_query($conn,$sql);

		if ($reg_query){
		    
		
			$response_array['status'] = 'success';
		    $id = mysqli_insert_id($conn);
		    $user_code = "MSPSI00";
        	$usrid = $user_code.$id;
        	
			// sending mail
			$mailsubject = "Registration - Ms Plus Size India 2019";
			
			require 'PHPMailer/PHPMailerAutoload.php';
			require 'PHPMailer/class.phpmailer.php';
			require 'PHPMailer/class.smtp.php';

			$mail = new PHPMailer;

			$mail->SMTPDebug = 0;
			// SMTP configuration
			$mail->isSMTP();
			$mail->Host = 'mail.msplussizeindia.com';
			$mail->SMTPAuth = true;
			$mail->Username = "info@msplussizeindia.com";			
			$mail->Password = "5~,kXnrgoW5.";
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			$mail->From = 'info@msplussizeindia.com';
			$mail->FromName = "MS Plus Size India 2019";
			$mail->Subject = $mailsubject;
			$mail->WordWrap = 50;
			$mail->isHTML(true);
			$mail->AddEmbeddedImage('/home/msplu2og/public_html/images/logo.png', 'logo_2u');
			$mail->AddEmbeddedImage('/home/msplu2og/public_html/email-template/images/email-thankyou.png', 'logo');
			$mail->AddEmbeddedImage('/home/msplu2og/public_html/uploads/'.$mailimages, 'upload');
			$mail->Body = "<html>
					<head>
						<title>Ms Plus Size India 2019</title>
					</head>
					<body>
					
					<div style='width: 100%;background-repeat: no-repeat; box-sizing:border-box; color:#FFF; margin:0 auto; font-size:15px; font-family:Arial, Helvetica, sans-serif; max-width:600px; border:1px solid #ccc;'>
					
					<table width='600' border='0' cellpadding='10px' cellspacing='0'>
					
					
						<thead>
							<tr>
								<td colspan='2' style='border-bottom:none; text-align:center; padding-top:20px; margin:0;background-color:#000;'>
								
									
									<img src='cid:logo_2u' />
								</td>
							</tr>
						</thead>
						
						<tbody style='padding-left:40px; padding-right:20px; padding-bottom:40px; margin-bottom:10px;'>
							
							
							<tr>
								<td colspan='2' style='text-align:center; margin:0px;'>
									
									<img src='cid:logo' />
								</td>
							</tr>
							
							<tr>
								<td  colspan='2' style='text-align:center; margin:0px; color:#333; font-size:17px;' ><p style='margin-top:0px;'>We have received registration information, Our team will  contact you soon! </p></td>
							</tr>
							
								
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Id:</p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px; border:1px solid #ccc; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$usrid</p>
								</td>			
							</tr>
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Name:</p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px; border:1px solid #ccc; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailname</p>
								</td>			
							</tr>
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc; border-top:0px; margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Mobile:</p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc; border-top:0px; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailmobile</p>
								</td>			
							</tr>
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>E-mail: </p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc; border-top:0px;border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'> <a style='color:#333;'> $mailemail </a> </p>
								</td>			
							</tr>
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc; border-top:0px; margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Occupation:</p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc; border-top:0px; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailoccup</p>
								</td>			
							</tr>
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Address: </p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc; border-top:0px; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailaddress</p>
								</td>			
							</tr>
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px;border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>City: </p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc;border-top:0px;border-left:0px; margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailcity</p>
								</td>			
							</tr>
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Age: </p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc;border-top:0px; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailage</p>
								</td>			
							</tr>
							
							

							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Waist: </p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc;border-top:0px; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailwaist</p>
								</td>			
							</tr>
							

							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Marital Status: </p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc;border-top:0px; border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'>$mailmaritstat</p>
								</td>			
							</tr>
							
							
							
							<tr>
								<td width='40%' style='text-align:right; font-size:16px; border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Audition City: </p>
								</td> 
					
								<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc; border-top:0px;border-left:0px;margin:0px; padding:0px 10px;border-right:0;'>
									<p style='color:#333;'> <a style='color:#333;'> $mailaudcity </a> </p>
								</td>			
							</tr>
							
							

							<tr>
							
							<td width='40%' style='text-align:right; font-size:16px;border:1px solid #ccc;border-top:0px;margin:0px; padding:0px 10px;border-left:0;'>
									<p style='color:#333;'>Photograph: </p>
								</td>
							<td width='60%' style='text-align:left; font-size:16px;border:1px solid #ccc;border-top:0px;border-left:0px; margin:0px; margin-top:5px; padding:0px 10px;border-right:0;'>
								<img src='cid:upload' width='119' height='119'>
								<a href='https://www.msplussizeindia.com/uploads/$mailimages' target='_blank'>Click here to view full image</a>
								</td>
							</tr>
							
						</tbody>
						
						
						
						<tfoot style='background-color:#ddc18a; margin: 10px 0px;'>	
						<tr>
								<td colspan='2' style='text-align:center; font-size:16px;padding-top:20px;'>
									<p style='color:#333; margin:0px;'>Thanks for your Details. Complete Your Registration Below </p>
									<p style='color:#333; margin:0px;'>Proceed with Payment Of Rs. 1,500 as non-refundable Registration Fee. Please follow the link below to make the payment online:</p>
									<div style='float: left;width: 100%;margin-top:10px;'>
						  <a href='https://www.msplussizeindia.com/how-to-make-payment.php' style='border:2px solid #211f1f;border-radius: 25px;color: #333;display: block;font-size: 18px;margin: 0 auto 8px;padding: 10px 25px;text-align: center;text-decoration: none;width: 250px;background-color: #fff;'>How To Make Payment?</a>
					</div>
								</td>
					
					</tr>	
							<tr>
								<td colspan='2'>
									<p style='margin-bottom:0px; font-size:16px; text-align:center; color:#333; font-weight:bold'>For Any Future Assistance</p>
								</td>
							</tr>
							
							<tr>
								<td colspan='2' style='text-align:center; font-size:16px; padding:0;'>
									<p style='color:#333; margin:0px;'>Whats App: 9779072888</p>
								</td> 
							
							</tr>
							
							
							<tr>
								<td colspan='2' style='text-align:center; font-size:16px; '>
									<p style='color:#333; margin:0px;'>Email:  <a style='color:#333;'> info@msplussizeindia.com </a> </p>
								</td>
					
					</tr>			
							
						</tfoot>
						
						
					</table>

				  
					
					
					
					</div>
					
					</body>
					</html>";
			$mail->AddAddress("msplussizeindia@gmail.com", "MS Plus Size India 2019");
			$mail->AddCC($mailemail);
			$mail->AddBCC('leads.daksha@gmail.com', 'Leads');
			if ($mail->Send()){
				
				//
				
			}
			
		}
		}
}else{
	$response_array['status'] = 'error';
}
echo json_encode($response_array);
?>