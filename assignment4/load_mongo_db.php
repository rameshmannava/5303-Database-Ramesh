<?php

	// connecting to MongoDB
	$client = new MongoClient();

	// selecting a database
	$database = $client->rmannava;

	// selecting a collection to insert records
	$collection = $database->random_people;
	
	$json = file_get_contents("http://api.randomuser.me/?results=1000");
	$json_array = json_decode($json);

	for($i=0;$i<sizeof($json_array->results);$i++){
		// adding document to a collection
		$collection->insert($json_array->results[$i]);
	}

?>