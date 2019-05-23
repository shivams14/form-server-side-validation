<?php
include 'connection.php';

if(isset($_POST['action'])&& $_POST['action']!="") {


	$error_divstart='<p class="text-danger">';
	$error_divend='</p>';
	
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$city = $_POST['city'];
	
	
	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d h:i:s');
	
	
	$check_sql = "SELECT * FROM `tbl_visit` WHERE `email`='$email' OR `phone`='$phone'";
    $check_query = mysqli_query($conn,$check_sql);
	
	$row = mysqli_num_rows($check_query);
	
	$data = mysqli_fetch_assoc($check_query);
	
	
		/* name */
	if (!isset($name) || $name==''){
		$contacterror["name"] = $error_divstart."Please enter a name".$error_divend;
	}
	else if (!preg_match("/^[a-zA-Z ]{2,50}$/",$name)){
		$contacterror["name"] = $error_divstart."Please enter a valid name".$error_divend;
	}
	/* mobile */
	else if(!isset($phone) || $phone == ''){
		$contacterror["phone"] = $error_divstart."Please enter a mobile".$error_divend;
	}
	else if (!preg_match("/^\d{10}$/",$phone)){ 
		$contacterror["phone"] = $error_divstart."Enter  ten digit phone number".$error_divend;
	}
	else if ($data['phone']==$phone){
		$contacterror["phone"] = $error_divstart."Mobile already exits".$error_divend;
	}
	
	
	/* email */
	else if(!isset($email) || $email == ''){
		$contacterror["email"] = $error_divstart."Please enter a email".$error_divend;
	}
	else if (!preg_match("/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/",$email)){
		$contacterror["email"] = $error_divstart."Please enter a valid email".$error_divend;
	}
	else if ($data['email']==$email){
		$contacterror["email"] = $error_divstart."Email already exits".$error_divend;
	}

	/* city */
	else if (!isset($city) || $city==''){
		$contacterror["city"] = $error_divstart."Please enter city".$error_divend;
	}

	if(isset($contacterror["name"])|| isset($contacterror["phone"])|| isset($contacterror["email"])|| isset($contacterror["city"])&&!empty($contacterror)){
		$response_array['status'] = 'error';
        $response_array['result'] = $contacterror;
	}
	
	else{
	/*$sel = "SELECT usr_id FROM `tbl_users` ORDER BY usr_reg_date DESC LIMIT 1";
	
	$query = mysqli_query($conn,$sel);

	$fetch = mysqli_fetch_assoc($query);*/

		
		// insert data into database
		$sql = "INSERT INTO `tbl_visit` (name,email,phone,city,reg_date) VALUES ('$name','$email','$phone','$city','$date')";

		$reg_query = mysqli_query($conn,$sql);

		if ($reg_query){
		    
			$response_array['status'] = 'success';
			
		}
	}
}else{
	$response_array['status'] = 'error';
}
echo json_encode($response_array);

?>