<?php 

/*
 *Basic function for zoom api V2  
 *You can read the API documnentation from here: https://zoom.github.io/api/#add-a-webinar-registrant 
 And create your jwt_key from here: 
 Note: you have to be pro account not free account to use this api

 *current bug in this api: in zoom_add_user()

But all the other functions are working

 */

zoom_add_user();

//get_webinar_info();

//get_webinar_attendes();

//get_users();

//create_webinar();

/* add user to spesific webinar */
function zoom_add_user () {

	//JWT KEY 
	$jwt_key = "put your jwt id here..";
	 
	 //webinar id 
	$webinar_id = "put your webinar id here..";
	
			
	$webinar_data = array("email" => "mus.elnagar@gmail.com", "last_name"=>"test name", "first_name"=>"test first name");

	$webinar_data_custom_questions = array("email" => "mus.elnagar@gmail.com", "last_name"=>"test name", "first_name"=>"test first name", "custom_questions"=>array("title"=>"test title","value"=>"test value"));     

	$data_string = json_encode($webinar_data);  

	echo "final data we sent to the API: ".$data_string."<br/>";// debugging 

	$post_user_url	= 'https://api.zoom.us/v2/webinars/'.$webinar_id.'/registrants';

	$ch = curl_init($post_user_url);
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	curl_setopt($ch, CURLOPT_POST, 1);
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		 	"Authorization: Bearer".$jwt_key, 
		 	"Content-Type: application/json"
		 	));
			
			$response = curl_exec($ch);
			curl_close($ch);
			
			echo "Webinar info = ".$response; 
			
	}

	function get_webinar_info(){

	//JWT KEY 
	$jwt_key = "put your jwt id here..";
	 
	 //webinar id 
	$webinar_id = "put your webinar id here..";

	$get_webinar_info = "https://api.zoom.us/v2/webinars/".$webinar_id;

			$ch = curl_init($get_webinar_info);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		 	"Authorization: Bearer".$jwt_key, 
		 	"Content-Type: application/json"
		 	));
			//curl_setopt($ch, CURLOPT_POST, 1);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $reg_as_simple_json_encoded);

			$response = curl_exec($ch);
			curl_close($ch);
			
			echo "Webinar info = ".$response; 
	}

	function get_webinar_attendes(){

	//JWT KEY 
	$jwt_key = "put your jwt id here..";
	 
	 //webinar id 
	$webinar_id = "put your webinar id here..";

	$get_webinar_info = "https://api.zoom.us/v2/webinars/".$webinar_id."/registrants";

			$ch = curl_init($get_webinar_info);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		 	"Authorization: Bearer".$jwt_key, 
		 	"Content-Type: application/json"
		 	));
			//curl_setopt($ch, CURLOPT_POST, 1);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $reg_as_simple_json_encoded);

			$response = curl_exec($ch);
			print_r($response);
			curl_close($ch);
			
			$response = json_decode($response);

			echo "<br/>Webinar info decoded = <br/>".gettype($response); 

			print_r($response);
	}

function get_users(){
	
	//JWT KEY 
	$jwt_key = "put your jwt id here..";
	 
	
	$ch = curl_init('https://api.zoom.us/v2/users');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    // add token to the authorization header
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization: Bearer ' . $jwt_key
	));
	$response = curl_exec($ch);
	$response = json_decode($response);
 	print_r($response);

}
	function create_webinar(){

	//JWT KEY 
	$jwt_key = "put your jwt id here..";
	 
	 //webinar id 
	$webinar_id = "put your webinar id here..";

	$user_id = "put your pro account user id here...";

	
			$webinar_data = array("topic" => "test webinar name");                                                                    
			$data_string = json_encode($webinar_data);  


			$create_webinar_url = "https://api.zoom.us/v2/users/".$zen_user_id."/webinars";

			$ch = curl_init($create_webinar_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		 	"Authorization: Bearer".$jwt_key, 
		 	"Content-Type: application/json"
		 	));
			
			$response = curl_exec($ch);
			curl_close($ch);
			
			echo "Your webinar request result = ".$response; 
	}

?>