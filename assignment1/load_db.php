<?php
	error_reporting(0);
	
	$servername = "localhost";
	$username = "rmannava";
	$password = "rmannava2015";
	$database = "rmannava";	
	$db = new mysqli($servername,$username,$password,$database);
	
	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$json = file_get_contents("http://api.randomuser.me/?results=1000");	
	$json_array = json_decode($json);

	for($i = 0;$i < sizeof($json_array->results);$i++){
		$Gender = $json_array->results[$i]->user->gender;
		$Title = $json_array->results[$i]->user->name->title;
		$First = $json_array->results[$i]->user->name->first;
		$Last = $json_array->results[$i]->user->name->last;
		$Street = $json_array->results[$i]->user->location->street;
		$City = $json_array->results[$i]->user->location->city;
		$State = $json_array->results[$i]->user->location->state;
		$Zip = $json_array->results[$i]->user->location->zip;
		$Email = $json_array->results[$i]->user->email;
		$Username = $json_array->results[$i]->user->username;
		$Password = $json_array->results[$i]->user->password;
		$Dob = $json_array->results[$i]->user->dob;
		$Phone = $json_array->results[$i]->user->phone;
		$Picture = $json_array->results[$i]->user->picture->medium;
	
		echo "'$Gender','$Title','$First','$Last','$Street','$City','$State','$Zip','$Email','$Username','$Password','$Dob','$Phone','$Picture'";

		$select_sql = <<<SQL
		select * from users where Email='{$Email}';
SQL;
		if(!$select_result = $db->query($select_sql)){
			die('There was an error running the query [' . $db->error . ']');
		}		
		if(!$select_result->num_rows>0){
			$insert_sql = <<<SQL
			INSERT into users
			VALUES('$Gender','$Title','$First','$Last','$Street','$City','$State','$Zip','$Email','$Username','$Password','$Dob','$Phone','$Picture'); 
SQL;
		if(!$insert_result = $db->query($insert_sql)){
			die('There was an error running the query [' . $db->error . ']');	
		}
	}

}