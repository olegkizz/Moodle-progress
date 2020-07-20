<?php

 function sendRequest($type, $url, $body = '',$headers = ''){

 	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_URL,$url);
 

	switch ($type) {
		case 'GET':
				
			break;
		case 'POST':
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			break;
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}

function getProgress($email, $password, $name, $url){

		$courseId = array_pop(explode('/',$url));

  		$registerProgressUser = sendRequest('POST', 'https://progress-storage.easygenerator.com/user/register', json_encode(array(
  			"email" => "$email",
  			"password" => "$password",
  			"name" => "$name",
  			"shortTermAccess" => false

  		)),array('Content-Type: application/json'));

  		$loginToken = json_decode(sendRequest('POST', 'https://progress-storage.easygenerator.com/user/signin', json_encode(array(
  			"email" => "$email",
  			"password" => "$password",

  		)),array('Content-Type: application/json')))->token;

  		$loginInCourse = sendRequest('GET', $url.'?token='.$loginToken, json_encode(array(
  			"email" => "$email",
  			"password" => "$password",

  		)),array('Content-Type: application/json'));

  		$getProgress = sendRequest('GET', 'https://learn.easygenerator.com/api/learner/me/courses/'.$courseId.'/attempts/last?templateId=dfd771038693419b93241df641d1b26f', json_encode(array(
  			"email" => "$email",
  			"password" => "$password",

  		)),array('Authorization: Bearer '.$loginToken));
  		$notJsonProgress = json_decode($getProgress); 
  		
  		return json_encode(["status" => $notJsonProgress->status, "progress" => $notJsonProgress->score, "updated_at"=>$notJsonProgress->updatedAt]);
}